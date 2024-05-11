<?php
require "connection.php";
session_start();
print_r($_SESSION['username']);
$stmt = $con->prepare("SELECT student.Matrikelnummer FROM student
INNER JOIN benutzer ON student.ID = benutzer.ID
WHERE benutzer.Benutzername = :username");
$stmt->bindParam('username', $_SESSION["username"]);
$stmt->execute();
$result = $stmt->fetchColumn();
$userMatnum = $result;

$stmt = $con->prepare("SELECT student.ID FROM student
INNER JOIN benutzer ON student.ID = benutzer.ID
WHERE benutzer.ID = :userID");
$stmt->bindParam('userID', $_SESSION["CurrentUser"]['ID']);
$stmt->execute();
$result = $stmt->fetchColumn();
$userID = $result;


$stmt = $con->prepare("SELECT student.Matrikelnummer, student.Vorname, student.Name, student.Geburtsdatum, student.Geschlecht, student.Konfession, student.Staatsangehörigkeit, studiengang.Bezeichnung, adresse.Straße, adresse.Hausnummer, plz.PLZ, plz.Ort
FROM student
INNER JOIN studiengang ON student.Studi_ID = studiengang.Studi_ID
INNER JOIN adresse ON student.Adress_ID = adresse.Adress_ID
INNER JOIN PLZ ON plz.PLZ = adresse.PLZ
WHERE student.Matrikelnummer = :userMatnum");
$stmt->bindParam("userMatnum", $userMatnum);
$stmt->execute();
$studentData = $stmt->fetchAll();
$_SESSION["CurrenStudent"] = $stmt->fetchAll();
// $studentData = $studentData[0];


?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../Style/style.css">
</head>

<body>
    <header>
        <a href=""><img src="../img/uni.png"></a>
        <h2 class="logo">MOGWARTS UNIVERSITY</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">Courses</a>
            <a href="#">Profile</a>
            <a href="index.php">Logout</a>
        </nav>
    </header>

    <!-- <a href= studentprofile.php?ID=$user[Matrikelnummer]>Profil</a></td> -->
    <a href='veranstaltungen.php'>Veranstaltungen</a> </br>
    <a href='module.php'>Module</a> </br>
    <a href='Studigänge.php'>Alle Studiengänge und Veranstaltungen (wip)</a> </br>

    <div class="container">
        <h1>Willkommen, Student!</h1>
    </div>

</body>

</html>
