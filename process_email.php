<?php
// Processes form on conference_register1.php, validating required fields and continuing to conference_register2.php
require_once('includes/email_tools.php');
session_start();

// Get fields from contact form
$name = $_POST['email_name'];
$email = $_POST['email_email'];
$message = $_POST['email_message'];


// Validate required fields, storing any errors in $email_errors
$email_errors = array();

if(!isset($name) || (strlen($name)==0)) 
	$email_errors['email_name'] = "<<";
$_SESSION['email_name'] = $name;
	
if(!isset($email) || (strlen($email)==0))
	$email_errors['email_email'] = "<<";
else if(!ereg('[[:alnum:]._-]+@[[:alnum:]-]+\.([[:alnum:]-]+\.)*[[:alnum:]]+', $email))
	$email_errors['email'] = "???";
$_SESSION['email_email'] = $email;

if(!isset($message) || (strlen($message)==0))
	$email_errors['email_message'] = "<<";
$_SESSION['email_message'] = $message;

if(count($email_errors)>0) {
	$_SESSION['mode'] = 'email_err';
	$_SESSION['email_errors'] = $email_errors;
	$loc = 'contact.php';
}
else {
	unset($_SESSION['email_errors']);
	unset($_SESSION['mode']);
	if(SendContactMessage())
		$loc = 'contact_success.php';
	else
		$loc = 'contact_failure.php';
}
/*
echo "Dumping Session:<br/>";
var_dump($_SESSION); echo "<br/>";
echo "Dumping Post:<br/>";
var_dump($_POST);
*/

header("Location: $loc");

function SendContactMessage() {
	$emailFrom = $_SESSION['email_email'];
	$emailTo = "chicks@mustangcreek.org";
//	$emailTo = "robgrie@gmail.com";
	$body = $_SESSION['email_message'];
	$subject = "Contact message from MCCCChicks.org";
	$headers = "From: $emailFrom\r\nReply-To: $emailFrom";
/*
	var_dump($emailFrom);
	var_dump($emailTo);
	var_dump($subject);
	var_dump($body);
	var_dump($headers);
*/
	return SendEmail($emailTo, $emailFrom, $subject, $body, $headers);	
}
?>