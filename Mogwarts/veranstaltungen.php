<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veranstaltungen</title>
    <link rel="stylesheet" href="../STyle/styleveranstaltung.css">
</head>

<body>

<div class="container">
    <header>
        <h1>Veranstaltungen</h1>
        <nav class="navigation">
            <a href="ladebalken.html">Home</a>
        </nav>
    </header>

    <main>
        <table>
            <tr>
                <th>Veranstaltung</th>
                <th>CP</th>
                <th>Art</th>
                <th>Beschreibung</th>
            </tr>
            <?php
            // Verbindung zur Datenbank herstellen
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mogwartsuni_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Überprüfen, ob die Verbindung erfolgreich hergestellt wurde
            if ($conn->connect_error) {
                die("Verbindung fehlgeschlagen: " . $conn->connect_error);
            }

            // SQL-Abfrage ausführen, um alle Veranstaltungen mit ihrer Art und Beschreibung abzurufen
            $sql = "SELECT v.Bezeichnung AS Veranstaltung, v.CP, va.Art, va.Beschreibung 
                    FROM veranstaltung v
                    INNER JOIN veranstaltungsart va ON v.Art_ID = va.Art_ID";
            $result = $conn->query($sql);

            // Schließen Sie die Datenbankverbindung nicht, da wir sie weiterhin für die Ausgabe benötigen.

            // Überprüfen, ob Ergebnisse zurückgegeben wurden
            if ($result->num_rows > 0) {
                // Ausgabe der Daten für jede Veranstaltung
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["Veranstaltung"]) . "</td>
                            <td>" . htmlspecialchars($row["CP"]) . "</td>
                            <td>" . htmlspecialchars($row["Art"]) . "</td>
                            <td class='description'>" . htmlspecialchars($row["Beschreibung"]) . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Keine Veranstaltungen gefunden.</td></tr>";
            }
            ?>
        </table>
    </main>
</div>

</body>

</html>
