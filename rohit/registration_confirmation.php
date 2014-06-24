<?PHP
	session_start();
	include("connection.php");
$sqlsettings = "SELECT * from admin";
$resultsettings = mysql_query($sqlsettings);
$rowsettings = mysql_fetch_array($resultsettings);
	$msg = 0;
	if($_REQUEST['confirm']!=""){
		$query = "SELECT * from users WHERE ConfirmationCode='".mysql_escape_string($_REQUEST['confirm'])."' and Status=0";		
		$result = mysql_query ($query);
	if(@mysql_num_rows($result) != 0)
		{
		$row = @mysql_fetch_array($result);
		$query5 = "update users set Status=1 where ConfirmationCode='".mysql_escape_string($_REQUEST['confirm'])."'";
			$result5 = mysql_query($query5);
			$msg = 1;
			$_SESSION['UserID_reg']=$row['UserID'];
			$_SESSION['LoginID_reg']=$row['LoginID'];
			$_SESSION['EmailAddress_reg']=$row['EmailAddress'];
			$insert = "insert into user_profile(UserID) VALUES(".$row['UserID'].")";
			$resultt = mysql_query($insert);
			$insert = "insert into partner_profile(UserID) VALUES(".$row['UserID'].")";			
			$resultt = mysql_query($insert);
		}
	}
?>

<!DOCTYPE html>

<html lang="en" >

     <head>

    <title>Registration Confirmation - <?PHP echo $rowsettings['ScriptName']?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
     <meta name = "format-detection" content = "telephone=no" />
     <link rel="icon" href="images/favicon.ico">
     <link rel="shortcut icon" href="images/favicon.ico" />
     <link rel="stylesheet" href="css/style.css">
     <script src="js/jquery.js"></script>
     <script src="js/jquery-migrate-1.1.1.js"></script>
    <script src="js/script.js"></script> 
     <script src="js/jquery.horizontalNav.js"></script>
     <script src="js/jquery.jqtransform.js"></script>
     <script src="js/superfish.js"></script>
     <script src="js/jquery.equalheights.js"></script>
     <script src="js/jquery.mobilemenu.js"></script>
     <script src="js/jquery.easing.1.3.js"></script>
     <script>
$(window).load(function() { 
$('.full-width').horizontalNav({});
    });
$(function() {

    //find all form with class jqtransform and apply the plugin

    $("#form1").jqTransform();

});
      function goToByScroll(id){$('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');}
     </script>
     <!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
         </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <link rel="stylesheet" media="screen" href="css/ie.css">
      <link rel="stylesheet" media="screen" href="css/ie.css">
    <![endif]-->
     </head>

 <body class="" id="top">
<script language="javascript" src="js/matrimonials-v10.js"></script>
       <div class="main">

<!--==============================header=================================-->

<header> <div class="container_24 stat">
      <div class="grid_24">  <h1><a href="index.html"><img src="images/logo.png" alt="Dating"></a> </h1>

      <div class="h_right">
<?php
if($_SESSION['UserID']!="")
{
?>
 <div class="autorz">
<a href="myaccount.php" title="My Account" >My Account</a> 
<a href="my_profile.php" title="My Profile" >My Profile</a> 
<a href="logout.php" title="Log Out" >Log Out</a> 
</div>
<?PHP
}
else
{
?>	
	<form method="post" action="login.php" name="loginpage" autocomplete="off" style="margin: 4px 0pt 0pt 0px;">

	<b>Login</b> &nbsp; <input name="login" value="Email ID" onFocus="if(this.value=='Email ID') this.value='';" onBlur="if(this.value=='') this.value='Email ID';" size="16" type="text">&nbsp; &nbsp;<input name="password" value="******" onFocus="if(this.value=='******') this.value='';" onBlur="if(this.value=='') this.value='******';" size="14" type="password">&nbsp; <input src="images/go.gif" title="Login" align="top" border="0" type="image"><input name="homepage" value="Y" type="hidden"><input name="continue" value="true" type="hidden"> &nbsp; <a href="forget_password.php" class="xsmall" title="Forgot Password?" style="font-size:smaller">Forgot Password?</a>

	</form>

<?PHP
}
?>		
        <div class="autorz">
          <a href="register.php">Create an account</a><a href="login.php">Login</a>
        </div>
      </div>
           </div>
    </div>
    <div class="menu_block">
           <nav class="horizontal-nav full-width horizontalNav-notprocessed">
            <ul class="sf-menu">
                   <li ><a href="index.php">Home </a></li>                  
                   <li class="current"><a href="register.php">Free sign up </a></li>
                   <li><a href="chat.php">Live Chat </a></li>
                   <li ><a href="search.php">Search </a></li> 
                   <li><a href="tips.php">Safety Tips </a></li>
                   <li><a href="contactus.php">Contacts </a></li>
                 </ul>
              </nav>
           <div class="clear"></div>
    </div>
 </header>
<center>

<br><br><br>
		<?PHP
		if($msg == 1){
		?>
		<h3 class="col1">Congratulations!</h3><h3> Your Registration has been successfully Completed...</h3>
		<br><br>
		<!--<h3><a href="profile1.php" class="col1">Click here to create your profile now!</a> Your profile will be displayed on Muslim Rose instantly and all profile pictures will be displayed upon Muslim Rose's administration approval...</h3>-->
		<h3>Your profile will be displayed on Muslim Rose instantly and all profile pictures will be displayed upon Muslim Rose's administration approval...</h3>
		<?PHP
		}
		else{
		?>
		<br><br><br>
		<h3 class="col1">Lets try again!!! There seems to be a problem with you registration to Muslim Rose, please try again by clicking on the link sent to you by email.
Thank you
		</h3>
		<?PHP
		}
		?>
                 <!-- YAHOO CODE -->
		<!-- YAHOO CODE-->
		<!-- BTM EN -->
</center>

<br><br><br><br><br><br><br><br><br><br><br><br>
<?PHP include("footer.php"); ?>
</body></html>