<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regestrierung</title>
    <link rel="stylesheet" href="styleregister.css">
</head>
</html>

<?php
switch($Benutzer['Roll_ID'])
{
    case 1:

        echo ("<a href='index.php'>Abmelden</a> </br>");
        echo ("<a href= StudentInfo.php?ID=$Benutzer[Matrikelnummer]>Profil</a></td>");
        echo ("<a href='event.php'>Module und Veranstaltungen</a> </br>");
        echo ("<a href='Studigänge.php'>Alle Studiengänge und Veranstaltungen</a> </br>");

        $query = "SELECT SUM(CP) AS GESCP
        FROM student_konver
        INNER JOIN konkrete_veranstaltung ON student_konver.konVer_ID = konkrete_veranstaltung.KonVer_ID
        INNER JOIN veranstaltung ON konkrete_veranstaltung.Veranstaltungs_ID = veranstaltung.veranstaltungs_ID
        WHERE student_konver.Matrikelnummer = " . $Benutzer['Matrikelnummer'];
        $result = $db->execute_query($query);
   
        foreach($result as $row)
        {
            echo("Gesamte CP:" .$row["GESCP"]."</br>");
        }
       

        $query = "SELECT modul.Bezeichnung AS MBEZ, dozent.Name, Konkrete_veranstaltung.Datum
        FROM veranstaltung
        INNER JOIN modul ON modul.Modul_ID = veranstaltung.Modul_ID
        INNER JOIN konkrete_veranstaltung ON konkrete_veranstaltung.Veranstaltungs_ID = veranstaltung.Veranstaltungs_ID
        INNER JOIN dozent ON dozent.Dozi_ID = konkrete_veranstaltung.Dozi_ID
        INNER JOIN student_konver ON student_konver.KonVer_ID = konkrete_veranstaltung.KonVer_ID
        WHERE veranstaltung.Art_ID = 5 AND student_konver.Matrikelnummer = " .$Benutzer['Matrikelnummer']. " AND student_konver.Note = NULL";
        $result = $db->execute_query($query);  
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
        echo ("<a href='index.php'>Abmelden</a> </br>");
        echo ("<a href='studentlist.php'>Studenten Liste</a> </br>");
        echo ("<a href='Studigänge.php'>Alle Studiengänge und Veranstaltungen</a> </br>");
    break;
    case 3:
        echo ("<a href='index.php'>Abmelden</a> </br>");
        echo ("<a href='register.php'>Neuen Account Registrieren</a> </br>");
        echo ("<a href='studentlist.php'>Studenten Liste</a> </br>");
        echo ("<a href='Studigänge.php'>Alle Studiengänge und Veranstaltungen</a> </br>");                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
   
    break;
}

?>