
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

if($_SERVER["REQUEST_METHOD"]== "POST"){
	$userInput = $_POST['email'];
	$id = $link->query("SELECT id FROM messRegister WHERE email='$userInput'");
	if($id->num_rows == 0){
               	$InvalidUser="*No such user.";
	}
	else {
	    $sql = "select * from messRegister where email = '$userInput'";
        $res = $link->query($sql);
        while($row=$res->fetch_assoc()){
            //echo $row['password'];
		     $passw = $row['password'];
        }
		
		//$pass = $link->query("SELECT password FROM messRegister WHERE email='$userInput'");
		$passwordInput = sha1($_POST['password']);
		//echo "$passwordInput";
		if(strcmp($passw, $passwordInput)==0){
			$_SESSION['email'] = $userInput;
			
			//print "LOGGED IN";
			header("location:user.php");	
		}
		else {
			$passwordNotCorrect="*Incorrect password.";
			session_unset();session_destroy();$link->close();
		}
		
	}
} 
else {session_unset();session_destroy();$link->close();}	// remove session variables if user is not registering;
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
	<form action="login.php" class="registerForm" method="post">
		<h1 class="Register">Log In</h1>
		<br>
		<input type="text" class="username" name="email" autocomplete="off" placeholder="email id" required="">
		<br>
		<input type="password" class="password" name="password" placeholder="Password" required="">
		<br>
		<button type="submit" class="submit" value=""><span>Submit</span></button>
		<br>
		<span class="error"  style="color:rgb(250,50,50) ; font-size:17px ; font-weignt : 100;"><?php echo $passwordNotCorrect;?></span>
		<span class="error"  style="color:rgb(250,50,50) ; font-size:17px ; font-weignt : 100;"><?php echo $InvalidUser;?></span>
	</form>	
</div>
</body>
</html>
