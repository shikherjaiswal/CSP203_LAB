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
if(isset($_SESSION['name']) && (strcmp($_SESSION['name'],"Admin") == 0)){
		if($_SERVER["REQUEST_METHOD"]== "POST"){
			if(strcmp($_POST['password'],$_POST['confirmPassword']) == 0){
				$invalidEmail="";
				$user=$link->real_escape_string($_POST['username']);
				$email=$link->real_escape_string($_POST['email']);

				// checking Secondary admin exist or not 
				 $id1 = $link->query("SELECT id FROM adminTable WHERE adminName='$user'");
		          if( $id1->num_rows ==0)
		          {
				   if(1){
						   // $_SESSION['name'] = $user;			
							//$_SESSION['email'] = $email;
							$pass=sha1($_POST['password']);
							// for email verification in future, do hash check
							//$_SESSION["password"] = $pass;
						    $sql = "INSERT INTO adminTable (adminName, adminEmail ,password) "
							. "VALUES ('$user', '$email' ,'$pass')";
							$link->query($sql);
							#set session to display
							
							if ($link->query($sql) === TRUE) {
								$_SESSION['message'] = "Registration Successful!, added secondary admin : $user to database";
				    			echo "New record created successfully";
							//	header("location: welcome.php");
							} else {
					    			echo "Error : " . $sql . "<br>" . $link->error;
							}
							header("location:admin.php");
								//$link->close();
					}
					 else {
					        $_SESSION['message'] = 'Invalid Request';
		                	$InvalidEmail="Sorry, its only for IIT ropar people.";
					        $link->close();
				     }
				}
				else
				{
						$exist = "This Admin already exists";
				}
			}
			else{
				// remove link and session variables
				$link->close();
				session_unset();session_destroy();
				$_SESSION['message'] = 'passwords do not match!';
				$passwordNotMatches="Two passwords didn't matched\n";
			}
		}
		 else {$link->close();}	// remove session variables if user is not registering;
 	}
 	else{
 		echo "Session Expired, Login Again";
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
	<form action="createAdmin.php" class="registerForm" method="post">
		<h1 class="Register">Create New Admin</h1>
		<br>
		<input type="text" class="username" name="username" autocomplete="off" placeholder="New Admin Name" required="">
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
