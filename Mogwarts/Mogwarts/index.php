<?php
require ("connection.php");
session_start();

if(isset($_POST["submit"]))
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $con->prepare("SELECT * FROM benutzer WHERE Benutzername = ?");
    $stmt->bind_param('s', $username);
    echo "username: $username";
    $stmt->execute();
    printf("Error: %s.\n", $stmt->error);
    $result = $stmt->get_result();
    $userExists = $result->fetch_assoc();

    if($userExists)
    {
        print_r($userExists);
        $passwordHashed = $userExists['Passwort'];
    }else
    {
        echo "Benutzer existiert nicht";
    }$stmt->close();

    $checkPassword = password_verify($password, $passwordHashed);

    if($checkPassword === false)
    {
        echo "Login fehlgeschlagen, Passwort stimmt nicht überein!";
    }
    if($checkPassword === true)
    {
        header("Location: homepage.php");
    }
}

?>

<html lang= "de">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LogInPage</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form action="login.php" method="POST">
            <h1>Einloggen</h1>
            <div class="input_container">
                <input type="text" placeholder="Benutzername" name="username" autocomplete="off">
                <input type="text" placeholder="Passwort" name="password" autocomplete="off">
            </div>
            <button name="submit">Einloggen</button>
            <button name="redirect">Regestrieren</button>
        </form>
    </body>
</html>