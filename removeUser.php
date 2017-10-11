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
<form method="POST" action="removeUser.php">
  <table id="DailyMenu">
    <tr>
      <th>Name</th>
      <th>Remove</th>
    </tr>
  <?php
  $result = $conn->query("SELECT * FROM messRegister");
  $i = 0;
  while ($row = $result ->fetch_assoc()){                        
     echo "<tr>";
     $i++;
     echo "<th>".$row["name"] . "</th>";
     echo "<th><button type=\"submit\" name=\"reset".$i."\" value=\"1\">Remove</button></th>";
     echo "</tr>";
     if(isset($_SESSION["name"])  && (strcmp($_SESSION['name'],"Admin") == 0)){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $monthlyBillNew = 0;
            $em = $row["email"];
            
            $var = "reset".$i;
            if($_POST[$var] == 1){
                $sql = "DELETE FROM messRegister WHERE email='$em'";
                 $res = $conn->query($sql);
                header("location:removeUser.php");
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

 
