<?php
// Processes form on conference_register1.php, validating required fields and continuing to conference_register2.php
require_once('includes/registration_class.php');
session_start();

// Get name of conference from session that was set in conference_register1.php
$conference = $_SESSION['conference'];

// Get fields from register1
$name = $_POST['name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone_ac = $_POST['phone_ac'];
$phone_exchange = $_POST['phone_exchange'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$ages = $_POST['ages'];
$count = $_POST['count'];
$special_needs = $_POST['special_needs'];

$mode = $_SESSION['mode'];

// Validate required fields, storing any errors in $reg1_errors
$reg1_errors = array();

// If mode is new, create new Registration object
if($mode=='new') {
	$registration = new Registration();
	$registration->Conference = $conference;
}
else
	$registration = $_SESSION['registration'];

if(!isset($name) || (strlen($name)==0)) 
	$reg1_errors["name"] = "Empty";
$registration->Name = $name;

if(!isset($address) || (strlen($address)==0)) 
	$reg1_errors["address"] = "Empty";
$registration->Address = $address;

if(!isset($city) || (strlen($city)==0))
	$reg1_errors["citystatezip"] = "Empty";
$registration->City = $city;

if(!isset($state) || (strlen($state)==0))
	$reg1_errors["citystatezip"] = "Empty";
$registration->State = $state;
	
if(!isset($zip) || (strlen($zip)==0))
	$reg1_errors["citystatezip"] = "Empty";
$registration->Zip = $zip;
	
if(!isset($phone_ac) || (strlen($phone_ac)==0))
	$reg1_errors["phone"] = "Empty";
$registration->PhoneAC = $phone_ac;
	
if(!isset($phone_exchange) || (strlen($phone_exchange)==0))
	$reg1_errors["phone"] = "Empty";
$registration->PhoneExchange = $phone_exchange;
	
if(!isset($phone_number) || (strlen($phone_number)==0))
	$reg1_errors["phone"] = "Empty";
$registration->PhoneNumber = $phone_number;
	
// Email is not required; only validate if it is not empty
if((strlen($email)>0) && !ereg('[[:alnum:]._-]+@[[:alnum:]-]+\.([[:alnum:]-]+\.)*[[:alnum:]]+', $email))
	$reg1_errors["email"] = "Invalid";
$registration->Email = $email;
	
if(!isset($count) || ($count==0))
	$reg1_errors["count"] = "Empty";
$registration->Count = $count;

// Ages and Special Needs does not need validation
$registration->Ages = $ages;
$registration->SpecialNeeds = $special_needs;

$_SESSION['registration'] = $registration;
	
$_SESSION['reg1_errors'] = $reg1_errors;

if(count($reg1_errors)>0) {
	$_SESSION['mode'] = 'err';
	$loc = 'conference_register1.php';
}
else {
	$_SESSION['mode'] = 'cont';
	$loc = 'conference_register2.php';
}

header("Location: $loc");
?>