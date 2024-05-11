<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../Style/stylehomepage.css">
</head>

<body>

    <header>
        <h2 class="logo">MOGWARTS UNIVERSITY</h2>
        <nav class="navigation">
            <a href="index.php">Login<span></span></a>
            <a href="veranstaltungen.php">Veranstaltungen</a> 
            <a href="module.php">module</a>
        </nav>
    </header>
    <head>
    <section class="header">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    
    <div class="scrollable-section">
        <img src="../img/Uni2.png" alt="Mogwarts University">
    </div>

 
    <div class="footer-text">
        <h1>Willkommen bei Mogwarts University!</h1>
        <p>
            
        </p>
    </div>

    <script>
        window.addEventListener('scroll', function () {
            const footerText = document.querySelector('.footer-text');
            const scrollableSection = document.querySelector('.scrollable-section');
            const scrollableSectionBottom = scrollableSection.getBoundingClientRect().bottom;

            if (scrollableSectionBottom <= window.innerHeight) {
                footerText.classList.add('visible');
            } else {
                footerText.classList.remove('visible');
            }
        });
    </script>

</body>

</html>

<?php
require "connection.php";
session_start();
$user = $_SESSION["CurrentUser"];

$stmt = $con->prepare("SELECT Roll_ID FROM benutzer WHERE Benutzername = :username");
$stmt->bindParam('username', $_SESSION['CurrentUser'], PDO::PARAM_STR);
$stmt->execute();
$role = $stmt->fetchColumn();
// $role = $role[0];

switch ($role == 1)
{
    case 1:
        //Student
        echo ("<a href='index.php'>Abmelden</a> </br>");
                    echo ("<a href= studentprofile.php?ID=$user[Matrikelnummer]>Profil</a></td>");
                    echo ("<a href='veranstaltungen.php'>Veranstaltungen</a> </br>");
                    echo ("<a href='module.php'>Module</a> </br>");
                    echo ("<a href='Studigänge.php'>Alle Studiengänge und Veranstaltungen</a> </br>");

                    $stmt = $con->prepare("SELECT SUM(CP) AS GESCP
                    FROM student_konver
                    INNER JOIN konkrete_veranstaltung ON student_konver.konVer_ID = konkrete_veranstaltung.KonVer_ID
                    INNER JOIN veranstaltung ON konkrete_veranstaltung.Veranstaltungs_ID = veranstaltung.veranstaltungs_ID
                    WHERE student_konver.Matrikelnummer = :userMatnum");
                    $stmt->bindParam("userMatnum", $user['Martrikelnummer']);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
 
                    // $query = "SELECT SUM(CP) AS GESCP
                    // FROM student_konver
                    // INNER JOIN konkrete_veranstaltung ON student_konver.konVer_ID = konkrete_veranstaltung.KonVer_ID
                    // INNER JOIN veranstaltung ON konkrete_veranstaltung.Veranstaltungs_ID = veranstaltung.veranstaltungs_ID
                    // WHERE student_konver.Matrikelnummer = " . $Benutzer['Matrikelnummer'];
                    // $result = $db->execute_query($query);
               
                    foreach($result as $row)
                    {
                        echo("Gesamte CP:" .$row["GESCP"]."</br>");
                    }
                    
                    $stmt = $con->prepare("SELECT modul.Bezeichnung AS MBEZ, dozent.Name, Konkrete_veranstaltung.Datum
                    FROM veranstaltung
                    INNER JOIN modul ON modul.Modul_ID = veranstaltung.Modul_ID
                    INNER JOIN konkrete_veranstaltung ON konkrete_veranstaltung.Veranstaltungs_ID = veranstaltung.Veranstaltungs_ID
                    INNER JOIN dozent ON dozent.Dozi_ID = konkrete_veranstaltung.Dozi_ID
                    INNER JOIN student_konver ON student_konver.KonVer_ID = konkrete_veranstaltung.KonVer_ID
                    WHERE veranstaltung.Art_ID = 5 AND student_konver.Matrikelnummer = :userMatnum AND student_konver.Note = NULL");
                    $stmt->bindParam("userMatnum", $user["Matrikelnummer"]);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
 
                    // $query = "SELECT modul.Bezeichnung AS MBEZ, dozent.Name, Konkrete_veranstaltung.Datum
                    // FROM veranstaltung
                    // INNER JOIN modul ON modul.Modul_ID = veranstaltung.Modul_ID
                    // INNER JOIN konkrete_veranstaltung ON konkrete_veranstaltung.Veranstaltungs_ID = veranstaltung.Veranstaltungs_ID
                    // INNER JOIN dozent ON dozent.Dozi_ID = konkrete_veranstaltung.Dozi_ID
                    // INNER JOIN student_konver ON student_konver.KonVer_ID = konkrete_veranstaltung.KonVer_ID
                    // WHERE veranstaltung.Art_ID = 5 AND student_konver.Matrikelnummer = " .$Benutzer['Matrikelnummer']. " AND student_konver.Note = NULL";
                    // $result = $db->execute_query($query);  
                    echo ("<h2><Center>Deine nächsten Prüfungen</h2></Center>");
                    echo ("<h2><Center>");
                    echo ("<table border=1>");
                    echo ("<tr> <th>Modul</th> <th>Lehrer</th> <th>Datum</th> </tr>");
                    foreach($result as $row)
                    {
                        echo ("<tr><td rowspan>".$row["MBEZ"]."</td><td>".$row["Name"]."</td><td>".$row["Datum"]."</td></tr>");  
                    }
                    echo ("</table>");
                    echo("</h2></Center>");
 
                break;
    case 2:
        //Dozent
        echo ("<a href='index.php'>Abmelden</a> </br>");
                    echo ("<a href='studentlist.php'>Studenten Liste</a> </br>");
                    echo ("<a href='Studigänge.php'>Alle Studiengänge und Veranstaltungen</a> </br>");
                break;
    case 3:
        //Admin
        echo ("<a href='index.php'>Abmelden</a> </br>");
                    echo ("<a href='register.php'>Neuen Account Registrieren</a> </br>");
                    echo ("<a href='studentlist.php'>Studenten Liste</a> </br>");
                    echo ("<a href='Studigänge.php'>Alle Studiengänge und Veranstaltungen</a> </br>");

        break;
}

// $stmt = $con->prepare("SELECT ID FROM benutzer WHERE Benutzername = :username");
// $stmt->bindParam('username', $_SESSION["username"]);
// $stmt->execute();
// $userData = $stmt->fetchColumn(1);
// $userID = $userData['ID'];

// $stmt = $con->prepare("SELECT Matrikelnummer FROM student 
// INNER JOIN student ON benutzer.ID = student.ID
// WHERE student.ID = :userID");
// $stmt->bindParam('userID', $userID);
// $stmt->execute();
// echo "userID: $userID";
?>
