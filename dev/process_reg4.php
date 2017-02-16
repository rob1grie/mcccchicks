<?php
// Processes form on conference_register4.php
require_once('includes/registration_class.php');
session_start();

if(!isset($_SESSION['registration']))
	header("Location: conference.php");
	
$registration = $_SESSION['registration'];
$price = $registration->Price;

unset($_SESSION['registration']);
unset($_SESSION['mode']);
unset($_SESSION['conference']);
?>
<html>
<head>
<script language="Javascript">
function SaveReg() {
	document.form1.submit();
}
</script>
</head>
<body onload="SaveReg()">
<form name="form1" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1"> 
<input type="hidden" name="business" value="ppaladmin@mcccchicks.org"> 
<?php
echo "<input type=\"hidden\" name=\"item_name_1\" value=\"Conference Registration\">\r\n";
echo "<input type=\"hidden\" name=\"amount_1\" value=\"$price\">\r\n";

// Check Session for whether to include Paypal fee
if($_SESSION['payfee']) {
	echo "<input type=\"hidden\" name=\"item_name_2\" value=\"Paypal Fee\">\r\n";
	echo "<input type=\"hidden\" name=\"amount_2\" value=\"$registration->PaypalFee\">\r\n";
}
unset($_SESSION['payfee']);
?>
</form>
</body>