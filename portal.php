
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

if(isset($_SESSION['name'])){
		$monthlyBill = $link->query("SELECT * FROM messRegister");
		$m=0;
		//$r = $link->query("SELECT portalActive FROM messRegister where email = $person")
		while($row=$monthlyBill->fetch_assoc()){
		    $person = $row["email"]; 
		    echo "hi my friends<br>";
		   	echo $person." haa haa haa<br>";
		   	$bArr = $row["bArrival"];
			$lArr = $row["lArrival"];
			//$lArr = $_POST['YesNo2'];
			$dArr = $row["dArrival"];
			$bMul = $row["bMultiplier"];
			$lMul = $row["lMultiplier"];
			$dMul = $row["dMultiplier"];
			$m = $row["monthlyBill"];
			echo $bArr." haa haa haa<br>";
			echo $lArr." haa haa haa<br>";
			echo $dArr." haa haa haa<br>";
			if($bArr == 1){$m = $m+(30*$bMul);}
			if($dArr == 1){$m = $m+(30*$dMul);}
			if($lArr == 1){$m = $m+(30*$lMul);}
			$isAct = $row["isActive"];
			if($isAct == 1){
			    $bArr = 1;
		    	$dArr = 1;
		    	$lArr = 1;
		        $bMul = 1;
		    	$dMul = 1;
		    	$lMul = 1;
			    $sql = "UPDATE messRegister SET monthlyBill='$m', bArrival='$bArr', lArrival='$lArr', dArrival='$dArr', bMultiplier='$bMul', lMultiplier='$lMul', dMultiplier='$dMul' WHERE email='$person'";    
			}
			if($link->query($sql) === TRUE){
				echo "Successful<br><br>";
			}
			else{
			    echo "Unsuccessful<br>";
			}
		}

		    $res2 = $link->query("SELECT * from adminTable");
		        while($row2 = $res2->fetch_assoc()){
		            $uName = $row2["adminName"];
		            $link->query("update adminTable SET isPortalClosedToday=0 where name = '$uName'");
		        }


		$link->close();
	}
	else
	{
		echo 'Please login !!';
		header('location:home.html');
	}
?> 
