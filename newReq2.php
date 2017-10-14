<?php
session_start();
$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>

<html>
  <head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
  </head>

 <body>
<form method="POST" action="newReq2.php">
  <table id="DailyMenu">
  <?php
  $result = $conn->query("SELECT * FROM newRequests");
  $i = 0;
  if($result->num_rows <= 0){
  	echo "<p>No Pending Requests Today!!!!</p>";
  }
  while ($row = $result ->fetch_assoc()){                        
     echo "<tr>";
     $i++;
     echo "<th>".$row["name"] . "</th>";   
     echo "<th>".$row["email"] . "</th>";
     echo "<th><button type=\"submit\" name=\"accept".$i."\" value=\"1\">Accept</button></th>";
     echo "<th><button type=\"submit\" name=\"reject".$i."\" value=\"1\">Reject</button></th>";
     echo "</tr>";
     if(isset($_SESSION["name"])  && (strcmp($_SESSION['name'],"Admin") == 0)){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $monthlyBillNew = 0;
            $em = $row["email"];
            
            $var1 = "reject".$i;
            $var2 = "accept".$i;
            if($_POST[$var1] == 1){
                $sql = "DELETE FROM newRequests WHERE email='$em'";
                $res = $conn->query($sql);
                header("location:newReq2.php");
            }
            if($_POST[$var2] == 1){

              $a = $row["name"];
              $b = $row["email"];
              $c = $row["password"];
                $sql = "INSERT INTO messRegister (name,email,password) VALUES ('$a','$b','$c')";


                $conn->query($sql);
        
                $sql = "DELETE FROM newRequests WHERE email='$em'";
                $res = $conn->query($sql);
                header("location:newReq2.php");

            }
        }
     }else {$print =  "Sorry you don't have permissions for that";}
   }

  ?>
  <a class='home' href='http://localhost:80/ZEUS/admin.php'>Home</a>
<a class='logout' href='http://localhost:80/ZEUS/logout.php'>Logout</a>
  <?php echo $print;?>
  </table>
    </form>
 </body>
</html>

 
