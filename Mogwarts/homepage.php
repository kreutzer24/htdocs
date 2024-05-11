<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../Style/stylehomepage.css">
</head>

<body>

    <header>
        <h2 class="logo">MOGWARTS UNIVERSITY</h2>
        <nav class="navigation">
            <a href="index.php">Login<span></span></a>
            <a href="veranstaltungen.php">Veranstaltungen</a> 
        </nav>
    </header>

    
    <div class="scrollable-section">
        <img src="../img/Uni2.png" alt="Mogwarts University">
    </div>

 
    <div class="footer-text">
        <h1>Willkommen bei Mogwarts University!</h1>
        <p>
            
        </p>
    </div>

    <script>
        window.addEventListener('scroll', function () {
            const footerText = document.querySelector('.footer-text');
            const scrollableSection = document.querySelector('.scrollable-section');
            const scrollableSectionBottom = scrollableSection.getBoundingClientRect().bottom;

            if (scrollableSectionBottom <= window.innerHeight) {
                footerText.classList.add('visible');
            } else {
                footerText.classList.remove('visible');
            }
        });
    </script>

</body>

</html>

<?php
require "connection.php";
session_start();

// $stmt = $con->prepare("SELECT ID FROM benutzer WHERE Benutzername = :username");
// $stmt->bindParam('username', $_SESSION["username"]);
// $stmt->execute();
// $userData = $stmt->fetchColumn(1);
// $userID = $userData['ID'];

// $stmt = $con->prepare("SELECT Matrikelnummer FROM student 
// INNER JOIN student ON benutzer.ID = student.ID
// WHERE student.ID = :userID");
// $stmt->bindParam('userID', $userID);
// $stmt->execute();
// echo "userID: $userID";
?>
