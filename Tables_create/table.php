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
$sql = "CREATE TABLE messRegister (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(30) NOT NULL,email VARCHAR(100) NOT NULL,password VARCHAR(50) NOT NULL,bArrival BOOL DEFAULT 1,lArrival BOOL DEFAULT 1,dArrival BOOL DEFAULT 1,monthlyBill INT(6) DEFAULT 0,portalActive BOOL DEFAULT 0,isActive BOOL DEFAULT 0,bMultiplier INT(6) DEFAULT 1,lMultiplier INT(6) DEFAULT 1,dMultiplier INT(6) DEFAULT 1)";

if ($conn->query($sql) === TRUE) {
    echo "Table messRegister created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?> 
