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
$exist = "";
if($_SERVER["REQUEST_METHOD"]== "POST"){
	if(strcmp($_POST['password'],$_POST['confirmPassword']) == 0){
		$invalidEmail="";
		$user=$link->real_escape_string($_POST['username']);
		$email=$link->real_escape_string($_POST['email']);

		 $id1 = $link->query("SELECT id FROM messRegister WHERE email='$email'");
        if( $id1->num_rows ==0)
        {
		   if(preg_match("/[a-zA-Z0-9]+@iitrpr\.ac\.in$/i",$email)){			
				$_SESSION['email'] = $email;
				$pass=sha1($_POST['password']);
				// for email verification in future, do hash check
				$hashCheck=md5(rand(0,1000));
				$_SESSION["password"] = $pass;
			//	$sql = "INSERT INTO messRegister (name, email ,password) "
				//. "VALUES ('$user', '$email' ,'$pass')";
				#set session to display
				$_SESSION['username'] = $user;
				
				if ($link->query($sql) === TRUE) {
					$_SESSION['message'] = "Registration Successful!, added $user to database";
	    				echo "New record created successfully";
				//	header("location: welcome.php");
				} else {
		    			echo "Error : " . $sql . "<br>" . $link->error;
				}
					header("location:AfterRegistration.php");
					//$link->close();
			} 
			else {
				$_SESSION['message'] = 'Invalid Request';
                $InvalidEmail="Sorry, its only for IIT ropar people.";
				session_unset();session_destroy();
				$link->close();
			}
	    }
		else{
			$exist = "USER ALREADY EXISTS";
		}
	}
	else{
		// remove link and session variables
		$link->close();
		session_unset();session_destroy();
		$_SESSION['message'] = 'passwords do not match!';
		$passwordNotMatches="Two passwords didn't matched\n";
	}
} else {session_unset();session_destroy();$link->close();}	// remove session variables if user is not registering;
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
	<form action="register.php" class="registerForm" method="post">
		<h1 class="Register">Register</h1>
		<br>
		<input type="text" class="username" name="username" autocomplete="off" placeholder="User Name" required="">
		<br>
		<input type="email" class="EmailInput" name="email" autocomplete="off" placeholder="Email" required="">
		<br>
		<input type="password" class="password" name="password" placeholder="Password" required="">
		<br>
		<input type="password" class="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required="">
		<br>
		<button type="submit" class="submit" value=""><span>Submit</span></button>
		<br>
		<span class="error"  style="color:rgb(250,50,50) ; font-size:17px ; font-weignt : 100;"><?php echo $passwordNotMatches;?></span>
		<span class="error"  style="color:rgb(250,50,50) ; font-size:17px ; font-weignt : 100;"><?php echo $InvalidEmail;?></span>
		<span class="error"  style="color:rgb(250,50,50) ; font-size:17px ; font-weignt : 100;"><?php echo $exist;?></span>
		</form>	
</div>
</body>
</html>
