<h1>Dein Profil</h1>
<?php
$userID = $_GET["ID"];

$stmt = $con->prepare("SELECT student.Martikelnummer, student.Vorname, student.Name, student.Geburtsdatum, student.Geschlecht, student.Konfession, student.Staatsangehörigkeit, studiengang.Bezeichnung, adresse.Straße, adresse.Hausnummer, plz.PLZ, plz.Ort
FROM student
INNER JOIN studiengang ON student.Studi_ID = studiengang.Studi_ID
INNER JOIN adresse ON student.Adress_ID = adresse.Adresse_ID
INNER JOIN PLZ ON plz.PLZ = adresse.PLZ
WHERE student.Martikelnummer = :userID");
$stmt->bindParam("userID", $userID);
$stmt->execute();
$studentData = $stmt->fetchArray();
?>