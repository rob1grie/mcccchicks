<?php
session_start();
unset($_SESSION['mode']);
unset($_SESSION['registration']);
unset($_SESSION['reg1_errors']);
unset($_SESSION['reg2_errors']);
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
	<td width="218">
	<?php include_once('includes/left_buttons.php'); ?>
	</td>
	<td width="590" valign="middle" align="center">
		<a href="conference_blurb.php"><img src="images/conference_splash.jpg" name="center_content" width="576" height="514" border="0" /></a>
	</td>
	<td width="210" align="center"><script language="JavaScript" src="slideshow_home.js"></script></td>
</tr>
<tr><td colspan="3" align="center" class="footer"><?php include_once 'includes/footer.php';?></td></tr>
</table>
</div>
</div>
</body>