<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogInPage</title>
    <link rel="stylesheet" href="../Style/stylelogin.css">
</head>
<header>
    <a  href=""><img src="../img/uni.png"></a>
    <h2 class="logo">MOGWARTS UNIVERSITY</h2>
    <nav class="navigation">
        <a href="ladebalken.html">Home</a> 

    </nav>
</header>



<body>
    <div class="umrandung">
        <?php
require("connection.php");
session_start();

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $con->prepare("SELECT * FROM benutzer WHERE Benutzername = :username");
    $stmt->bindParam('username', $username);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($result) {
        $passwordHashed = $result["Passwort"];
        $checkPassword = password_verify($password, $passwordHashed);

        if ($checkPassword === true) {
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $result["Roll_ID"]; // Speichere die Rolle des Benutzers in der Sitzung

            if ($_SESSION["role"] == 1) {
                header("Location: student_dashboard.php");
                exit;
            } elseif ($_SESSION["role"] == 2) {
                header("Location: dozent_dashboard.php");
                exit;
            } elseif ($_SESSION["role"] == 3) {
                header("Location: admin_dashboard.php");
                exit;
            } else {
                echo "Unbekannte Benutzerrolle";
                exit;
            }
        } else {
            echo "Login fehlgeschlagen, Passwort stimmt nicht überein!";
        }
    } else {
        echo "Benutzer existiert nicht";
    }
}
?>

        <form action="index.php" method="POST">
            <h1>Einloggen</h1>
            <div class="input_container">
                <input type="text" placeholder="Benutzername" name="username" autocomplete="off">
                <input type="password" placeholder="Passwort" name="password" autocomplete="off">
            </div>
            <button class="knopf" name="submit">Einloggen</button>
        </form>
</body>

</html>