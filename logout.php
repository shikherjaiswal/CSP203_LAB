<?php
session_start();
$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";
$link = new mysqli($servername, $username, $password, $dbname);

if ($link->connect_error) {
   die("Connection failed: " . $link->connect_error);
 
}

if (isset($_SESSION["email"]) || isset($_SESSION['name']) ){
    session_unset();
    session_destroy();
    $link->close();
}
else{
    session_unset();
    session_destroy();
    $link->close();
}

header('location:home.html');

?>
