<?php
$link = new mysqli("localhost","cyborg","toor","lab");
$sql = "DROP TABLE messRegister";
if($link->query($sql)){
	echo "table deleted successfully";
}
else {echo "Sorry";}
?>
