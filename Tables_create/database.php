<?php 
$servername="localhost";
$username="cyborg";
$password="toor";

//create connection
$link = new mysqli($servername,$username,$password);

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

// Create database
$sql = "CREATE DATABASE lab";
if ($link->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $link->error;
}

$link->close();

?>
