<?php
require_once 'includes/registration_class.php';

// tell PHP to log errors to ipn_errors.log in this directory
ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'/ipn_errors.log');

// intantiate the IPN listener
require_once 'includes/ipnlistener.php';
$listener = new IpnListener();

// tell the IPN listener to use the PayPal test sandbox
$listener->use_sandbox = false;

// try to process the IPN POST
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}

if ($verified) {

    $errmsg = '';   // stores errors from fraud checks
    
    // 1. Make sure the payment status is "Completed" 
    if ($_POST['payment_status'] != 'Completed') { 
        // simply ignore any IPN that is not completed
        exit(0); 
    }

    // 2. Make sure seller email matches your primary account email.
    if ($_POST['receiver_email'] != 'ppaladmin@mcccchicks.org') {
        $errmsg .= "'receiver_email' does not match: ";
        $errmsg .= $_POST['receiver_email']."\n";
    }

    // TODO: Check for duplicate txn_id
    
    if (!empty($errmsg)) {
    
        // manually investigate errors from the fraud checking
        $body = "IPN failed fraud checks: \n$errmsg\n\n";
        $body .= $listener->getTextReport();
        mail('robgrie@gmail.com', 'IPN Fraud Warning', $body);
        
    } else {
    
        // TODO: process order here
		mail('robgrie@gmail.com', 'Chicks order complete', $listener->getPostData());
		
    }
    
} else {
    // manually investigate the invalid IPN
    mail('robgrie@gmail.com', 'Invalid IPN', $listener->getTextReport());
}

?>
