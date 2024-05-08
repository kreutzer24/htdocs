<?php
require("connection.php");

if(isset($_POST["submit"]))
{
    //Hauptvariablen
    $username = $_POST["username"];
    $password = PASSWORD_HASH ($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];
    $st_course = $_POST["st_course"];
    $name = $_POST["name"];
    $sirname = $_POST["sirname"];
    $bday = $_POST["bday"];
    $gender = $_POST["gender"];
    $confession = $_POST["confession"];
    $nationality = $_POST["nationality"];
    $straße = $_POST["straße"];
    $hausnummer = $_POST["hausnummer"];
    $plz = $_POST["plz"];
    $ort = $_POST["ort"];
    //Untervariablen von $role
    $student = $_POST["student"];
    $dozent = $_POST["dozent"];
    $admin = $_POST["admin"];
    //Untervariablen von $gender
    $male = $_POST["male"];
    $female = $_POST["female"];
    $divers = $_POST["divers"];

    //User regestrierung
    $stmt = $con->prepare("SELECT * FROM benutzer WHERE Benutzername = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $userAlreadyExsists = $stmt->fetch_assoc();
    if(!$userAlreadyExsists)
    {
        $stmt = $con->prepare("INSERT INTO benutzer (Benutzername, Passwort, Roll_ID) VALUE (?,?,?)");
        $stmt-> bind_param('sss', $username, $password, $role);
        $stmt->execute();
    }else{echo "Benutzername existiert bereits";}

    $stmt = $con->prepare("SELECT ID FROM benutzer WHERE Benutzername = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $userID = $result->fetch_assoc();

    //Personendaten übertragung
    //PLZ
    $stmt = $con->prepare("SELECT * FROM plz WHERE PLZ = ?");
    $stmt->bind_param('s', $plz);
    $stmt->execute();
    $plzAlreadyExsists = $stmt->fetch_assoc();
    if(!$plzAlreadyExists)
    {
        $stmt = $con->prepare("INSERT INTO plz (PLZ, Ort) VALUE (?,?)");
        $stmt->bind_param('ss', $plz, $ort);
        $stmt->execute();
    }
    
    //Adresse
    $stmt = $con->prepare("INSERT INTO adresse (Straße, Hausnummer, PLZ) VALUE (?,?,?)");
    $stmt->bind_param('sss', $straße, $hausnummer, $plz);
    $stmt->execute();

    $stmt = $con->prepare("SELECT Adress_ID FROM adresse WHERE Straße = ? AND (Hausnummer = ? AND PLZ = ?)");
    $stmt->bind_param('sss', $straße, $hausnummer, $plz);
    $stmt->execute();
    $result = $stmt->get_result();
    $userAdressID = $result->fetch_assoc();

    if($role === $student)
    {
        $stmt = $con->prepare("INSERT INTO student (Vorname, Name, Geburtsdatum, Geschlecht, Konfession, Staatsangehörigkeit, ID, Studi_ID, Adress_ID) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssss', $sirname, $name, $bday, $gender, $confession, $nationality, $userID, $st_course, $userAdressID);
        $stmt->execute();
        printf("Error: %s.\n", $stmt->error);
    }else
    if ($role === $dozent)
    {
        $stmt = $con->prepare("INSERT INTO dozent (Vorname, Name, Geburtsdatum, Geschlecht, Konfession, Staatsangehörigkeit, ID, Adress_ID) VALUE (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssss', $sirname, $name, $bday, $gender, $confession, $nationality, $userID, $userAdressID);
        $stmt->execute();
        printf("Error: %s.\n", $stmt->error);
    }else
    if($role === $admin)
    {
        $stmt = $con->prepare("INSERT INTO dozent (Vorname, Name, Geburtsdatum, Geschlecht, Konfession, Staatsangehörigkeit, ID, Adress_ID) VALUE (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssss', $sirname, $name, $bday, $gender, $confession, $nationality, $userID, $userAdressID);
        $stmt->execute();
        printf("Error: %s.\n", $stmt->error);
    }
}
?>

<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Regestrierung</title>
	<link rel="stylesheet" href="style.css">
</head>
<body> 
    <form action="index.php" method="POST">
        <h1>Registrieren</h1>
        <div class="input_container">
            <!-- Account spezifische Daten-->
            <p>Account</p>
            <input type="text" placeholder="Benutzername" name="username" autocomplete="off">
            <input type="password" placeholder="Passwort" name="password" autocomplete="off">
            <select name="role" size="1">
                <option value="1" name="student" required>Student<input type="text" placeholder="Studiengang" name="st_course" required></option>
                <option value="2" name="dozent" required>Dozent</option>
                <option value="3" name="admin" requrired>Admin</option>
            </select>
            
            <br>
            <br>
            <!--Personen bezogene Daten (Student/ Dozent) -->
            
            
            <input type="text" name="name" placeholder="Vorname" required>
            <input type="text" name="sirname" placeholder="Nachname" required>
            
            <input type="date" name="bday" required>
            <select name="gender" size="1">
                <option>-</option>
                <option value="Männlich" name="male" required>Männlich</option>
                <option value="Weiblich" name="female" required>Weiblich</option>
                <option value="Divers" name="divers" required>Divers</option>
            </select>
            <br>
            <input type="text" name="confession" placeholder="Konfession" required>
            <input type="text" name="nationality" placeholder="Staatsangehörigkeit" required>
            <br>
            <!--Adresse/ PLZ-->
            <input type="text" name="straße" placeholder="Straße" required>
            <input type="text" name="hausnummer" placeholder="Hausnummer" required>
            <input type="text" name="plz" placeholder="PLZ" required>
            <input type="text" name="ort" placeholder="Ort" required>
            <br>
            <input type="submit" name="submit" value="Hinzufügen">
            
        </div>
        <button name="redirect">Zurück</button>
    </form>
</body>
</html>