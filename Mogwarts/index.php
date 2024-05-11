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
        require ("connection.php");
        session_start();

        if (isset($_POST["submit"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $_SESSION["username"] = $username;
            

            $stmt = $con->prepare("SELECT * FROM benutzer WHERE Benutzername = :username");
            $stmt->bindParam('username', $username);
            echo "username: $username";
            $stmt->execute();
            //printf("Error: %s.\n", $stmt->error);
            //$result = $stmt->get_result();
            $userExists = $stmt->fetchAll();

            $stmt = $con->prepare("SELECT * FROM benutzer WHERE Benutzername = :username");
            $stmt->bindParam("username", $username);
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as $row)
            {
                if ($row["Benutzername"] == $row["Benutzername"])
                {
                    session_start();
                    $_SESSION["user"] = $row["user"];

                    header("ladebalken.html");
                    exit;
                }
            }

            if ($userExists) {
                print_r($userExists);
                $passwordHashed = $userExists[0]["Passwort"];
            } else {
                echo "Benutzer existiert nicht";
            }
            //$stmt->close();

            $checkPassword = password_verify($password, $passwordHashed);

            if ($checkPassword === false) {
                echo "Login fehlgeschlagen, Passwort stimmt nicht überein!";
            }
            if ($checkPassword === true) {
                header("Location: homepage.php");
            }
            
        }

        ?>
        <form action="index.php" method="POST">
            <h1>Einloggen</h1>
            <div class="input_container">
                <input type="text" placeholder="Benutzername" name="username" autocomplete="off">
                <input type="text" placeholder="Passwort" name="password" autocomplete="off">
            </div>
            <button class="knopf" name="submit">Einloggen</button>
            <button class="knopf" name="redirect">Regestrieren</button>
        </form>
</body>

</html>