<?php

$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE menu (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,day VARCHAR(10) NOT NULL,time VARCHAR(12) NOT NULL,food VARCHAR(100) NOT NULL)";

if ($conn->query($sql) === TRUE) {
    echo "Table menu created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?> 
