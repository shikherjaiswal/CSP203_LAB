
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


$day = date("l");

$sql = "SELECT * FROM menu WHERE day ='$day'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $i=0;
    $print1 = $print1."<table id=\"DailyMenu\"><tr><th></th><th>Menu</th><th>Yes/No</th><th>Total Number of People</th></tr><tr><th>Breakfast</th>";
    
    $sql = "SELECT food FROM menu WHERE time='Breakfast' and day='$day'";
    $foodresult=$link->query($sql);
    if($foodresult->num_rows>0){
		while($row=$foodresult->fetch_assoc()){
		    $print1 = $print1."<th>".$row['food']."</th>";
		}
   			 $print1=$print1."<th>
    		<label class=\"switch\">
			<input type=\"checkbox\" name=\"YesNo1\" checked value=\"1\">
  			<div class=\"slider\"></div>
		    </label></th>";
		
			$print1 = $print1."<th><input type=\"number\" class=\"numbers\" name=\"multiplierB\" min=\"1\" max=\"5\" value=\"1\"></th></tr>";

    } 

    $print2=$print2."<tr><th>Lunch</th>";
    $sql = "SELECT food FROM menu WHERE time='Lunch' and day='$day'";
    $foodresult=$link->query($sql);
    if($foodresult->num_rows>0){
	while($row=$foodresult->fetch_assoc()){
	    $print2=$print2. "<th>".$row['food']."</th>";
	}
    $print2=$print2. 
		"<th>
    		<label class=\"switch\">
			<input type=\"checkbox\" name=\"YesNo2\" checked value=\"1\">
  			<div class=\"slider\"></div>
		</label></th>"; 
		$print2 = $print2."<th><input type=\"number\" class=\"numbers\" name=\"multiplierL\" min=\"1\" max=\"5\" value=\"1\"></th></tr>";   
    }

    $print3=$print3. "<tr><th>Dinner</th>";
    $sql = "SELECT food FROM menu WHERE time='Dinner' and day='$day'";
    $foodresult=$link->query($sql);
    if($foodresult->num_rows>0){
	while($row=$foodresult->fetch_assoc()){
	    $print3=$print3. "<th>".$row['food']."</th>";
	}
    $print3=$print3. "
    <th>
    	<label class=\"switch\">
			<input type=\"checkbox\" name=\"YesNo3\" checked value=\"1\">
  			<div class=\"slider\"></div>
			</label></th>
    	";
        $print3 = $print3."<th><input type=\"number\" class=\"numbers\" name=\"multiplierD\" min=\"1\" max=\"5\" value=\"1\"></th></tr></table>";
    }

   
} else {
    echo "0 results";
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$person = $_SESSION['email'];
	$id = $link->query("SELECT id FROM messRegister WHERE email='$person'");
	if($id->num_rows == 0){
               	$InvalidUser="*No such user.";
	}
	else{
		$bArr = $_POST['YesNo1'];
		$lArr = $_POST['YesNo2'];
		$dArr = $_POST['YesNo3'];
		$bMul = $_POST['multiplierB'];
		$lMul = $_POST['multiplierL'];
		$dMul = $_POST['multiplierD'];
		$monthlyBill = $link->query("SELECT * FROM messRegister WHERE email='$person'");
		//$r = $link->query("SELECT portalActive FROM messRegister where email = $person")
		while($row=$monthlyBill->fetch_assoc()){
		  if($row["portalActive"] == 1){
			$sql = "UPDATE messRegister SET bArrival='$bArr', lArrival='$lArr', dArrival='$dArr', bMultiplier='$bMul', lMultiplier='$lMul', dMultiplier='$dMul' WHERE email='$person'";
                  }
                }
		//if($bArr == 1){$m = $m+30;}
		//if($dArr == 1){$m = $m+30;}
		//if($lArr == 1){$m = $m+30;}
		
   		if($link->query($sql) === TRUE){
			echo "Successful<br><br>";
		} else{echo "Portal is Closed<br><br>";}
	}
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
<?php echo $day;?> 
	<form action="DailyMenu.php" method="POST">
		
		<?php echo $print1;?>
		
		<?php echo $print2;?>

		<?php echo $print3;?>
		<br>
		<br>
		<br>
		<button type="submit" class="submit" value=""><span>Submit</span></button>

	</form>
</table>
<a class='home' href='http://localhost:80/ZEUS/user.php'>Home</a>
</body>
</html>
