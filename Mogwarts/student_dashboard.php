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
            <a href="index.php">Logout</a>
        </nav>
    </header>

    <a href= studentprofile.php?ID=$user[Matrikelnummer]>Profil</a></td>
    <a href='veranstaltungen.php'>Veranstaltungen</a> </br>
    <a href='module.php'>Module</a> </br>
    <a href='Studigänge.php'>Alle Studiengänge und Veranstaltungen (wip)</a> </br>

    <div class="container">
        <h1>Willkommen, Student!</h1>
    </div>

</body>

</html>
<?php
require "connnection.php";
session_start();

$stmt = $con->prepare("SELECT student.Martikelnummer, student.Vorname, student.Name, student.Geburtsdatum, student.Geschlecht, student.Konfession, student.Staatsangehörigkeit, studiengang.Bezeichnung, adresse.Straße, adresse.Hausnummer, plz.PLZ, plz.Ort
FROM student
INNER JOIN studiengang ON student.Studi_ID = studiengang.Studi_ID
INNER JOIN adresse ON student.Adress_ID = adresse.Adresse_ID
INNER JOIN PLZ ON plz.PLZ = adresse.PLZ
WHERE student.Martikelnummer = :userID");
$stmt->bindParam("userID", $userID);
$stmt->execute();
$studentData = $stmt->fetchAll();
$_SESSION["CurrenStudent"] = $stmt->fetchAll();
$studentData = $studentData[0];


?>