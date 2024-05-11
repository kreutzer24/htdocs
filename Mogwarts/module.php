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

// SQL-Abfrage ausführen, um alle Module abzurufen
$sql = "SELECT Bezeichnung FROM modul";
$result = $conn->query($sql);

// Schließen Sie die Datenbankverbindung nicht, da wir sie weiterhin für die Ausgabe benötigen.
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module</title>
    <link rel="stylesheet" href="../Style/stylemodule.css">
</head>

<body>

<header>
    <h1>Module</h1>
    <nav class="navigation">
        <a href="ladebalken.html">Home</a>
    </nav>
</header>

<main>
    <div class="table-container">
        <table>
            <tr>
                <th>Bezeichnung</th>
            </tr>
            <?php
            // Überprüfen, ob Ergebnisse zurückgegeben wurden
            if ($result->num_rows > 0) {
                // Ausgabe der Daten für jedes Modul
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["Bezeichnung"]) . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='1'>Keine Module gefunden.</td></tr>";
            }
            ?>
        </table>
    </div>
</main>

</body>

</html>
