<?php
require_once('includes/registration_class.php');
session_start();
$registration = $_SESSION['registration'];

// Processes form on conference_register3.php
// Get value of submit button to determine action
if($_POST['submit']== '       Back       ') {
	$loc = 'conference_register2.php';
}
else if($registration->Coupon == "PW") {
	// If registration fee is 0, direct to save_registration.
	$loc = 'save_registration.php';
}
else {
	$loc = 'conference_register4.php';
}

header("Location: $loc");
?>