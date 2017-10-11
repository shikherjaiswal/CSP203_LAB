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

if(isset($_SESSION['name'])){
  $result = $conn->query("SELECT * FROM messRegister");
     $bComing = 0;
     $dComing = 0; 
     $lComing = 0; 
     $bPeople = "";
     
     $dPeople = "";
     
     $lPeople = "";
     $day = date("l");
     echo "$day<br><br>";
  while ($row = $result ->fetch_assoc()){                        
     if($row["bArrival"] == 1){
        $bComing+=$row["bMultiplier"];
        $bPeople = $bPeople.$row["name"];
        if($row["bMultiplier"]>1){$bPeople = $bPeople."+".($row["bMultiplier"]-1);}
        $bPeople = $bPeople."<br>";
       }
     if($row["dArrival"] == 1){
         $dPeople = $dPeople.$row["name"];
         if($row["dMultiplier"]>1){$dPeople = $dPeople."+".($row["dMultiplier"]-1);}
        $dPeople = $dPeople."<br>"; 
        $dComing+=$row["dMultiplier"];
       }
     if($row["lArrival"] == 1){
        $lComing+=$row["lMultiplier"];
         $lPeople = $lPeople.$row["name"];
         if($row["lMultiplier"]>1){$lPeople = $lPeople."+".($row["lMultiplier"]-1);}
        $lPeople = $lPeople."<br>";
       }    
   }
}
//echo "$bPeople";
//echo nl2br("$bPeople");
?>

<html>
  <head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
  </head>

 <body>
 <script>
    function bPrint() {
            var popup = document.getElementById("myPopup1");
            popup.classList.toggle("show");
    }
    function lPrint() {
            var popup = document.getElementById("myPopup2");
            popup.classList.toggle("show");
    }
    
    function dPrint() {
            var popup = document.getElementById("myPopup3");
            popup.classList.toggle("show");
    }
    
    
 </script>
<table id="DailyMenu">
  <?php  
   echo "<tr><th>".$bComing." people coming today for breakfast.</th></tr>";
   echo "<tr><th>".$lComing." people coming today for lunch.</th></tr>";
   echo "<tr><th>".$dComing." people coming today for dinner.</th></tr>";
  ?>
  <a class='home' href='http://localhost:80/ZEUS/admin.php'>Home</a>
<a class='logout' href='http://localhost:80/ZEUS/logout.php'>Logout</a>
  </table>
    <br><br><br><br>
    <a onclick="bPrint()" class="popup">See Breakfast Details<span class="popuptext" id = "myPopup1"><?php echo $bPeople;?></span></a>  
    <a onclick="lPrint()" class="popup">See Lunch Details<span class="popuptext" id = "myPopup2"><?php echo $lPeople;?></span></a>  
    <a onclick="dPrint()" class="popup">See Dinner Details<span class="popuptext" id = "myPopup3"><?php echo $dPeople;?></span></a>   
 
 </body>
</html>






