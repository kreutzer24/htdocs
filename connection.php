
<?php
$dsn = 'mysql:dbname=mogwartsuni_db; host=localhost';
$username = 'root';
$password = '';

$con = new PDO($dsn, $username, $password);
//Check connection
if(!$con)
{
    die("Connection failed:" .mysqli_connect_error());
}
/*echo 'Connection established';*/
?>
