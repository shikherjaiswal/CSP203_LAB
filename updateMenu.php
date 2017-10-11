<?php
session_start();
$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";
$link = new mysqli($servername, $username, $password, $dbname);
if ($link->connect_error) {
   die("Connection failed: " . $link->connect_error);
}
if(isset($_SESSION["name"])){
    if($_SERVER["REQUEST_METHOD"]=="POST"){
       $userInput = $_POST['umenu'];
       $day = $_POST['Day'];
       $foodTime  = $_POST['FoodTime'];
       
       $sql = "update menu set food = '$userInput' where day = '$day' AND time='$foodTime'";
       $foodresult = $link->query($sql);
       //if($foodresult->num_rows>0){
       //  while($row=$foodresult->fetch_assoc()){
        //  $print2 = $print2."<th>".$row['food']."</th>";
       //  }
       //  $print2 = $print2."</tr></table>";
      // }
       $msg = "Menu Update Successful";
     }
   }
   else
   {
    echo 'Please login again !!';
    header('location :home.html');
   }
?>

<html>
<head>
 	<title>My Mess</title>
 	<link rel = "stylesheet" type="text/css" href="styles/register.css">
</head>
 <?php echo $msg;?>
 </br> </br>
<body>
<div id="registerBack"></div>
<div id="register">
<br><br><br>
<form action = "updateMenu.php" method = "POST" class="registerForm">

<input list = "day" name="Day" placeholder = "Select Day">
<datalist id="day">
<option selected disabled>DAY</option>
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
<option value="Sunday">Sunday</option>

</datalist><br>

<input list = "foodTime" name="FoodTime" placeholder="Breakfast/Lunch/Dinner">
<datalist id="foodTime">


<option value="Breakfast">Breakfast</option>
<option value="Lunch">Lunch</option>
<option value="Dinner">Dinner</option>
</datalist>
<br>

<input type="text" name="umenu" placeholder = "New Menu"><br><br><br>
 <input type="submit" value="Submit">
<a class='logout' href='http://localhost:80/ZEUS/logout.php'>Logout</a>
   <a class='home' href='http://localhost:80/ZEUS/admin.php'>Home</a>
 
 
 </form>
 </div>
 </body>

 </html>
 
