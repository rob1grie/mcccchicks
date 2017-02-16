<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Easy PHP Calendar AJAX Demonstration</title>
<?php $CSS=1; require ("calendar.php"); ?>
<?php $EPCAJAX=1; require ("calendar.php"); ?>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
body,td,th {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body>
<?php $OL=1; require ("calendar.php"); ?>

<div align="center"><strong>Easy PHP Calendar AJAX Demonstration</strong></div>

<p align="center"><strong><font color=red size=4>This is not an advertised feature and is not supported.</font></strong></p>
<p align="center"><em>This is only an example of a feature that may be included in a future release.</em></p>
<p align="center">The content on this page doesn't reload when navigating using the AJAX links below.
  <br /><br />
  <em><strong>Only the calendar will change!</strong></em>
  <br /><br />
Page loaded at <?php echo date("i")." minutes and ".date("s")." seconds..."; ?></p>

<div id="EPCcalendar" align="center">
<?php $EPCajax=1; require ("calendar.php"); ?>
</div> 

</body>
</html>
