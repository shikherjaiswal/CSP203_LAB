<?php

session_start();
$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";

// Create connection
$link = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($link->connect_error) {
   die("Connection failed: " . $link->connect_error);
}

if(isset($_SESSION['email'])){
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        $email = $_SESSION['email'];
        //echo $email;
        $sql = "select * from messRegister where email = '$email'";
        $res = $link->query($sql);
        while($row=$res->fetch_assoc()){
            //echo $row['password'];
		     $passw = $row['password'];
        }
        //echo $passw;
        if(strcmp(sha1($_POST['oldPassword']),$passw) == 0){
           if(strcmp($_POST['password'],$_POST['confirmPassword']) == 0){
              $p = sha1($_POST['password']);
              $sq = "update messRegister set password = '$p' where email = '$email'";
              $link->query($sq);
              $_SESSION["msg"] =  "<br>Password changed";
              header("location:user.php");
           }
           else{
             $passwordNotMatches =  "Password didn't match";
           }       
       }
       else{
         $passwordNotMatches= "Old password incorrect";
       }
     }
 }    
 ?>



<!DOCTYPE html>
<html>
<head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<body>
<div id="registerBack"></div>
<div id="register">
	<form action="changePassword.php" class="registerForm" method="post">
		<h1 class="Register">Change Password</h1>
		<br>
		<input type="password" class="oldPassword" name="oldPassword" autocomplete="off" placeholder="Old Password" required="">
		<br>
		<input type="password" class="password" name="password" placeholder="New Password" required="">
		<br>
		<input type="password" class="confirmPassword" name="confirmPassword" placeholder="Confirm New Password" required="">
		<br>
		<button type="submit" class="submit" value=""><span>Submit</span></button>
		<br>
		<span class="error"  style="color:rgb(250,50,50) ; font-size:17px ; font-weignt : 100;"><?php echo $passwordNotMatches;?></span>
		</form>	
</div>
</body>
<a class='home' href='http://localhost:80/ZEUS/user.php'>Home</a>
</html>
