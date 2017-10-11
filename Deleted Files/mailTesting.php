#!/usr/bin/php
<?php
$servername = "localhost";
$username = "cyborg";
$password = "toor";
$dbname = "lab";
$conn = new mysqli($servername, $username, $password, $dbname);
$to = '2015csb1036@iitrpr.ac.in';
$msg = 'Hi mera naam shikhar jaiswal haii';
$subject = 'hum shikhar hoon';
echo $msg;
require('phpmailer/PHPMailerAutoload.php');
echo $msg;
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth= true;
$mail->Port = 465; // Or 587
$mail->Username= 'guesthousemess@gmail.com';
$mail->Password= 'csp203lab';
$mail->SMTPSecure = 'ssl';
$mail->From = $to;
$mail->FromName= 'Your Guest House';
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $msg;
$mail->addAddress($to);
$mail->Host = "ssl://smtp.gmail.com"; 
echo !extension_loaded('openssl')?"Not Available":"Available";
if(!$mail->send()){
 echo "Mailer Error: " . $mail->ErrorInfo;
}else{
 echo "E-Mail has been sent";
}
?>
<html>
<head>
	<title>My Mess</title>
	<link rel="stylesheet" type="text/css" href="styles/register.css">
</head>
<body>
</html>
