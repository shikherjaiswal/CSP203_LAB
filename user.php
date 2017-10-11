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

if(isset($_SESSION["email"])){
    $msg = $_SESSION["msg"];
}

?>





<!DOCTYPE html>
<html>
<head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<body style="text-align:center;">
<p style="font-size:92px;font-weight: 400;color: black;">Welcome</p>
<div class = "user">
<a href="monthlyBill.php" class="linktologin">Monthly Bill</a>
<a href="DailyMenu.php" class="linktologin">Today's Menu</a>
</div>
<a href="weeklyMenuUser.php">Weekly Menu</a>
<a href="changePassword.php">Change Password</a>
<a href="actDeact.php">Activate/Deactivate</a>
<a href="https://docs.google.com/forms/d/e/1FAIpQLSedC33yZDXCdyOdP1_-lEPsZgjft4o9c81VAxp5AKKpwcuGtw/viewform">Feedback</a>
<a class='logout' href='http://localhost:80/ZEUS/logout.php'>Logout</a>
<br><br>
<?php echo $msg;?>
</body>
</html>
