<?php 	// Check for URL argument m=late, flagging that no conference was found with rate within current date
	if (isset($_GET['m'])) $m = $_GET['m'];	if(isset($m) && ($m=='late'))
		header("Location:conference_toolate.php");	else
		$mode = '';?>
<html>
  <head>
    <meta content="text/html; charset=windows-1252" http-equiv="content-type">
    <title>Chicks - a Mustang Creek Community Church Ministry - Forney, TX -
      Conference</title>
    <meta name="robots" content="FOLLOW, INDEX">
    <link href="mcccchicks.css" type="text/css" rel="stylesheet">
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
  <body onload="MM_preloadImages('images/merchandise_button_over.gif','images/contact_button_over.gif','images/events_button_over.gif','images/home_button_over.gif')">
    <div id="back_wrapper">
      <div id="back_container"><img src="images/page_background.gif"></div>
    </div>
    <div id="content_wrapper">
      <div id="content_container">
        <table width="1026px" align="center" cellpadding="0px">
          <tbody>
            <tr>
              <td colspan="3"><img src="images/blank.gif" border="0"></td>
            </tr>
            <tr>
              <td width="218">
                <?php include_once('includes/left_buttons.php'); ?> <br>
              </td>
              <td valign="middle" width="590" align="center"> <img src="images/conference_schedule.jpg"
                  name="center_content" usemap="#graphicmap" border="0" height="520"
                  width="570"> <map name="graphicmap">
                  <area shape="rect" coords="333,419,469,497" href="conference_register1.php">
                  <area shape="rect" coords="103,419,237,496" href="conference_blurb.php">
                </map>
              </td>
              <td width="210" align="center">
                <script language="JavaScript" src="slideshow_home.js"></script><br>
              </td>
            </tr>
            <tr>
              <td colspan="3" class="footer" align="center"><?php include_once 'includes/footer.php';?><br>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
