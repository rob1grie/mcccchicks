<?php
require_once('includes/registration_class.php');
session_start();

$registration = $_SESSION['registration'];
if(!isset($registration) || (strlen($registration->Name)==0))
	header("Location: conference.php");

$totalWithFee = number_format(($registration->Price + $registration->PaypalFee), 2, '.', '');

/*
// Get mode from session
$mode = $_SESSION['mode'];
if(!isset($mode) || (strlen($mode)==0)) {
	// Form is loading from unknown state
	header("Location:conference.php");
}
else {
	// If Session registration is not set, browser may be going back after saving
	if(!isset($_SESSION['registration'])) {
		// Form is loading from unknown state
		header("Location:conference.php");
	}
	$registration = $_SESSION['registration'];
}*/
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

function Continue() {
	self.location='conference.php';
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
		<form name="form1" method="post" action="save_registration.php" >
		<table align="center" width="95%" border="0">
			<tr><td width="28%">&nbsp;</td><td width="2%">&nbsp;</td><td width="70%">&nbsp;</td></tr>
			<tr>
				<td colspan="3" align="center" class="form_heading">Conference Registration</td>
			</tr>
			<tr>
				<td colspan="3" align="center"><img src="images/4of4.gif" /></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td colspan="3" class="body_message" align="center">
					Thank you for your registration.<br/><br/>
					An email containing all of your registration<br/>
					information has be sent to the Registration office,<br/>and to the email address you provided during registration<br/>
					<br/><br/>
					Thank you and we look forward to<br/>seeing you at the Conference!
				</td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td colspan="3">
					<table width="100%">
						<tr>
							<td width="50%" align="center"><input type="button" value="           Continue           " onClick="Continue()" /></td>
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