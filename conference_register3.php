<?php
require_once('includes/registration_class.php');
if (!isset($_SESSION)) session_start ();

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
	$registration->SetRegistrationRate();
	$registration->Price = number_format(($registration->RegistrationRate * $registration->Count), 2, '.', '');

	// Calculate PaypalFee
	$totalWithFee = ($registration->Price + 0.30)/0.978;
	$registration->PaypalFee = number_format(($totalWithFee - $registration->Price), 2, '.', '');
}
	
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

function button_click(mode) {
	self.location='process_reg2.php?m='+ mode;
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
		<form name="form1" method="post" action="process_reg3.php">
		<table align="center" width="95%" border="0">
			<tr><td width="28%">&nbsp;</td><td width="2%">&nbsp;</td><td width="70%">&nbsp;</td></tr>
			<tr>
				<td colspan="3" align="center" class="form_heading">Conference Registration</td>
			</tr>
			<tr>
				<td colspan="3" align="center"><img src="images/3of4.gif" /></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td colspan="3" align="left" class="form_title">Confirm your information :</td>
			</tr>
			<tr>
				<td align="right" class="small_label">Name:</td><td>&nbsp;</td>
				<td align="left"><?php echo $registration->Name; ?></td>
			</tr>
			<tr>
				<td align="right" class="small_label">Address:</td><td>&nbsp;</td>
				<td align="left"><?php echo $registration->Address; ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td><td>&nbsp;</td>
				<td align="left">
					<?php echo $registration->City; ?>,&nbsp;
					<?php echo $registration->State; ?>&nbsp;&nbsp;
					<?php echo $registration->Zip; ?>
				</td>
			</tr>
			<tr>
				<td align="right" class="small_label">Phone:</td><td>&nbsp;</td>
				<td align="left">
					<?php echo $registration->PhoneAC; ?> -
					<?php echo $registration->PhoneExchange; ?> -
					<?php echo $registration->PhoneNumber; ?>
				</td>
			</tr>
			<tr>
				<td align="right" class="small_label">Email:</td><td>&nbsp;</td>
				<td align="left"><?php echo $registration->Email; ?></td>
			</tr>
			<tr>
				<td align="right" class="small_label">Ages:</td><td>&nbsp;</td>
				<td align="left"><?php echo $registration->Ages; ?>&nbsp;</td>
			</tr>
			<tr>
				<td align="right" class="small_label">Number attending:</td><td>&nbsp;</td>
				<td align="left"><?php echo $registration->Count; ?></td>
			</tr>
			<tr>
				<td align="right" class="small_label">Total fee:</td><td>&nbsp;</td>
				<td align="left"><?php echo $registration->Price; ?></td>
			</tr>
			<tr>
				<td align="right" class="small_label" valign="top">Special needs:</td><td>&nbsp;</td>
				<td align="left" class="small_text"><?php echo stripslashes($registration->SpecialNeeds); ?>&nbsp;</td>
			</tr>
			<tr>
				<td align="right" class="small_label">Group name:</td><td>&nbsp;</td>
				<td align="left"><?php echo $registration->GroupName; ?>&nbsp;</td>
			</tr>
			<tr>
				<td align="right" class="small_label">Church name:</td><td>&nbsp;</td>
				<td align="left"><?php echo $registration->ChurchName; ?>&nbsp;</td>
			</tr>
			<?php
				if(strlen($registration->ChurchAddress)>0) {
					echo <<<HTML1
						<tr>
							<td align="right" class="form_label">Church Address:</td><td>&nbsp;</td>
							<td align="left"><?php echo $registration->ChurchAddress; ?></td>
						</tr>
HTML1;
				}
				
				$churchCityStateZip = $registration->ChurchCity;
				if((strlen($registration->ChurchCity)>0) && (strlen($registration->ChurchState)>0) && (strlen($registration->ChurchZip)>0)) 
					$churchCityStateZip .= ", ";
				$churchCityStateZip .= $registration->ChurchState . " " . $registration->ChurchZip;
				
				if($registration->PastorWife == 1)
					$pastorWife = 'Yes';
				else
					$pastorWife = 'No';
				if($registration->WomenLeader == 1)
					$womenLeader = 'Yes';
				else
					$womenLeader = 'No';
			?>
			<tr>
				<td>&nbsp;</td><td>&nbsp;</td>
				<td align="left"><?php echo $churchCityStateZip; ?>&nbsp;</td>
			</tr>
			<tr>
				<td align="right" class="small_label">Church web site:</td><td>&nbsp;</td>
				<td align="left"><?php echo $registration->ChurchWeb; ?>&nbsp;</td>
			</tr>
			<tr>
				<td align="right" class="small_label">Women's Leader?</td><td>&nbsp;</td>
				<td align="left"><?php echo $womenLeader; ?></td>
			</tr>
			<tr>
				<td align="right" class="small_label">Pastor's wife?</td><td>&nbsp;</td>
				<td align="left"><?php echo $pastorWife; ?></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td colspan="3">
					<table width="100%">
						<tr>
							<td width="33%" align="right"><input type="submit" name="submit" value="       Back       " /></td>
							<td width="34%" align="center"><input type="button" value="      Cancel      " onClick="confirm_cancel()" /></td>
							<td width="33%" align="left"><input type="submit" name="submit" value="     Continue     " /></td>
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