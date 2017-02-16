<?php
/*
 * Collects all the submitted information
 * then saves the Registration with Paid set to false
 * Retrieve the new Registration ID and send it to PayPal as part of the transaction
 * If save is successful user is sent to PayPal to make payment
 * 
 */
session_start();

require_once 'includes/registration_class.php';

$conference = 'Chicks Run For Your Life 5k';

$registration = new Registration();
$registration->Name = $_SESSION['name'];
$registration->Email = $_SESSION['email'];
$registration->Count = $_SESSION['quantity'];
$registration->Price = $_SESSION['total_price'];
$registration->PaypalFee = $_SESSION['total_price'] - $_SESSION['subtotal_price'];
$registration->Conference = $conference;
if ($registration->PaypalFee > 0) {
	$registration->Conference .= ' (include PayPal fee)';
}

// Save registration unpaid
// result is array with [id] being new registration->ID 
// and [error] being mysql_error if any
$result = $registration->Save(FALSE); 
$_SESSION['registration_id'] = $result['id'];
$_SESSION['registration_error'] = $result['error'];

$registration->Conference .= ' RegID ' . $result['id'];

if (!$result['id']) {
    // Error on saving registration info, show message
    exit('Error on saving registration info');
}

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
		<form name="form1" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="ppaladmin@mcccchicks.org">
			<input type="hidden" name="lc" value="US">
 			<input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="item_name" value="<?php echo $registration->Conference; ?>">
            <input type="hidden" name="amount" value="<?php echo $registration->Price; ?>">
			<input type="hidden" name="notify_url" value="http://www.mcccchicks.org/ipn.php">
		</form>		
    </body>
</html>
