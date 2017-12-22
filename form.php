<?php
session_start();
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'mail/vendor/autoload.php';
if(isset($_POST['submit'])){
	
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$email = $_POST['company'];
	$message = $_POST['message'];
	$to = "info@shivom.io"; 
	//$subject = "Email from $email";
	$domain=$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	//$msg = "Name: ".$name."\r\n Phone: ".$phone."\r\n Email: ".$email;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'abc@123';                 // SMTP username
    $mail->Password = 'abc@1234';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom("$email", 'Mailer');
    $mail->addAddress("$to", 'Shivom');     // Add a recipient
    
    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Email from $domain";
    $mail->Body    = "Name: ".$name."<br />\r\n Phone: ".$phone."<br />\r\n Email: ".$email."<br />\r\n Message: ".$message;
    $mail->AltBody = "Name: ".$name."<br />\r\n Phone: ".$phone."<br />\r\n Email: ".$email;

    $ok=$mail->send();
	if($ok){
		//$_SESSION['msg']="Thanks for submitting your query. We will contact you soon";
		//header("Location:index.html");
		echo "<script>alert('Thanks for submitting your query. We will contact you soon');document.location='index.html';</script>";
	}
	else{
		echo "<script>alert('Something went wrong. Please try again later.');document.location='index.html';</script>";
	}
} catch (Exception $e) {
    //echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
}
}