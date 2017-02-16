<?php
// Reusable library of code for handling email messages
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function CleanUpForEmail($text) {
	global $dbConn;
	$text = mysql_real_escape_string($text, $dbConn);
	$text = str_replace("\\r\\n", chr(10), $text);
	$text = str_replace("\\\'", "\'", $text);
	
	return $text;
}

function SendEmail($to, $from, $subject, $message, $headers) {
	// Sends the arguments as an email message
	// Email is valid; send it
	// Development - change emailTo at this point 
//	$emailTo = 'rob@mustangcreek.org';
//	@mail($emailTo, $emailSub, $emailMsg, $headers);
//
//	$to = 'robgrie@gmail.com';
	$result = @mail($to, $subject, $message, $headers);
	return $result;
}

?>