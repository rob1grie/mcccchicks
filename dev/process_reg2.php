<?php
// Processes form on conference_register1.php, validating required fields and continuing to conference_register2.php
require_once('includes/registration_class.php');
session_start();

$registration = $_SESSION['registration'];
$reg2_errors = array();

// Get value of submit button to determine action
if($_POST['submit']== '       Back       ') {
	$loc = 'conference_register1.php';
	$_SESSION['mode']='edit';
}
else {
	// Check if coupon code was entered and validate if it was
	$registration->Coupon = $_POST['coupon'];
	if(isset($registration->Coupon) && (strlen($registration->Coupon)>0)) {
		if(!$registration->ValidateCoupon()) {
			$loc = 'conference_register2.php';
			$_SESSION['mode']= 'err';
			$reg2_errors['coupon'] = 'Invalid';
		}
		else {
			$loc = 'conference_register3.php';
			$_SESSION['mode']='cont';
		}
	}
	else {
		$loc = 'conference_register3.php';
		$_SESSION['mode']='cont';
	}
}

// Get fields from register2
$registration->GroupName = $_POST['group_name'];
$registration->ChurchName = $_POST['church_name'];
$registration->ChurchAddress = $_POST['church_address'];
$registration->ChurchCity = $_POST['church_city'];
$registration->ChurchState = $_POST['church_state'];
$registration->ChurchZip = $_POST['church_zip'];
$registration->ChurchWeb = $_POST['church_web'];
if($_POST['women_leader']=='yes')
	$registration->WomenLeader = 1;
else
	$registration->WomenLeader = 0;
if($_POST['pastor_wife']=='yes')
	$registration->PastorWife = 1;
else
	$registration->PastorWife = 0;

$_SESSION['registration'] = $registration;
$_SESSION['reg2_errors'] = $reg2_errors;
	

header("Location: $loc");
?>