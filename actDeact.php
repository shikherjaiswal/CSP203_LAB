
<?php
session_start();
 // include('header.php');
$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";
$link = new mysqli($servername, $username, $password, $dbname);
if ($link->connect_error) {
   die("Connection failed: " . $link->connect_error);
 
}

if(isset($_SESSION['email'])){
	$email = $_SESSION['email'];
	$id = $link->query("SELECT id FROM messRegister WHERE email ='$email'");
	if($id->num_rows == 0){echo "Invalid user";}
	else{
	    $name = $link->query("SELECT * FROM messRegister WHERE email='$email'");
	    $row = $name->fetch_assoc();
        if($row["isActive"] == 1){
            $print = "Deactivate : <label class=\"switch\">
            	<input type=\"checkbox\" name=\"OP\" value=\"1\" checked>
    	        <div class=\"slider\"></div>
                </label> : Activate";
        }
        else{
            $print = "Deactivate : <label class=\"switch\">
            	<input type=\"checkbox\" name=\"OP\" value=\"1\">
    	        <div class=\"slider\"></div>
                </label> : Activate";
        }
        
         if($_SERVER["REQUEST_METHOD"]=="POST"){
         $userInput = $_POST['OP'];
         		if($userInput == 0){
     
     				$res = $link->query("SELECT * FROM messRegister where email='$email'");
		            while($row=$res->fetch_assoc()){
		                $closedToday = 0;
		                $res2 = $link->query("SELECT * from adminTable");
                        while($row2 = $res2->fetch_assoc()){
                             $closedToday = $row2["isPortalClosedToday"];
                        }
    
		                if($closedToday == 1){
	                           	$bArr = $row["bArrival"];
                                $lArr = $row["lArrival"];
                                //$lArr = $_POST['YesNo2'];
                                $dArr = $row["dArrival"];
                                $m = $row["monthlyBill"];
                          	    $r = 0;
                      	    	if($bArr == 1){$m = $m+30;}
	                            if($dArr == 1){$m = $m+30;}
	                            if($lArr == 1){$m = $m+30;}
	                            $bArr = 0;
	                            $dArr = 0;
	                            $lArr = 0;
		          			    $link->query("update messRegister SET isActive = '$r' ,monthlyBill='$m', bArrival='$bArr', lArrival='$lArr', dArrival='$dArr' where email = '$email'");
                         
                        }
                        else{
                            $r = 0;
	                        $bArr = 0;
	                        $dArr = 0;
	                        $lArr = 0;
		          			$link->query("update messRegister SET isActive = '$r' , bArrival='$bArr', lArrival='$lArr', dArrival='$dArr' where email = '$email'");
                        }
                        
                    }
                
					$_SESSION["msg"] = "Successfully Deactivated";
					header("location:user.php");
				    }  
      			else
      			    {
      				$res = $link->query("SELECT * FROM messRegister");
					while($row=$res->fetch_assoc()){
                 	     $r = 1;
		 			    $link->query("update messRegister SET isActive = '$r'where email = '$email'");
                	  }
					$_SESSION["msg"] = "Successfully Activated";
					header("location:user.php");
                   }

                }			  
    }
}
else {
	echo "Login again!!!";
}


?>
<html>
<head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<body>
<form action = "actDeact.php" method = "POST">
Account status : <br><br>
<?php echo $print;?>
 <br>
 <input type="submit" value="Submit">
 </form>
<a class='logout' href='http://localhost:80/ZEUS/logout.php'>Logout</a>
<a class='home' href='http://localhost:80/ZEUS/user.php'>Home</a>
</body>
</html>
