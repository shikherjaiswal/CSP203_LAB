<?php
$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM menu";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $i=0;

    $print = "<tr><th></th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th></tr>";
    $print = $print."<tr><th>Breakfast</th>";
    
    $food = "SELECT food FROM menu WHERE time='Breakfast'";
    $foodresult=$conn->query($food);
    if($foodresult->num_rows>0){
	while($row=$foodresult->fetch_assoc()){
	    $print = $print."<th>".$row['food']."</th>";
	}
    $print=$print."</tr>";
    } 

    $print=$print."<tr><th>Lunch</th>";
    $food = "SELECT food FROM menu WHERE time='Lunch'";
    $foodresult=$conn->query($food);
    if($foodresult->num_rows>0){
	while($row=$foodresult->fetch_assoc()){
	    $print=$print. "<th>".$row['food']."</th>";
	}
    $print=$print. "</tr>";
    }

    $print=$print. "<tr><th>Dinner</th>";
    $food = "SELECT food FROM menu WHERE time='Dinner'";
    $foodresult=$conn->query($food);
    if($foodresult->num_rows>0){
	while($row=$foodresult->fetch_assoc()){
	    $print=$print. "<th>".$row['food']."</th>";
	}
    $print=$print. "</tr>";
    }

   
} else {
    echo "0 results";
}
$conn->close();
?> 



<!DOCTYPE html>
<html>
<head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<body>
<a class='logout' href='http://localhost:80/ZEUS/logout.php'>Logout</a>
<a class='home' href='http://localhost:80/ZEUS/admin.php'>Home</a>
<div id="tableBack"></div>
<table><?php echo $print;?>
</table>
</body>
</html>







