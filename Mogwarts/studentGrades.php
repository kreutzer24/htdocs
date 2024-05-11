<head>
stylesheet hier einfügen
</head>

<h1>Modulübersicht</h1>
<?php
//original: "Stud_Noten.php" -
define ("ROOTH","http://localhost/Mogwarts_db");
require "connection.php";
session_start();

$stmt = $con->prepare("SELECT veranstaltung.Veranstaltungs_ID, veranstaltung.Bezeichnung, veranstaltungsart.Art, veranstaltung.CP, student_konver.Note
FROM student
INNER JOIN studiengang ON student.Studi_ID = studiengang.Studi_ID
INNER JOIN beinhaltet ON studiengang.Studi_ID = beinhaltet.Studi_ID
INNER JOIN modul ON beinhaltet.Modul_ID = modul.Modul_ID
INNER JOIN veranstaltung ON Modul.Modul_ID = veranstaltung.Modul_ID
INNER JOIN veranstaltungsart ON veranstaltung.Art_ID = veranstaltungsart.Art_ID
LEFT JOIN konkrete_veranstaltung ON veranstaltung.Veranstaltungs_ID = konkrete_veranstaltung.Veranstaltungs_ID
LEFT JOIN student_konver ON konkrete_veranstaltung.konver_ID = student_konver.konver_ID
WHERE  student.Matrikelnummer = 1
GROUP BY veranstaltung.Veranstaltungs_ID
ORDER BY modul.Modul_ID");
//$stmt->bindParam('userID', $userID);
$stmt->execute();
$modules = $stmt->fetchAll();

$stmt = $con->prepare("SELECT COUNT(modul.Bezeichnung) AS ModAnz, modul.Bezeichnung, beinhaltet.Semester FROM student
INNER JOIN studiengang ON student.Studi_ID = studiengang.Studi_ID
INNER JOIN beinhaltet ON studiengang.Studi_ID = beinhaltet.Studi_ID
INNER JOIN modul ON beinhaltet.Modul_ID = modul.Modul_ID
INNER JOIN veranstaltung ON Modul.Modul_ID = veranstaltung.Modul_ID
WHERE student.Matrikelnummer = 1
GROUP BY modul.Bezeichnung
ORDER BY modul.Modul_ID");
//$stmt->bindParam('userID', $userID);
$stmt->execute();
$getModuleAnz = $stmt->fetchAll();

$stmt = $con->prepare("SELECT COUNT(beinhaltet.Modul_ID) AS AnzMod FROM beinhaltet
INNER JOIN studiengang ON beinhaltet.Studi_ID = studiengang.Studi_ID
INNER JOIN student ON studiengang.Studi_ID = student.Studi_ID
WHERE student.Matrikelnummer = 1");
//$stmt->bindParam('userID', $userID);
$stmt->execute();
$anzModInStudi = $stmt->fetchAll();

echo "<pre>";
print_r($modules);
print_r($getModuleAnz);
echo "</pre>";

$count = 0;
for($i = 0; $i < $anzModInStudi; $i++)
{
    echo "<table>";
    echo "
    <tr class='head'>
        <th class='tophead' colspan='5'> ". $getModuleAnz[$i][1] . " - ". $getModuleAnz[$i][2] .". Semester </th>
    </tr>
    "; 
    echo "
    <tr class='head'>
        <th class='subhead' style='width: 35%;'></th>
        <th class='subhead' style='width: 15%f;'></th>
        <th class='subhead' style='width: 10;'></th>
        <th class='subhead' style='width: 10;'></th>
        <th class='subhead' style='width: 10;'></th>
    </tr>
    ";

    for($j = $count; $j < $getModuleAnz[$i][0] + $count; $j++)
    {
        if($modules[$j][4] != null) $completed = "<img width='24px' src='http://localhost/Style/häckchenbild.svg' alt=''/>";
        else $completed = "<img width='24px src='http://localhost/Style/kreuzchen.svg' alt=''/>";

        echo"
        <tr>
            <td><a href='".ROOTH."anzVeranstaltung?ID=". $modules[$j][0] ."'>". $modules[$j][1]. "</a></td>
            <td>".$modules[$j][2]."</td>
            <td class='center' >".$completed."</td>
            <td class='center' >".$modules[$j][3]."</td>
            <td class='center' >".$modules[$j][4]."</td>
        </tr>
        ";
    }
    echo "</table><br>";
    $count += $getModuleAnz[$i][0];
}

?>