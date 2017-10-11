<?php
session_start();
if(isset($_SESSION['username'])){
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

$user = $_SESSION["username"];
$email = $_SESSION["email"];
$pass = $_SESSION["password"];

$otp = $_SESSION["OTP"];
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        $enteredOtp = $_POST["username"];
        if(strcmp($otp,$enteredOtp) == 0){
            
            echo "REQUEST SENT TO GUEST HOUSE FOR APPROVAL<br>";
          $id = $link->query("SELECT id FROM newRequests WHERE email='$email'");
          if($id->num_rows == 0)
          {
            $sql = "INSERT INTO newRequests (name,email,password) "
			. "VALUES ('$user','$email','$pass')";
				if ($link->query($sql) === TRUE) {
					$_SESSION['message'] = "Registration Successful!";
				} else {
    				echo "Error : " . $sql . "<br>" . $link->error;
				}
			}
			else
			{
			echo "REQUEST ALREADY SENT TO GUEST HOUSE FOR APPROVAL";
			}
			header("location:home.html");        
        }
        else{
            echo "Verification Failed<br>";
        }
    }


}
else {
    echo "Connection Error";
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<body style="text-align:center;">
An OTP has been sent to your email id.<br>
Enter OTP:<br> 
<form action="verify.php" method="POST">
   	<input type="text" class="username" name="username" autocomplete="off" placeholder="OTP" required=""><br>
    <button type="submit" class="submit" value=""><span>Confirm</span></button>
</form>
</body>
</html>
