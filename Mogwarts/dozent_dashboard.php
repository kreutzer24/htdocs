<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dozent Dashboard</title>
    <link rel="stylesheet" href="../Style/style.css">
</head>

<body>
    <header>
        <a href=""><img src="../img/uni.png"></a>
        <h2 class="logo">MOGWARTS UNIVERSITY</h2>
        <nav class="navigation">
            <a href="login.php">Logout</a>
        </nav>
    </header>

    <div class="container">
        <h1>Willkommen, Dozent!</h1>

        <!-- Search Form -->
        <form action="search_students.php" method="GET">
            <label for="search">Search Students:</label>
            <input type="text" id="search" name="search">
            <button type="submit">Search</button>
        </form>
    </div>

</body>

</html>
<?php
require("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
   
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];

       
        $sql = "SELECT * FROM student WHERE Vorname LIKE '%$search%' OR Name LIKE '%$search%'";

        $result = $con->query($sql);

        
        if ($result->num_rows > 0) {
      
            echo "<h2>Such ergebnis:</h2>";
            while ($row = $result->fetch_assoc()) {
                echo "<p>Name: " . $row["Vorname"] . " " . $row["Name"] . "</p>";
                
            }
        } else {
            echo "nichts vorhanden.";
        }
    } else {
        echo "keine passende eingabe";
    }
}

$con->close();
?>
