<?php
require ("connection.php");



// if(isset($_POST["test"]))
// {
//     $stmt = "username is ?";
//     $stmt->bind_param('s', $username);
//     $stmt->execute();

// }

if (isset($_POST["redirect"])) {
    header("Location: index.php");
}

if (isset($_POST["submit"])) {
    //Problem bei den Variablen welche mit den option
    session_start();
    //Hauptvariablen
    $username = $_POST["username"];
    $password = PASSWORD_HASH($_POST["password"], PASSWORD_DEFAULT);
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

    //User regestrierung
    $stmt = $con->prepare("SELECT * FROM benutzer WHERE Benutzername = :username");
    $stmt->bindParam('username', $username);
    $stmt->execute();
    // echo "username:$username";
    //printf("Error: %s.\n", $stmt->error);
    //$result = $stmt->get_result();

    $userAlreadyExsists = $stmt->fetchAll();
    if (!$userAlreadyExsists) {
        $stmt = $con->prepare("INSERT INTO benutzer (Benutzername, Passwort, Roll_ID) VALUE (:username, :password, :role)");
        $stmt->bindParam('username', $username);
        $stmt->bindParam('password', $password);
        $stmt->bindParam('role', $role);
        // $stmt = $con->prepare("INSERT INTO benutzer (Benutzername, Passwort, Roll_ID) VALUE (?,?,?)");
        // $stmt->bind_param('sss', $username, $password, $role);
        $stmt->execute();
    } else {
        echo "Benutzername existiert bereits";
    }

    $stmt = $con->prepare("SELECT ID FROM benutzer WHERE Benutzername = :username");
    $stmt->bindParam('username', $username);
    $stmt->execute();
   
    $userID = $stmt->fetchColumn();

    //Personendaten übertragung
    //PLZ
    $stmt = $con->prepare("SELECT * FROM plz WHERE PLZ = :plz");
    $stmt->bindParam('plz', $plz);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $plzAlreadyExsists = $result[0];
    if (!$plzAlreadyExsists) {
        $stmt = $con->prepare("INSERT INTO plz (PLZ, Ort) VALUE (:plz, :ort)");
        $stmt->bindParam('plz', $plz);
        $stmt->bindParam('ort', $ort);
        $stmt->execute();
    }

    //Adresse
    $stmt = $con->prepare("INSERT INTO adresse (Straße, Hausnummer, PLZ) VALUE (:strasse, :hausnummer, :plz)");
    $stmt->bindParam('strasse', $straße);
    $stmt->bindParam('hausnummer', $hausnummer);
    $stmt->bindParam('plz', $plz);
    $stmt->execute();

    $stmt = $con->prepare("SELECT Adress_ID FROM adresse WHERE Straße = :strasse AND (Hausnummer = :hausnummer AND PLZ = :plz)");
    $stmt->bindParam('strasse', $straße);
    $stmt->bindParam('hausnummer', $hausnummer);
    $stmt->bindParam('plz', $plz);
    $stmt->execute();

    $userAdressID = $stmt->fetchColumn();

    if ($role === '1') {
        $stmt = $con->prepare("INSERT INTO student (Vorname, Name, Geburtsdatum, Geschlecht, Konfession, Staatsangehörigkeit, ID, Studi_ID, Adress_ID) VALUE (:vorname, :namen, :geburtsdatum, :geschlecht, :konfession, :staatsangehoerigkeit, :id, :studiid, :adressID)");
        $stmt->bindParam('vorname', $sirname);
        $stmt->bindParam('namen', $name);
        $stmt->bindParam('geburtsdatum', $bday);
        $stmt->bindParam('geschlecht', $gender);
        $stmt->bindParam('konfession', $confession);
        $stmt->bindParam('staatsangehoerigkeit', $nationality);
        $stmt->bindParam('id', $userID);
        $stmt->bindParam('studiid', $st_course);
        $stmt->bindParam('adressID', $userAdressID);
        // $stmt->bind_param(
        //     'sssssssss',
        //     $sirname,
        //     $name,
        //     $bday,
        //     $gender,
        //     $confession,
        //     $nationality,
        //     $userID,
        //     $st_course,
        //     $userAdressID
        $stmt->execute();
        
    } else
        if ($role === '2') {
            $stmt = $con->prepare("INSERT INTO dozent (Vorname, Name, Geburtsdatum, Geschlecht, Konfession, Staatsangehörigkeit, ID, Adress_ID) VALUE (:vorname, :namen, :geburtsdatum, :geschlecht, :konfession, :staatsangehoerigkeit, :id, :adressID)");
            $stmt->bindParam('vorname', $sirname);
            $stmt->bindParam('namen', $name);
            $stmt->bindParam('geburtsdatum', $bday);
            $stmt->bindParam('geschlecht', $gender);
            $stmt->bindParam('konfession', $confession);
            $stmt->bindParam('staatsangehoerigkeit', $nationality);
            $stmt->bindParam('id', $userID);
            $stmt->bindParam('adressID', $userAdressID);
            $stmt->execute();
            printf("Error: %s.\n", $stmt->error);
        } else
            if ($role === '3') {
                $stmt = $con->prepare("INSERT INTO dozent (Vorname, Name, Geburtsdatum, Geschlecht, Konfession, Staatsangehörigkeit, ID, Adress_ID) VALUE (:vorname, :namen, :geburtsdatum, :geschlecht, :konfession, :staatsangehoerigkeit, :id, :adressID)");
                $stmt->bindParam('vorname', $sirname);
                $stmt->bindParam('namen', $name);
                $stmt->bindParam('geburtsdatum', $bday);
                $stmt->bindParam('geschlecht', $gender);
                $stmt->bindParam('konfession', $confession);
                $stmt->bindParam('staatsangehoerigkeit', $nationality);
                $stmt->bindParam('id', $userID);
                $stmt->bindParam('adressID', $userAdressID);
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
    <link rel="stylesheet" href="styleregister.css">
</head>

<body>
    <div class="umrandung">
    <form action="register.php" method="POST">
        <h1>Registrieren</h1>
        <div class="input_container">
            <!-- Account spezifische Daten-->
            <p>Account</p>
            <input type="text" placeholder="Benutzername" name="username" autocomplete="off">
            <input type="password" placeholder="Passwort" name="password" autocomplete="off">
            <select class="knopfz" name="role" size="1">
                <option value="1" name="student" required>Student</option>
                <option value="2" name="dozent" required>Dozent</option>
                <option value="3" name="admin" requrired>Admin</option>
                
            </select>
            <input type="text" placeholder="Studiengang" name="st_course" autocomplete="on">
            <br>
            <br>
            <!--Personen bezogene Daten (Student/ Dozent) -->


            <input type="text" name="name" placeholder="Vorname">
            <input type="text" name="sirname" placeholder="Nachname">

            <input class="knopfz" type="date" name="bday">
            <select class="knopfz" name="gender" size="1">
                <option>-</option>
                <option value="Männlich" name="male">Männlich</option>
                <option value="Weiblich" name="female">Weiblich</option>
                <option value="Divers" name="divers">Divers</option>
            </select>
            <br>
            <input type="text" name="confession" placeholder="Konfession">
            <input type="text" name="nationality" placeholder="Staatsangehörigkeit">
            <br>
            <!--Adresse/ PLZ-->
            <input type="text" name="straße" placeholder="Straße">
            <input type="text" name="hausnummer" placeholder="Hausnummer">
            <input type="text" name="plz" placeholder="PLZ">
            <input type="text" name="ort" placeholder="Ort">
            <br>
            <input class="knopfz" type="submit" name="submit" value="Hinzufügen">

        </div>
        <button class="knopfz" name="redirect">Zurück</button>
        <button class="knopfz" name="test">Test</button>
    </form>
</body>

</html>