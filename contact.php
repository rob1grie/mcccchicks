<?php
session_start();

// Check for error mode
$mode = isset($_SESSION['mode']) ? $_SESSION['mode'] : '';
$email = array();
$email_errors = array();

if(isset($mode) && ($mode == 'email_err')) {
	$email['email_name'] = $_SESSION['email_name'];
	$email['email_email'] = $_SESSION['email_email'];
	$email['email_message'] = $_SESSION['email_message'];
	
	$email_errors = $_SESSION['email_errors'];
	$message = "Please check required fields";
}
else {
	$email['email_name'] = "";
	$email['email_email'] = "";
	$email['email_message'] = "";
	
	$message = "All fields are required";
}
?>
<html>
<head>
<title>Chicks - a Mustang Creek Community Church Ministry - Forney, TX - Contact Us</title>
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
	var r=confirm("Cancel your message?")
	if (r==true) {
		self.location='index2.php';
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
<table align="center" width="1024px" cellpadding="0px" border="0">
<tr><td colspan="3"><img src="images/blank.gif" border="0"/></td></tr>
<tr>
	<td width="222">
	<?php include_once('includes/left_buttons.php'); ?>
	</td>
	<td width="592" valign="top" align="center">
		<form name="form1" method="post" action="process_email.php">
		<table align="center" width="95%" border="0">
			<tr><td width="23%">&nbsp;</td><td width="2%">&nbsp;</td><td width="75%">&nbsp;</td></tr>
			<tr>
				<td colspan="3" align="center">
					<img src="images/contact_header.gif" border="0" />
				</td>
			</tr>
			<tr>
				<td colspan="3" class="body_message" align="center">
					We would love to hear from you.<br/>
					Feel free to say as much as you would like.
				</td>
			</tr>
			<tr><td colspan="3" align="center" class="small_message"><?php echo $message; ?></td></tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td align="right" class="small_label">Name:</td>
				<td>&nbsp;</td>
				<td align="left" nowrap>
					<input type="text" name="email_name" value="<?php echo $email['email_name']; ?>" size="50" />
					<span class="form_error">
                                            <?php if (isset($email_errors['email_name'])) echo $email_errors['email_name']; ?>
                                        </span>
				</td>
			</tr>
			<tr>
				<td align="right" class="small_label">Email Address:</td>
				<td>&nbsp;</td>
				<td align="left" nowrap>
					<input type="text" name="email_email" value="<?php echo $email['email_email']; ?>" size="50" />
					<span class="form_error">
                                            <?php if (isset($email_errors['email_email']))echo $email_errors['email_email']; ?>
                                        </span>
				</td>
			</tr>
			<tr>
				<td align="right" valign="top" class="small_label">Message:</td>
				<td>&nbsp;</td>
				<td align="left" valign="top" nowrap>
					<textarea rows="12" cols="38" name="email_message"><?php echo stripslashes($email['email_message']); ?></textarea>
					<span class="form_error">
                                            <?php if (isset($email_errors['email_message'])) echo $email_errors['email_message']; ?>
                                        </span>
				</td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td colspan="3">
					<table width="100%">
						<tr>
							<td width="45%" align="right"><input type="button" value="       Cancel       " onClick="confirm_cancel()" /></td>
							<td width="10%">&nbsp;</td>
							<td width="45%" align="left"><input type="submit" value="       Submit       " name="submit" /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</form>
	</td>	
	<td width="200" align="left"><script language="JavaScript" src="slideshow_home.js"></script></td>
</tr>
<tr><td colspan="3" align="center" class="footer"><?php include_once 'includes/footer.php';?></td></tr>
</table>
</div>
</div>
</body>