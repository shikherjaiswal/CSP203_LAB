
<?php
session_start();

if(isset($_SESSION['email'])){
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

	$name = $_SESSION['name'];
	$email=$_SESSION['email'];
//	$passw = 'shikhar';
	$message = '
	Thanks for signing up!
	Your account has been created, Create New Password';
	//echo $name;
	//echo $email;
	
	       
	       

			
		  if($_SERVER["REQUEST_METHOD"]== "POST"){
		  //echo " dwbjfdbwf <br> ";
          $id = $link->query("SELECT id FROM newRequests WHERE email='$email'");
          
          if($id->num_rows == 0){
               echo "$message <br> ";
	        if(strcmp($_POST['password'] ,$_POST['confirmPassword'])==0){
				$passw =$_POST['password'];
			   }
		          $pass=sha1($passw);
			      $sql = "INSERT INTO newRequests (name,email,password) "
				. "VALUES ('$name','$email' ,'$pass')";
				if ($link->query($sql) === TRUE) {
					$_SESSION['message'] = "Registration Successful!";
					 header("location:http://localhost:80/ZEUS/home.html");
				} else {
    				echo "Error : " . $sql . "<br>" . $link->error;
				}
				}
		else { 
			 $_SESSION['message'] = "Request Already sent for Admin Approval";
			 header("location:http://localhost:80/ZEUS/home.html");
	     	$link->close();
        }
   }
	// echo "<br>Session Expired, Login Again.";
	 //$redi='http://localhost:80/ZEUS/home.html';
	 //header('Location: ' . filter_var($redi, FILTER_SANITIZE_URL));
	 session_unset();
	 session_destroy();

	 echo "<br><br><a class='logout' href='http://localhost:80/ZEUS/home.html'>Logout</a><br><br>";


}
else{
	 
	session_unset();
	session_destroy();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<body style="text-align:center;">
<div id="registerBack"></div>
<div id="register">
	<form action="AfterReg.php" class="registerForm" method="POST">
		<h1 class="Register">Create New Password</h1>
		<br>
		<input type="password" class="password" name="password" placeholder="Password" required="">
		<br>
		<input type="password" class="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required="">
		<br>
		<button type="submit" class="submit" value=""><span > Submit </span></button>
		<br>
		
		<span class="error"  style="color:rgb(250,50,50) ; font-size:17px ; font-weignt : 100;"><?php echo $passwordNotMatches;?></span>
		<span class="error"  style="color:rgb(250,50,50) ; font-size:17px ; font-weignt : 100;"><?php echo $InvalidEmail;?></span>
</form>	
</div>

</body>
</html>
