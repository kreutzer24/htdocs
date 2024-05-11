<h1>Dein Profil</h1>
<?php
//original: "Profil.php"
require "connection.php";
session_start();
$_SESSION["CurrentUser"];
$userID = $_GET["ID"];
echo "$userID";

$stmt = $con->prepare("SELECT student.Matrikelnummer, student.Vorname, student.Name, student.Geburtsdatum, student.Geschlecht, student.Konfession, student.Staatsangehörigkeit, studiengang.Bezeichnung, adresse.Straße, adresse.Hausnummer, plz.PLZ, plz.Ort
FROM student
INNER JOIN studiengang ON student.Studi_ID = studiengang.Studi_ID
INNER JOIN adresse ON student.Adress_ID = adresse.Adress_ID
INNER JOIN PLZ ON plz.PLZ = adresse.PLZ
WHERE student.Matrikelnummer = :userID");
$stmt->bindParam("userID", $userID);
$stmt->execute();
$studentData = $stmt->fetchAll();
$_SESSION["CurrenUser"] = $stmt->fetchAll();
print_r($studentData);


echo("<p>Matrikelnummer: ".$studentData["Matrikelnummer"]."</p>");
echo("<p>Vorname: ".$studentData["Vorname"]."</p>");
echo("<p>Nachname: ".$studentData["Nachname"]."</p>");
echo("<p>Geburtsdatum: ".$studentData["Geburtsdatum"]."</p>");
echo("<p>Geschlecht: ".$studentData["Geburtsdatum"]."</p>");
echo("<p>Konfession: ".$studentData["Konfession"]."</p>");
echo("<p>Staatsangehörigkeit: ".$studentData["Staatsangehörigkeit"]."</p>");
echo("<p>Studiengang: ".$studentData["Studiengang"]."</p>");
echo("<p>Adresse: ".$studentData["Adresse"]."</p>");

$stmt = $con->prepare("SELECT SUM(CP) AS GESCP FROM student_konver
INNER JOIN konkrete_veranstaltung ON student_konver.KonVer_ID = konkrete_veranstaltung.KonVer_ID
INNER JOIN veranstaltung ON konkrete_veranstaltung.Veranstaltungs_ID = veranstaltung.Veranstaltung_ID
WHERE student_konver.Matrikelnummer = :userID");
$stmt->bindParam("userID", $userID);
$gesCP = $stmt->fetchColumn();

echo("<p>Gesamte CP: ".$gesCP."</p>");

$stmt = $con->prepare("SELECT student_konver.Note, konkrete_veranstaltung.Datum, veranstaltung.Bezeichnung, veranstaltung.CP FROM student
INNER JOIN student_konver ON student.Matrikelnummer = student_konver.Matrikelnummer
INNER JOIN konkrete_veranstaltung ON student_konver.KonVer_ID = konkrete_Veranstaltung.KonVer_ID
INNER JOIN veranstaltung ON konkrete_veranstalung.Veranstaltungs_ID = veranstaltung.Veranstaltungs_ID
WHERE student.Matrikelnummer = :userID");
$stmt->bindParam("userID", $userID);
$stmt->execute();
$Leistugnen = $stmt->fetchColumn();


for($i = 0; $i < $Leistungen->num_rows(); $i++)
{
    $LeistungenRow = $Leistungen->fetch();
    echo "<br><br>";
    echo $LeistungenRow["Bezeichnung"] . "+++" . $LeistungenRow["Datum"] . "+++" . $LeistungenRow["CP"]. "";
}
?>
<html>
<section class="header">

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</html>