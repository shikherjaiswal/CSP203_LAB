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
$sql = "CREATE TABLE adminTable (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,adminName VARCHAR(30) NOT NULL,adminEmail VARCHAR(100) NOT NULL,password VARCHAR(50) NOT NULL, isPortalClosedToday BOOL default 0)";

if ($conn->query($sql) === TRUE) {
    echo "Table adminTable created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?> 
