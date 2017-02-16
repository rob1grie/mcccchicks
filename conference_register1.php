<?php
require_once('includes/registration_class.php');
if (!isset($_SESSION)) session_start ();

// Set name of conference to be used by Registration object
$conference = 'Promises Promises';
$_SESSION['conference'] = $conference;

// Get mode from session
//$mode = $_SESSION['mode'];
if(!isset($_SESSION['mode']) || (strlen($_SESSION['mode'])==0)) {
	$registration = new Registration();		// New registration
	$reg1_errors = array();					// Create empty array for use on form
	
	$registration->Conference = $conference;

	if(!$registration->ValidConference()) {
		// Flag that no rate was found for this conference within the current date
		// Send back to conference_schedule.php with flag
		$loc = 'conference_toolate.php';
		header("Location:$loc");
	}
	
	$mode = 'new';
	$_SESSION['mode'] = $mode;

/*	
	// Test data
	$registration->Name='Rob Grieshaber';
	$registration->Address='506 Worcester';
	$registration->City='Forney';
	$registration->State='TX';
	$registration->Zip='75080';
	$registration->PhoneAC = '972';
	$registration->PhoneExchange = '555';
	$registration->PhoneNumber = '1212';
	$registration->Count=1;
	$registration->Email='robgrie@gmail.com';
*/
}
else {
	// If Session registration is not set, browser may be going back after saving
	$mode = "";
	if(!isset($_SESSION['registration'])) {
		// Form is loading from unknown state
		header("Location:conference.php");
	}
	$registration = $_SESSION['registration'];
	$reg1_errors = $_SESSION['reg1_errors'];
}

if ($mode == 'err')
	$message = "Please check required fields";
else
	$message = "All fields marked with '*' are required";
	
?>
<html>
<head>
<title>Chicks - a Mustang Creek Community Church Ministry - Forney, TX - Conference</title>
<meta name="robots" content="FOLLOW, INDEX">
<link href="mcccchicks.css" type="text/css" rel="stylesheet" />
<script type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function confirm_cancel() {
	var r=confirm("Cancel your registration?")
	if (r==true) {
		self.location='conference.php';
	}
}
//-->
</script>
</head>
<body onLoad="MM_preloadImages('images/merchandise_button_over.gif','images/contact_button_over.gif','images/events_button_over.gif','images/home_button_over.gif')">
<div id="back_wrapper">
	<div id="back_container"><img src="images/page_background.gif"/></div>
</div>
<div id="content_wrapper">
<div id="content_container">
<table align="center" width="1026px" cellpadding="0px">
<tr><td colspan="3"><img src="images/blank.gif" border="0"/></td></tr>
<tr>
	<td width="222">
	<?php include_once('includes/left_buttons.php'); ?>
	</td>
	<td width="590" valign="top" align="center">
		<form name="form1" method="post" action="process_reg1.php">
		<table align="center" width="95%" border="0">
			<tr><td width="28%">&nbsp;</td><td width="2%">&nbsp;</td><td width="70%">&nbsp;</td></tr>
			<tr>
				<td colspan="3" align="center" class="form_heading">Conference Registration</td>
			</tr>
			<tr>
				<td colspan="3" align="center"><img src="images/1of4.gif" /></td>
			</tr>
			<tr>
				<td colspan="3" align="left" class="form_title">Tell us about you:</td>
			</tr>
			<tr><td colspan="3" align="center" class="small_message"><?php echo $message; ?></td></tr>
			<tr>
				<td align="right" class="form_label" valign="middle">Name:</td><td>&nbsp;</td>
				<td align="left">
					<input type="text" name="name" value="<?php echo $registration->Name; ?>" size="50" />
					<?php
						if(isset($reg1_errors['name']) && ($reg1_errors['name']=='Empty'))
							echo "<span class=\"form_error\"><<</span>";
						else
							echo "*";
					?>
				</td>
			</tr>
			<tr>
				<td align="right" class="form_label">Address:</td><td>&nbsp;</td>
				<td align="left">
					<input type="text" name="address" value="<?php echo $registration->Address; ?>" size="50" />
					<?php
						if(isset($reg1_errors['address']) && ($reg1_errors['address'] =='Empty'))
							echo "<span class=\"form_error\"><<</span>";
						else
							echo "*";
					?>
				</td>
			</tr>
			<tr>
				<td align="right" class="form_label">City/State/Zip</td><td>&nbsp;</td>
				<td align="left">
					<input type="text" name="city" value="<?php echo $registration->City; ?>" size="20" />,&nbsp;
					<input type="text" name="state" value="<?php echo $registration->State; ?>" size="2" />&nbsp;&nbsp;
					<input type="text" name="zip" value="<?php echo $registration->Zip; ?>" size="10" />
					<?php
						if(isset($reg1_errors['citystatezip']) && ($reg1_errors['citystatezip'] =='Empty'))
							echo "<span class=\"form_error\"><<</span>";
						else
							echo "*";
					?>
				</td>
			</tr>
			<tr>
				<td align="right" class="form_label">Phone: <span class="small_label">(###-###-####)</span></td><td>&nbsp;</td>
				<td align="left">
					<input type="text" name="phone_ac" value="<?php echo $registration->PhoneAC; ?>" size="3" /> -
					<input type="text" name="phone_exchange" value="<?php echo $registration->PhoneExchange; ?>" size="3" /> -
					<input type="text" name="phone_number" value="<?php echo $registration->PhoneNumber; ?>" size="4" />
					<?php
						if(isset($reg1_errors['phone']) && ($reg1_errors['phone']=='Empty'))
							echo "<span class=\"form_error\"><<</span>";
						else
							echo "*";
					?>
				</td>
			</tr>
			<tr>
				<td align="right" class="form_label">Email:</td><td>&nbsp;</td>
				<td align="left"><input type="text" name="email" value="<?php echo $registration->Email; ?>" size="50" />
					<?php
						if(isset($reg1_errors['email']) && ($reg1_errors['email']=='Invalid'))
							echo "<span class=\"form_error\">???</span>";
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<table width="100%">
						<tr>
							<td align="right" class="form_label" width="50%">Age (or range of ages):</td>
							<td align="left" width="50%"><input type="text" name="ages" value="<?php echo $registration->Ages; ?>" size="20" /></td>
						</tr>
						<tr>
							<td align="right" class="form_label">Number of ladies attending:</td>
							<td align="left">
								<input type="text" name="count" value="<?php echo $registration->Count; ?>" size="3" />
								<?php
									if(isset($reg1_errors['count']) && ($reg1_errors['count']=='Empty'))
										echo "<span class=\"form_error\"><<</span>";
									else
										echo "*";
								?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="right" class="form_label" valign="top">Special needs:</td><td>&nbsp;</td>
				<td align="left"><textarea rows="3" cols="38" name="special_needs"><?php echo stripslashes($registration->SpecialNeeds); ?></textarea></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td colspan="3">
					<table width="100%">
						<tr>
							<td width="45%" align="right"><input type="button" value="      Cancel      " onClick="confirm_cancel()" /></td>
							<td width="10%">&nbsp;</td>
							<td width="45%" align="left"><input type="submit" value="     Continue     " /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</form>
	</td>	
	<td width="202" align="left"><script language="JavaScript" src="slideshow_home.js"></script></td>
</tr>
<tr><td colspan="3" align="center" class="footer"><?php include_once 'includes/footer.php';?></td></tr>
</table>
</div>
</div>
</body>