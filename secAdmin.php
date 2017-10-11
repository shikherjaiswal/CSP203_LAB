<?php
session_start();
$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";
$msg = $_SESSION['message'];
?>


<!DOCTYPE html>
<html>
<head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<body style="text-align:center;">
<p style="font-size:92px;font-weight: 400;color: black;">Guest House Mess</p>
<a href="updateMenu.php" class="linktologin">Update Menu</a>
<a href="newRequests.php" class="linktologin">Pending Requests</a>
<a href="openClosePortal.php" class="linktologin">Open/Close Portal</a>
<a href="seeMonthlyBill.php" class="linktologin">Monthly Bills</a>
<a href="changePasswordAdmin.php" class="linktologin">Change Password</a>
<a href="peopleComing.php" class="linktologin">People Coming</a>
<a href="removeUser.php" class="linktologin">Remove User</a>
<a href="createAdmin.php" class="linktologin">Add Admin</a>
<a href="weeklyMenu.php">Weekly Menu</a>

<a class='logout' href='http://localhost:80/ZEUS/logout.php'>Logout</a><br><br><br>
<?php echo $msg;?>
</body>
</html>

