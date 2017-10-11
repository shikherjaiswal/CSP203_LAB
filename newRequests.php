
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

if(isset($_SESSION['name']) && (strcmp($_SESSION['name'],"Admin") == 0)){

		$sql = "SELECT * FROM newRequests";
		$result = $link->query($sql);
		$print = "";
		if ($result->num_rows > 0) {
		    // output data of each row
		    $i=0;
		    $print = "";
			while($row=$result->fetch_assoc()){
				$i++;
			    $buttonSystem = 
		    	"Reject : <label class=\"switch\">
					<input type=\"checkbox\" name=\"YesNo".$i."\" value=\"1\" checked>
		  			<div class=\"slider\"></div>
				</label> : Accept
				<br>
		    	";
			    $print = $print."<tr><th>".$row['name']."</th><th>".$row['email']."</th><th>".$buttonSystem."</th></tr>";
				
			}
		} else {
		    echo "No requests pending today";
		}

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			//$person = $_SESSION['email'];
			$id = $link->query("SELECT id FROM newRequests");
			if($id->num_rows == 0){
		       	$InvalidUser="No Requests Pending Today!!!";
			}
			else{
				$n = 0;
				for($n=1;$n<=$i;$n++){
					$variable = "YesNo".$n;
					//echo "Hi ".$n."<br>";	
					
					$val = $_POST[$variable];
					
					//echo " var : ".$variable;	
					if($val == 1){
						//echo "Hi ".$n."<br>";	
						
						$name = $link->query("SELECT * FROM newRequests WHERE id='$n'");
						//$email = $link->query("SELECT email FROM newRequests WHERE id='$n'");
						//$pass = $link->query("SELECT password FROM newRequests WHERE id='$n'");
						
						while($row=$name->fetch_assoc()){
						  $a = $row["name"];
						  $b = $row["email"];
						  $c = $row["password"];
					      $sql = "INSERT INTO messRegister (name,email,password) VALUES ('$a','$b','$c')";
						  if ($link->query($sql) === TRUE) {
					    	$_SESSION['message'] = "Registration Successful!, added $user to database";
		    				echo "New record created successfully";
		                                     			  	 
					       } else {
			    			echo "Error : " . $sql . "<br>" . $link->error;
				         	}
						  //echo $row["name"];
						 }   // while

						 
						
						
					}
				}
			}
		   $link->query("truncate table newRequests");
		   header("location: admin.php");
		}
     }
     else
     {
     	echo 'Login Again !!';
     	header('location:home.html');
     }
$link->close();
echo "<a class='logout' href='http://localhost:80/ZEUS/logout.php'>Logout</a>";
?> 



<!DOCTYPE html>
<html>
<head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<body>
	<form action="newRequests.php" method="POST">

		<table id = 'DailyMenu'><?php echo $print;?>
        </table>
		<br>
		<br><br>
		<button type="submit" class="submit" value=""><span>Next</span></button>

	</form>
</table>
</body>
</html>
