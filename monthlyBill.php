<?php
session_start();
 // include('header.php');
$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";
$link = new mysqli($servername, $username, $password, $dbname);
if ($link->connect_error) {
   die("Connection failed: " . $link->connect_error);
 
}


if(isset($_SESSION['email'])){
	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
	$id = $link->query("SELECT id FROM messRegister WHERE email ='$email'");
	if($id->num_rows == 0){echo "Invalid user";}
	else{
		$bill = $link->query("SELECT monthlyBill FROM messRegister WHERE email='$email'");
		//echo "Your monthly bill is : ".$bill;
		while($row=$bill->fetch_assoc()){
				  //$a = $row["monthlyBill"];
			      echo "Your Bill is Rs ".$row["monthlyBill"];
				  //echo $row["name"];
				 }   
	}
}

else {
	echo "Login again!!!";
}


?>
<html>
<head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<body>
<a class='logout' href='http://localhost:80/ZEUS/logout.php'>Logout</a>
<a class='home' href='http://localhost:80/ZEUS/user.php'>Home</a>
</body>
</html>
