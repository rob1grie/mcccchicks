<?php
// Reusable library of code for handling email messages
function isValidEmail($email) {
    return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
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