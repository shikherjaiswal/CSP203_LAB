<?php
session_start();
$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";
$msg = $_SESSION['message'];
if(isset($_SESSION['name'])){
    $n = $_SESSION['name'];
    if(strcmp($n,"Admin") == 0){
        $print1 = "<a href=\"newRequests.php\" class=\"linktologin\">Pending Requests</a>";
        $print2 = "<a href=\"seeMonthlyBill.php\" class=\"linktologin\">Monthly Bills</a>";
        $print3 = "<a href=\"removeUser.php\" class=\"linktologin\">Remove User</a>";
        $print4 = "<a href=\"createAdmin.php\" class=\"linktologin\">Add Admin</a>";
        $print5 = "<a href=\"https://docs.google.com/spreadsheets/d/1NjxKFmorVj5YqL_89casUuQBiHJVU9hggnk5bdXSWLI/edit#gid=1338500510\" class=\"linktologin\">View Feedback</a>";
    }
    else{
        ;
    }

}
else {
    echo "Please Login Again";
    header("location:home.html");

}
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
 <?php echo $print1;?>
<a href="openClosePortal.php" class="linktologin">Open/Close Portal</a>
    <?php echo $print2;?>
<a href="changePasswordAdmin.php" class="linktologin">Change Password</a>
<a href="peopleComing.php" class="linktologin">People Coming</a>
    <?php echo $print3;?>
    <?php echo $print4;?>
    <?php echo $print5;?>
<a href="weeklyMenu.php">Weekly Menu</a>
<a class='logout' href='http://localhost:80/ZEUS/logout.php'>Logout</a><br><br><br>
<?php echo $msg;?>
</body>
</html>
