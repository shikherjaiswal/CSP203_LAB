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
$sql = "CREATE TABLE newRequests (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(30) NOT NULL,email VARCHAR(100) NOT NULL,password VARCHAR(50) NOT NULL)";

if ($conn->query($sql) === TRUE) {
    echo "Table newRequests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?> 
