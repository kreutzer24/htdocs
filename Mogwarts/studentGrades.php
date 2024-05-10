<head>
stylesheet hier einfügen
</head>

<h1>Modulübersicht</h1>
<?php
require "connection.php";
$stmt = $con->prepare("SELECT veranstaltung.veranstalungs_ID, veranstaltung.Bezeichnung, veranstalutngsart.Art, veranstaltung.CP, student_konver.Note
FROM student
INNER JOIN studiengang ON student.Studi_ID = studiengang.Studi_ID
INNER JOIN beinhaltet ON studiengang.Studi_ID = beinhaltet.Studi_ID
INNER JOIN modul ON behinhaltet.Modul_ID = modul.Modul_ID
INNER JOIN veranstaltung ON Modul.Modul_ID = veranstaltung.Modul_ID
INNER JOIN veranstaltungsart ON veranstaltung.Art_ID = veranstaltungsart.Art_ID
LEFT JOIN konkrete_veranstaltung ON veranstaltung.veranstaltungs_ID = konkrete_veranstaltung.veranstaltungs_ID
LEFT JOIN student_konver ON konkrete_veranstaltung.konver_ID = student_konver.konver_ID
WHERE  student.Martikelnummer = :userID
GROUP BY veranstaltung.Veranstaltungs_ID
ORDER BY modul.Modul_ID");
$stmt->bindParam('userID', $userID);
$stmt->execute();
$modules = $stmt->fetchAll();

$stmt = $con->prepare("SELECT COUNT(modul.Bezeichnung) AS ModAnz, modul.Bezeichnung, beinhaltet.Semester FROM student
INNER JOIN studiengang ON student.Studi_ID = studiengang.Studi_ID
INNER JOIN beinhaltet ON studiengang.Studi_ID = beinhaltet.Studi_ID
INNER JOIN modul ON beinhaltet.Modul_ID = modul.Modul_ID
INNER JOIN veranstaltung ON Modul.Modul_ID = veranstaltung.Modul_ID
WHERE student.Martikelnummer = :userID
GROUP BY modul.Bezeichnung
ORDER BY modul.Modul_ID");
$stmt->bindParam('userID', $userID);
$stmt->execute();
$getModuleAnz = $stmt->fetchAll();

$stmt = $con->prepare("SELECT COUNT(beinhaltet.Modul_ID) AS AnzMod FROM beinhaltet
INNER JOIN studiengang ON beinhaltet.Studi_ID = studiengang.Studi_ID
INNER JOIN student ON studiengang.Studi_ID = student.Studi_ID
WHERE student.Martikelnummer = :userID");
$stmt->bindParam('userID', $userID);
$stmt->execute();
$anzModInStudi = $stmt->fetchAll();
?>