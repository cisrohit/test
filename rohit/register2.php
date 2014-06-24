<?PHP
session_start();
include("connection.php");
//$arrdomain = explode("@",mysql_escape_string($_REQUEST['email']));
$arrdomain = explode("@",$_SESSION['email']);
$sqlsettings = "SELECT * from admin";
$resultsettings = mysql_query($sqlsettings);
$rowsettings = mysql_fetch_array($resultsettings);
session_destroy($_SESSION['email']);
?>
<!DOCTYPE html>

<html lang="en" >

     <head>

    <title>Check your email - <?PHP echo $rowsettings['ScriptName']?></title>

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
                   <li ><a href="search.php">Search </a><ul>
                   <li><a href="search1.php">Advance Search</a></li> 
                   </ul></li>
                   <li><a href="tips.php">Safety Tips </a></li>
                   <li><a href="contactus.php">Contacts </a></li>
                </ul>
             </nav>
           <div class="clear"></div>
    </div>
 </header>
<center>

<div class="container_24 view_table">
 			<div class="register2" style="margin: 0pt 0pt 10px 0px; float: left;"><div style="float: left; text-align: left; padding-top: 10px;">
			<br><br><br>
Thank you for registering with Muslim Rose, you will be receiving an email shortly. Upon receiving the email, simply follow the instructions and click on the link within the email and you are ready to go!
We pray that you find success in finding your life partner and thank you once again for registering with Muslim Rose the path for Muslim Singles..
			<br><br>

Please click here to check your email: <a href="http://www.<?PHP echo $arrdomain[1]?>" target="_blank">http://www.<?PHP echo $arrdomain[1]?></a>
				</div>
				<br clear="all"><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<br clear="all">

		  </div>
	<!-- YAHOO CODE -->
	<!-- YAHOO CODE-->
	<!-- BTM EN -->
		<div style="border-top: 1px solid rgb(143, 167, 191); margin: 0pt 5px; width: 91%;">
				<!-- POLICY + SUBMIT ST -->

				<div class="smallblack" style="padding: 12px 0pt 0pt 25px; text-align: left;">				    <b>

					 <label for="affirm" style="cursor: pointer; font-family: arial; font-style: normal; font-variant: normal; font-weight: bold; font-size: 11px; line-height: normal; font-size-adjust: none; font-stretch: normal;"></label></b></div>

<!-- POLICY + SUBMIT EN -->
			</div>

<!-- BTM EN -->
	  </div><br>
</center>
	
				<?PHP

				include("footer.php");

				?>

		
				</div>
</body></html>