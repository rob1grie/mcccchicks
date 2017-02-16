<?php
// Create left column buttons based on current page
// Get base file name of current script
$path_parts = pathinfo($_SERVER['PHP_SELF']);
$filename = $path_parts['filename'];

// Start table of buttons
echo <<<HTML1
		<table align="center">
			<tr>
				<td align="left" valign="middle">
HTML1;

// Index
if(!strstr($filename, 'index')){	// Include link to index2.php
	echo <<<INDEX1
		<a href="index2.php"><img src="images/home_button.gif" name="home_button" border="0" id="home_button" onMouseOver="MM_swapImage('home_button','','images/home_button_over.gif',1)" onMouseOut="MM_swapImgRestore()" /></a>
INDEX1;
}
else								// Do not include link to index2.php
	echo <<<INDEX2
		<img src="images/home_button.gif" name="home_button" border="0" id="home_button" />
INDEX2;

echo "</td></tr><tr><td align=\"left\" valign=\"middle\">";	

// Conference
if(!strstr($filename, 'conference')) {	// Include link to conference.php
	echo <<<CONFERENCE1
		<a href="conference.php"><img src="images/conference_button.gif" name="conference_button" border="0" id="conference_button" onMouseOver="MM_swapImage('conference_button','','images/conference_button_over.gif',1)" onMouseOut="MM_swapImgRestore()" /></a>
CONFERENCE1;
}
else {
	echo <<<CONFERENCE2
		<img src="images/conference_button.gif" name="conference_button" border="0" id="conference_button" />
CONFERENCE2;
}

echo "</td></tr><tr><td align=\"left\" valign=\"middle\">";	

// Events
if(!strstr($filename, 'events')) {
	echo <<<EVENTS1
		<a href="events.php"><img src="images/events_button.gif" name="events_button" border="0" id="events_button" onMouseOver="MM_swapImage('events_button','','images/events_button_over.gif',1)" onMouseOut="MM_swapImgRestore()"/></a>
EVENTS1;
}
else {
	echo <<<EVENTS2
		<img src="images/events_button.gif" name="events_button" border="0" id="events_button" />
EVENTS2;
}

echo "</td></tr><tr><td align=\"left\" valign=\"middle\">";	

// Contact
if(!strstr($filename, 'contact')) {
	echo <<<CONTACT1
		<a href="contact.php"><img src="images/contact_button.gif" name="contact_button" border="0" id="contact_button" onMouseOver="MM_swapImage('contact_button','','images/contact_button_over.gif',1)" onMouseOut="MM_swapImgRestore()"/></a>
CONTACT1;
}
else {
	echo <<<CONTACT2
		<img src="images/contact_button.gif" name="contact_button" border="0" id="contact_button"/>
CONTACT2;
}

echo "</td></tr><tr><td align=\"left\" valign=\"middle\">";	

$test = strpos($filename, 'merchandise');

// Merchandise
if(!strstr($filename, 'merchandise')) {
	echo <<<MERCH1
		<a href="merchandise.php"><img src="images/merchandise_button.gif" name="merchandise_button" border="0" id="merchandise_button" onMouseOver="MM_swapImage('merchandise_button','','images/merchandise_button_over.gif',1)" onMouseOut="MM_swapImgRestore()"/></a>
MERCH1;
}
else {
	echo <<<MERCH2
		<img src="images/merchandise_button.gif" name="merchandise_button" border="0" id="merchandise_button" />
MERCH2;
}

// Close table
echo "</td></tr></table>";

?>