<?php session_start(); ?>
<html>
    <head>
        <title>Chicks - a Mustang Creek Community Church Ministry - Forney, TX - 5K Registration</title>
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
            self.location='events.php?cancel';
            }
            }
            //-->
        </script>
    </head>
    <body onLoad="MM_preloadImages('images/merchandise_button_over.gif', 'images/contact_button_over.gif', 'images/events_button_over.gif', 'images/home_button_over.gif')">
        <div id="back_wrapper">
            <div id="back_container"><img src="images/page_background.gif"/></div>
        </div>
        <div id="content_wrapper">
            <div id="content_container">
                <table align="center" width="1024px" cellpadding="0px">
                    <tr><td colspan="3"><img src="images/blank.gif" border="0"/></td></tr>
                    <tr>
                        <td width="222">
                            <?php include_once('includes/left_buttons.php'); ?>
                        </td>
                        <td width="590" valign="top" align="center">
                            <table align="center" width="95%" border="0">
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td width="100%" align="center">
                                        <!-- Content area -->
                                        <h2>Chicks 'Run For Your Life' 5K</h2>
                                        <h3>
                                            March 22, 8am<br>
                                            $20 per registrant
                                        </h3>
                                        <table width="80%">
                                            <tr>
                                                <td align="center">
                                                    <p class="lineheight-24">It's a simple process!<br>
                                                        Provide your name and email address,<br>
                                                        specify how many people you are registering for,<br>
                                                        and click <span class="form_title">Continue</span> to confirm<br>
                                                        the information you have entered.
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr><td>&nbsp;</td></tr>
                                            <tr><td class='small_message' align='center'>(All fields are required)</td></tr>
                                            <tr>
                                                <td>
                                                    <form action='5k-confirm.php' method='post'>
                                                        <table width='100%'>
                                                            <tr>
                                                                <td align='right' class="<?php echo isset($_SESSION['name_error']) ? 'form_label_error' : 'form_label'; ?>">Your name:</td>
                                                                <td align='left'>
                                                                    <input type='text' size='30' name='name' value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align='right' class="<?php echo isset($_SESSION['email_error']) ? 'form_label_error' : 'form_label'; ?>">Your email:</td>
                                                                <td align='left'>
                                                                    <input type='text' size='30' name='email' value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align='right' class="<?php echo isset($_SESSION['qty_error']) ? 'form_label_error' : 'form_label'; ?>"># Participants:</td>
                                                                <td align='left'>
                                                                    <input type='text' size='3' name='quantity' value="<?php echo isset($_SESSION['quantity']) ? $_SESSION['quantity'] : ''; ?>" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" align='center'>
                                                                    <input type='checkbox' name="paypal_fee" <?php echo isset($_SESSION['paypal_fee']) ? 'checked' : ''; ?> />
                                                                    <span class='small_message'>
                                                                        Check here if you would like<br>
                                                                        to include the PayPal fee<br>
                                                                        (30 cents + 2.2% of total)
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                            <tr>
                                                                <td colspan='2' align='center'>
                                                                    <input type='submit' value='Continue' />&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input type='button' value='Cancel' onclick='confirm_cancel();' />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>	
                        <td width="202" align="left"><script language="JavaScript" src="slideshow_home.js"></script></td>
                    </tr>
                    <tr><td colspan="3" align="center" class="footer"><?php include_once 'includes/footer.php'; ?></td></tr>
                </table>
            </div>
        </div>
    </body>