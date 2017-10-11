<?php

session_start();
$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";

// Create connection
$link = new mysqli($servername, $username, $password, $dbname);
// Check connection

$dayArr = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$timeArr = array("Breakfast","Lunch","Dinner");

if ($link->connect_error) {
   die("Connection failed: " . $link->connect_error);
}

$numDay = count($dayArr);
for($i=0;$i<$numDay;$i++){
	for($j = 0;$j<3;$j++){

		$sql = "INSERT INTO menu (day ,time ,food)"
			. "VALUES ('$dayArr[$i]', '$timeArr[$j]' ,'template')";
	
		if ($link->query($sql) === TRUE) {
			$_SESSION['message'] = "Registration Successful!, added $dayArr[$i]:$timeArr[$j] to database";
		   	echo "New record created successfully";
		} else {
			echo "Error : " . $sql . "<br>" . $link->error;
		}
		echo "<br>";
	}
}

$link->close();

?>
