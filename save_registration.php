<?php
require_once('includes/dbConn.php'); 
require_once('includes/email_tools.php');
require_once('includes/registration_class.php');
session_start();

// Get value of submit button to determine action
if($_POST['submit']== '       Back       ') {
	header("Location: conference_register3.php");
}

// Get registration from session
$registration = $_SESSION['registration'];
if(!isset($registration) || (strlen($registration->Name)==0))
	header("Location: conference.php");

// Save to Session whether to pay the Paypal fee
if($_POST['payfee']=="PayFee") 
	$_SESSION['payfee'] = TRUE;
else 
	$_SESSION['payfee'] = FALSE;
	
// Format any string values for mySQL
$registration->Name = mysql_real_escape_string($registration->Name, $dbConn);
$registration->Address = mysql_real_escape_string($registration->Address);
$registration->City = mysql_real_escape_string($registration->City);
$registration->Zip = mysql_real_escape_string($registration->Zip);
$registration->Coupon = mysql_real_escape_string($registration->Coupon);
$registration->ChurchName = mysql_real_escape_string($registration->ChurchName);
$registration->ChurchAddress = mysql_real_escape_string($registration->ChurchAddress);
$registration->ChurchCity = mysql_real_escape_string($registration->ChurchCity);
$registration->ChurchZip = mysql_real_escape_string($registration->ChurchZip);
$registration->ChurchWeb = mysql_real_escape_string($registration->ChurchWeb);
$registration->SpecialNeeds = mysql_real_escape_string($registration->SpecialNeeds);

$result = AddRegistration($registration);
if($result=="") {
	SendEmailSuccess($registration);
	if($registration->Coupon == "PW")
		$loc = 'conference_register_free.php';
	else
		$loc = 'process_reg4.php';
}
else {
	SendEmailFailure($registration, $result);
	$loc = 'conference_failure.php';
}
header("Location: $loc");

function AddRegistration($registration) {
	global $database_dbConn, $dbConn;
	$date = $registration->GetRegistrationDate();
	
	$insertSQL = "INSERT INTO registrations (date, conference, name, address, city, state, zip,";
	$insertSQL .= "phone_ac, phone_exchange, phone_number, ages, count, rate, coupon, price, email,";
	$insertSQL .= "church_name, church_address, church_city, church_state, church_zip, church_web,";
	$insertSQL .= "women_leader, pastor_wife, special_needs) VALUES (";
	$insertSQL .= "'$date', '$registration->Conference',";
	$insertSQL .= "'$registration->Name','$registration->Address','$registration->City','$registration->State','$registration->Zip',";
	$insertSQL .= "'$registration->PhoneAC','$registration->PhoneExchange','$registration->PhoneNumber','$registration->Ages',$registration->Count,";
	$insertSQL .= "$registration->RegistrationRate, '$registration->Coupon', $registration->Price, '$registration->Email',";
	$insertSQL .= "'$registration->ChurchName','$registration->ChurchAddress','$registration->ChurchCity','$registration->ChurchState','$registration->ChurchZip','$registration->ChurchWeb',";
	$insertSQL .= "$registration->WomenLeader,$registration->PastorWife,'$registration->SpecialNeeds')";
	
	mysql_select_db($database_dbConn, $dbConn);
	$result = @mysql_query($insertSQL, $dbConn) or die(mysql_error());
	
	if (!$result)
		return mysql_error();
	else
		return "";
}

function SendEmailSuccess($registration) {
	$emailFrom = "registration@mcccchicks.org";

	$body = GetRegistrationEmailInfo($registration);
	$message = "
		<html>
		<head>
			<title>Conference Registration from MCCCChicks.org</title>
		</head>
		<body>
			<p>Greetings! A registration for the 2013 Women's Conference has been submitted with the following information:</p>"
		. $body .
		"</body>
		</html>
	";
	
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: $emailFrom\r\nReply-To: $emailFrom";
	
//	DumpEmail($emailTo, $emailFrom, $subject, $message);
	// Send email to registration admin
	$emailTo = "registration@mcccchicks.org";
	$subject = "A Registration has been entered at mcccchicks.org";
	
	SendEmail($emailTo, $emailFrom, $subject, $message, $headers);
	
	// Send email to registrant
	$emailTo = $registration->Email;
	// TODO use year from Conference object's conference_date field
	$subject = "Confirming your 2015 Conference Registration";
	SendEmail($emailTo, $emailFrom, $subject, $message, $headers);	
}

function SendEmailFailure($registration, $error) {
	$emailFrom = "webmaster@mcccchicks.org";
	$body = GetRegistrationEmailInfo($registration);
	
	$message = '
		<html>
		<head>
			<title>Failed Conference Registration from MCCCChicks.org</title>
		</head>
		<body>
			<p>An attempt to register for the conference on MCCCChicks.org failed with the following error:</p>
			<p>$error</p>
			<p>Please forward this information to the MCCCChicks.org webmaster at webmaster@mcccchicks.org</p>
			<p>Registrant Information</p>'
		. $body . 
		'</body>
		</html>
	';
	$emailTo = "registration@mcccchicks.org";
	$subject = "Failed Conference Registration from MCCCChicks.org";

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: $emailFrom\r\nReply-To: $emailFrom";
	
	SendEmail($emailTo, $emailFrom, $subject, $message, $headers);
}

function GetRegistrationEmailInfo($registration) {
	$womenLeader = (($registration->WomenLeader==1) ? "Yes" : "No");
	$pastorWife = (($registration->PastorWife==1) ? "Yes" : "No");
	
	$body = "
		<table>
			<tr><td>Name:</td><td>$registration->Name</td></tr>
			<tr><td>Address:</td><td>$registration->Address</td></tr>
			<tr><td>&nbsp;</td><td>$registration->City, $registration->State $registration->Zip</td></tr>
			<tr><td>Phone:</td><td>$registration->PhoneAC - $registration->PhoneExchange - $registration->PhoneNumber</td></tr>
			<tr><td>Email:</td><td>$registration->Email</td></tr>
			<tr><td>Women Leader:</td><td>$womenLeader</td></tr>
			<tr><td>Pastor's Wife:</td><td>$pastorWife</td></tr>
			<tr><td>Special Needs:</td><td>$registration->SpecialNeeds</td></tr>
			<tr><td>Ages:</td><td>$registration->Ages</td></tr>
			<tr><td>Registered Count:</td><td>$registration->Count</td></tr>
			<tr><td>Coupon:</td><td>$registration->Coupon</td></tr>
			<tr><td>Total Fee:</td><td>$registration->Price</td></tr>
			<tr><td>Group Name:</td><td>$registration->GroupName</td></tr>
			<tr><td>Church:</td><td>$registration->ChurchName</td></tr>
			<tr><td>Church Address:</td><td>$registration->ChurchAddress</td></tr>
			<tr><td>&nbsp;</td><td>$registration->ChurchCity, $registration->ChurchState $registration->ChurchZip</td></tr>
			<tr><td>Church web:</td><td>$registration->ChurchWeb</td></tr>
		</table>
	";
	return $body;
}

function DumpEmail($emailTo, $emailFrom, $subject, $message) {
	echo "To: $emailTo<br/>";
	echo "From: $emailFrom<br/>";
	echo "Subject $subject<br/>";
	echo "Message:<br/>$message<br/>";
}
?>