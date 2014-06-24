<?PHP
session_start();
include("connection.php");
include("classes/generalFunctions.php");
$genObj = new GeneralFunctions();

$sqlsettings = "SELECT * from admin";
$resultsettings = mysql_query($sqlsettings);
$rowsettings = mysql_fetch_array($resultsettings);


$emailMsg = "";
if(isset($_POST['continue']) && $_POST['continue']=="true")
{
$sql = "SELECT * FROM users WHERE EmailAddress='".mysql_escape_string($_POST['email'])."'";
$result = mysql_query($sql,$conn);

$sql2 = "SELECT * FROM users WHERE LoginID='".mysql_escape_string($_POST['login'])."'";
$result2 = mysql_query($sql2,$conn);

if($_REQUEST['dobstatus']=="true")
{
	$dobstatus = 1;
}
else
{
	$dobstatus = 0;
}
	
$age = GetAge(mysql_escape_string($_POST['year']), mysql_escape_string($_POST['month']), mysql_escape_string($_POST['day']));

		if (@mysql_num_rows($result)!=0){
			$emailMsg = "<font color='#FF0000'><strong>* This E-Mail Address is ALREADY REGISTRED </strong></font>";
			}
		
		
		
		else if(@mysql_num_rows($result2)!=0){
			$emailMsg = "<font color='#FF0000'><strong>* This Profile ID is ALREADY REGISTRED</strong></font>";
			}
		
		else if($age < 18 || $age > 60)
		{
			$emailMsg = "<font color='#FF0000'><strong>You cannot be register with us, if your age is less than 18 or greater than 60</strong></font>";
		}
		
		else{


                        $password = $genObj->encrypt_password(addslashes(trim($_POST['password1'])));
		 	$insert = "insert into users(LoginID, EmailAddress, Password, Gender, BirthDate, BirthMonth, BirthYear, ReligionID, CountryID, ConfirmationCode, AddedDate, Age, dobstatus) 
			VALUES (
				'".mysql_escape_string($_POST['login'])."',
				'".mysql_escape_string($_POST['email'])."',
				'".$password."',
				'".mysql_escape_string($_POST['gender'])."',
				'".mysql_escape_string($_POST['day'])."',
				'".mysql_escape_string($_POST['month'])."',
				'".mysql_escape_string($_POST['year'])."',
				".$_POST['community'].",
				".$_POST['countryofresidence'].",
				'".md5(mysql_escape_string($_POST['email']))."',				
				NOW(),
				'".$age."',
				".$dobstatus."
			)";	
			$resultt = mysql_query($insert);

if($rowsettings['smtpstatus'] == 1)		
{
	$body = "<br><br><img src='".$rowsettings['url']."/images/matrimonial-logo-sm.gif'><br><table border='0' width='100%'><tr><Td colspan='2' background='".$rowsettings['url']."/images/footer_seprator.gif' height='2'></Td></tr></table><br><br><br>Aslaam O Alaikum,<br><br>We pray that this message reaches you in good faith and health.  Your registration is almost complete, simply click on the link below to confirm your registration and you can start to enjoy our many unique features.
If for some reason the link below doesn't work, please copy and paste the link into your URL browser and press enter.
Once you confirm your registration, you'll be able to create, modify and share your profile with other Muslim Singles.
We pray for your success Inshallah.<br><br><a href='".$rowsettings['url']."/registration_confirmation.php?confirm=".md5(mysql_escape_string($_POST['email']))."'>".$rowsettings['url']."/registration_confirmation.php?confirm=".md5(mysql_escape_string($_POST['email']))."</a><br /><br />Jazakallah O Khair Waslaam<br /><br />Admin, Muslim Rose";

        $genObj->sendmail($rowsettings['smtp'], $rowsettings['port'], $rowsettings['AdminEmail'], $rowsettings['AdminEmailPassword'], $rowsettings['smtpsecure'], $rowsettings['ScriptName'], $_POST['email'], 'Welcome To Muslim Rose', $body);
	
	}
	else
	{
	$to=$_POST['email'];
	$email_layout = "<br><br><img src='".$rowsettings['url']."/images/matrimonial-logo-sm.gif'><br><table border='0' width='100%'><tr><Td colspan='2' background='".$rowsettings['url']."/images/footer_seprator.gif' height='2'></Td></tr></table><br><br><br>Dear Member,<br><br>Your Registration with ".$rowsettings['ScriptName']." has been successfully completed, but you need to confirm your registration first by clicking the below link. If you cannot access the confirmation page by clicking at this link, then kindly copy paste this link into your browser's address bar and press enter. After you will confirm your registration, You will be able to create your profile.<br><br><br>click below to confirm your registration:<br><br><a href='".$rowsettings['url']."/registration_confirmation.php?confirm=".md5(mysql_escape_string($_POST['email']))."'>".$rowsettings['url']."/registration_confirmation.php?confirm=".md5(mysql_escape_string($_POST['email']))."</a>";
	$subject="Action Required to Confirm Registration";
	$description=$email_layout;
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: ".$rowsettings['ScriptName']." <".$rowsettings['AdminEmail'].">\r\n";

	$res=@mail($to,$subject,$description,$headers);
	}
	$_SESSION['email'] = mysql_escape_string($_POST['email']);
	//header("Location: register2.php?email=".mysql_escape_string($_POST['email']));
	header("Location: register2.php");
		}
}

$sq = "SELECT * from users";
$sqres = mysql_query($sq);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Register - <?PHP echo $rowsettings['ScriptName']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
     <link rel="icon" href="images/favicon.ico">
     <link rel="shortcut icon" href="images/favicon.ico" />
	 <link rel="stylesheet" href="css/register.css">
	 <link rel="stylesheet" href="css/style.css">

<script language="javascript" src="js/register.js"></script>		
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

<body id="top" oncontextmenu="return false" onselectstart="return false" ondragstart="return false" marginheight="2" marginwidth="0" background="images/background.jpg">


<script language="javascript" src="js/matrimonials-v10.js"></script>
<div class="main">

<!--==============================header=================================-->

<header> <div class="container_24 stat">

      <div class="grid_24">  <h1><a href="index.html"><img src="images/logo.png" alt="Dating"></a> </h1>

      <div class="h_right">

       
<?php
          if(@$_SESSION['UserID']!="")

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

			<b>Login</b> &nbsp; <input name="login" value="Email ID" onFocus="if(this.value=='Email ID') this.value='';" onBlur="if(this.value=='') this.value='Email ID';" size="16" type="text">&nbsp; &nbsp;<input name="password" value="******" onFocus="if(this.value=='******') this.value='';" onBlur="if(this.value=='') this.value='******';" size="14" type="password">&nbsp; 
            <span class="go_btn"><input src="images/go.gif" title="Login" align="top" border="0" type="image"><input name="homepage" value="Y" type="hidden"><input name="continue" value="true" type="hidden"> &nbsp; <a href="forget_password.php" class="xsmall" title="Forgot Password?" style="font-size:smaller">Forgot Password?</a></span>
                        <div>
                                <span class="remb" style="float: left;margin-left:60px;"> <label for="autologin" ><input  name="autologin" id="autologin" value="Y" type="checkbox" >Remember Me</label></span>
                        </div>
			</form>
          <div class="autorz">

          <a href="register.php">Create an account</a><a href="login.php">Login</a>
         

          </div>

		<?PHP

}

?>		

			

        

      </div>

   

           </div>

    </div>

    

    <?php include_once('includes/menu.php');?>

 </header>
<center>
<div class="container_24 register_page" style=" padding:0 15px;">
	<div class="mediumblack">
		<div>
 			<div>
				<br>
				<?PHP 
				if($emailMsg != "")
				{
					echo $emailMsg;
				}
				?>
				
<?php if(isset($_SESSION['SESS_MSG'])) { ?>
<div class="sess-message"><?php echo $_SESSION['SESS_MSG'];?></div>
<?php } ?>
				<div class="register_page_title"><img src="images/why-register.gif" height="20" width="108"><br>
				<li> <span>Enjoy limitless Possibilities </span> </li>
				<li> <span>View Profiles catered to your requirements </span> </li>				
				<li> <span>Interact more freely via Muslim Rose Live Video Chat </span> </li>
				<li> <span>Speak to like minded Members via Muslim Rose Live Chat </span> </li>
				<li> <span>Message members</span> </li>
				<li> <span>Advanced features for those specific traits to better suit your liking</span> </li>
				</div>

				<br clear="all">
				<div style="border-bottom: 1px solid rgb(143, 167, 191); padding: 15px 0pt 5px 0px; width: 45%; float: left; text-align: left;">
				<img src="images/enter-details.gif" alt="Enter your details to register for FREE!" height="20"></div>
				<div class="smallgrey" style="border-bottom: 1px solid rgb(143, 167, 191); padding: 2px 0pt 5px 0px; width: 55%; float: left; text-align: right;"><span style="font-family: Arial; font-style: normal; font-variant: normal; font-weight: normal; font-size: 16px; font-size-adjust: none; font-stretch: normal; line-height: 18px;"><br></span>Already Registered? <a href="login.php" class="smallbluelink"><b>Login</b></a>&nbsp;</div><br clear="all">
				<div style="padding: 5px 0pt 10px 0px; text-align: left; font-family: tahoma; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-size-adjust: none; font-stretch: normal; color: rgb(127, 127, 127);">All fields are compulsory, by filling in all the required details below; you ensure the chances of your success on Muslim Rose.</div>
			</div>



			<!-- YAHOO CODE -->
							<!-- YAHOO CODE-->



			
			<form method="post" action="register.php" name="frm_registration" id="frm_registration" autocomplete="off" onSubmit="return validateform(this);">
			<input name="email"  type="hidden" value="">
			<input name="continue" value="true" type="hidden">
			<div id="regform">



				<div>


					<div class="div1">
					<div class="reg_form">
					
						<div class="left_reg_form">

					
		<!-- FORM TABLE ST -->
		<script src="js/common.js" type="text/javascript" language="javascript1.2"></script>
		<script src="js/registration.js" type="text/javascript" language="javascript1.2"></script>
		<script src="js/common_002.js"></script>

		
		<table class="tblreg" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
                   <!-- <tr>
			<td nowrap="nowrap" width="150"><label for="profileid">Refrence</label></td>
                        <td class="smallgrey">
                            <select class="field_filled" name="refid" id="refid">
                                <option value="other">other</option>
                                <?php while ($row = mysql_fetch_array($sqres))
                                    { ?>
                                       <option value="<?php echo $row['LoginID']; ?>"><?php echo $row['LoginID']; ?></option>
                                  <?php  }
                                ?>
                            </select>
                        </td>
		</tr>-->
                    <tr>
			<td nowrap="nowrap" width="150"><label for="profileid">Profile ID</label></td>
			<td class="smallgrey"><input tabindex="1" class="field" name="login" id="profileid" value="<?PHP if(isset($_REQUEST['login'])) { echo $_REQUEST['login']; } ?>" onkeydown="this.className='field'" onfocus="toggleHint('show', this.name)" onblur="validate_login();" type="text">
		<!-- HINT STARTS HERE -->
		<span class="hint" id="hint_login">
		<div>
			<div><img src="images/top-hint.gif" height="10" width="201"></div>
			<div style="padding: 0pt 5px 0pt 8px; background: transparent url(images/bg-hint.gif) no-repeat scroll 0%; width: 201px; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial; font-family: arial; font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; line-height: normal; font-size-adjust: none; font-stretch: normal; color: rgb(127, 127, 127);"><b>Your nickname on <?PHP echo $rowsettings['ScriptName']?></b><br>Minimum 4 characters. Your Profile ID<br>can only contain letters or numbers.</div>
			<div><img src="images/bottom-hint.gif" height="9" width="201"></div>
		</div>
		<div style="position: absolute; top: 25px; left: -20px;"><img src="images/arrow-hint.gif" height="16" width="21"></div>
		</span>
		<!-- HINT ENDS HERE -->
	<br>
			<span id="errmsg_login" class="error"></span></td>
		</tr>
		<tr>
			<td><label for="email">Email</label></td>
			<td class="smallgrey"><input tabindex="3" class="field" name="email" id="email" value="<?PHP if(isset($_REQUEST['email'])){ echo $_REQUEST['email']; } ?>" onkeydown="this.className='field'" onfocus="toggleHint('show', this.name)" onblur="validate_email();" type="text">
		<!-- HINT STARTS HERE -->
		<span class="hint" id="hint_email">
		<div>
			<div><img src="images/top-hint.gif" height="10" width="201"></div>
			<div style="padding: 0pt 5px 0pt 8px; background: transparent url(images/bg-hint.gif) no-repeat scroll 0%; width: 201px; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial; font-family: arial; font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; line-height: normal; font-size-adjust: none; font-stretch: normal; color: rgb(127, 127, 127);"><b>Type your email address</b><br>We will use this Email Address to send you profiles that match your requirements.</div>
			<div><img src="images/bottom-hint.gif" height="9" width="201"></div>
		</div>
		<div style="position: absolute; top: 25px; left: -20px;"><img src="images/arrow-hint.gif" height="16" width="21"></div>
		</span>
		<!-- HINT ENDS HERE -->
	<br>
			<span id="errmsg_email" class="error"></span></td>
		</tr>
		<tr>
			<td><label for="retypeemail">Confirm Email</label></td>
			<td><input tabindex="4" class="field" name="retypeemail" id="retypeemail" value="<?PHP if(isset($_REQUEST['retypeemail'])) { echo $_REQUEST['retypeemail']; } ?>" onkeydown="this.className='field'" onfocus="toggleHint('show', this.name)" onblur="validate_retypeemail();" type="text">
		<!-- HINT STARTS HERE -->
		<span class="hint" id="hint_retypeemail">
		<div>
			<div><img src="images/top-hint.gif" height="10" width="201"></div>
			<div style="padding: 0pt 5px 0pt 8px; background: transparent url(images/bg-hint.gif) no-repeat scroll 0%; width: 201px; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial; font-family: arial; font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; line-height: normal; font-size-adjust: none; font-stretch: normal; color: rgb(127, 127, 127);"><b>Retype your email address</b><br>This will make sure you have typed the correct email address.</div>
			<div><img src="images/bottom-hint.gif" height="9" width="201"></div>
		</div>
		<div style="position: absolute; top: 25px; left: -20px;"><img src="images/arrow-hint.gif" height="16" width="21"></div>
		</span>
		<!-- HINT ENDS HERE -->
	<br>
			<span id="errmsg_retypeemail" class="error"></span></td>
		</tr>
		<tr class="spacer">
			<td colspan="2"><br></td>
		</tr>
		<tr>
			<td><label for="password1">Password</label></td>
			<td class="smallgrey"><input tabindex="5" class="field" name="password1" id="password1" value="<?PHP echo $_REQUEST['password1']?>" onkeydown="this.className='field'" onfocus="toggleHint('show', this.name)" onblur="validate_password1();" type="password">
		<!-- HINT STARTS HERE -->
		<span class="hint" id="hint_password1">
		<div>
			<div><img src="images/top-hint.gif" height="10" width="201"></div>
			<div style="padding: 0pt 5px 0pt 8px; background: transparent url(images/bg-hint.gif) no-repeat scroll 0%; width: 201px; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial; font-family: arial; font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; line-height: normal; font-size-adjust: none; font-stretch: normal; color: rgb(127, 127, 127);"><b>Type your password</b><br>Minimum 4 characters. Your password cannot contain spaces.</div>
			<div><img src="images/bottom-hint.gif" height="9" width="201"></div>
		</div>
		<div style="position: absolute; top: 25px; left: -20px;"><img src="images/arrow-hint.gif" height="16" width="21"></div>
		</span>
		<!-- HINT ENDS HERE -->
	<br>
			<span id="errmsg_password1" class="error"></span></td>
		</tr>
		<tr>
			<td><label for="password2">Confirm Password</label></td>
			<td><input tabindex="6" class="field" name="password2" id="password2" value="<?PHP echo $_REQUEST['password2']?>" onkeydown="this.className='field'" onfocus="toggleHint('show', this.name)" onblur="validate_password2();" type="password">
		<!-- HINT STARTS HERE -->
		<span class="hint" id="hint_password2">
		<div>
			<div><img src="images/top-hint.gif" height="10" width="201"></div>
			<div style="padding: 0pt 5px 0pt 8px; background: transparent url(images/bg-hint.gif) no-repeat scroll 0%; width: 201px; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial; font-family: arial; font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; line-height: normal; font-size-adjust: none; font-stretch: normal; color: rgb(127, 127, 127);"><b>Retype your password</b><br>Minimum 4 characters. Your password cannot contain spaces.</div>
			<div><img src="images/bottom-hint.gif" height="9" width="201"></div>
		</div>
		<div style="position: absolute; top: 25px; left: -20px;"><img src="images/arrow-hint.gif" height="16" width="21"></div>
		</span>
		<!-- HINT ENDS HERE -->
	<br>
			<span id="errmsg_password2" class="error"></span></td>
		</tr>
		<tr class="spacer">
			<td colspan="2"><br></td>
		</tr>
		<tr>
			<td><label for="male">Gender</label></td>
			<td><input tabindex="7" name="gender" id="male" value="Male" onfocus="toggleHint('show', this.name)" onblur="validate_gender()" onclick="document.getElementById('errmsg_gender').innerHTML=''" type="radio">
		<!-- HINT STARTS HERE -->
		<span class="hint" id="hint_gender">
		<div>
			<div><img src="images/top-hint.gif" height="10" width="201"></div>
			<div style="padding: 0pt 5px 0pt 8px; background: transparent url(images/bg-hint.gif) no-repeat scroll 0%; width: 201px; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial; font-family: arial; font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; line-height: normal; font-size-adjust: none; font-stretch: normal; color: rgb(127, 127, 127);">Please select the gender of the person looking to get married.</div>
			<div><img src="images/bottom-hint.gif" height="9" width="201"></div>
		</div>
		<div style="position: absolute; top: 25px; left: -20px;"><img src="images/arrow-hint.gif" height="16" width="21"></div>
		</span>
		<!-- HINT ENDS HERE -->
	 <label class="smallblack l2" for="male">Male &nbsp;</label>
			<input tabindex="7" name="gender" id="female" value="Female" onfocus="toggleHint('show', this.name)" onblur="validate_gender()" onclick="document.getElementById('errmsg_gender').innerHTML=''" type="radio"> <label class="smallblack l2" for="female">Female</label><br>
			<span id="errmsg_gender" class="error"></span></td>
		</tr>

		<tr>
			<td style="cursor: pointer;" onclick="focus_field('day');">Date of Birth</td>
			<td class="smallgrey">
			<select tabindex="8" id="day" name="day" class="field_dob" onfocus="toggleHint('show', 'dateofbirth')" onblur="validate_dateofbirth(this.name);"><option selected="selected" value="">Day</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>&nbsp; <select tabindex="9" name="month" class="field_dob" onfocus="toggleHint('show', 'dateofbirth')" onblur="validate_dateofbirth(this.name);"><option selected="selected" value="">Month</option><option value="01">Jan</option><option value="02">Feb</option><option value="03">Mar</option><option value="04">Apr</option><option value="05">May</option><option value="06">Jun</option><option value="07">Jul</option><option value="08">Aug</option><option value="09">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option></select>&nbsp; 
                        <select tabindex="10" name="year" class="field_dob" onfocus="toggleHint('show', 'dateofbirth')" onblur="validate_dateofbirth(this.name);">
                            <option selected="selected" value="">Year</option>
                            <?php  echo 'dsfsdsdsdf';
                                 $year = date('Y');
                                 $yearnew = $year - 18; 
                                for($i = $yearnew; $i >= ($yearnew-60); $i--)
                                { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                            ?>
                            
                           <!-- HINT STARTS HERE -->
		<span class="hint" id="hint_dateofbirth">
		<div>
			<div><img src="images/top-hint.gif" height="10" width="201"></div>
			<div style="padding: 0pt 5px 0pt 8px; background: transparent url(images/bg-hint.gif) no-repeat scroll 0%; width: 201px; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial; font-family: arial; font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; line-height: normal; font-size-adjust: none; font-stretch: normal; color: rgb(127, 127, 127);">Please select date of birth of the<br>person looking to get married.<br>(Visible only to you)</div>
			<div><img src="images/bottom-hint.gif" height="9" width="201"></div>
		</div>
		<div style="position: absolute; top: 25px; left: -20px;"><img src="images/arrow-hint.gif" height="16" width="21"></div>
		</span>
		<!-- HINT ENDS HERE -->
<br>

			<span id="errmsg_dateofbirth" class="error"></span><br /> <br /></td>
		</tr>
		<tr>
			<td style="cursor: pointer;" onclick="focus_field('community');">Sect / Community</td>
			<td>
			<select tabindex="11" name="community" id="community" class="field" onblur="validate_community();"><option value="">Select</option>
			<?PHP
				$sqlCountry = "SELECT * FROM religion order by ReligionID";
				$resultCountry = mysql_query($sqlCountry, $conn);
				if (@mysql_num_rows($resultCountry)!=0){
					while($rowCountry = mysql_fetch_array($resultCountry))
					{
						?>
						<option value="<?PHP echo $rowCountry['ReligionID']?>"><?PHP echo $rowCountry['Religion']?></option>
						<?
					}
				}				
				?>
			</select><br>
			<span id="errmsg_community" class="error"></span></td>
		</tr>
		<tr>
			<td style="cursor: pointer;" onclick="focus_field('countryofresidence');">Country of Residence</td>
			<td><select tabindex="12" name="countryofresidence" id="countryofresidence" class="field" onblur="validate_countryofresidence();"><option value="">Select</option>
			<?PHP
				$sqlCountry = "SELECT * FROM countries order by CountryID";
				$resultCountry = mysql_query($sqlCountry, $conn);
				if (@mysql_num_rows($resultCountry)!=0){
					while($rowCountry = mysql_fetch_array($resultCountry))
					{
						?>
						<option value="<?PHP echo $rowCountry['CountryID']?>"><?PHP echo $rowCountry['Country']?></option>
						<?
					}
				}				
				?>
			</select><br>
			<span id="errmsg_countryofresidence" class="error"></span></td>
		</tr>
		</tbody></table>
		<!-- FORM TABLE EN -->
	
						</div>
						<div class="right_reg_form"><!-- MODEL IMAGE ST -->
							<img src="images/model-01.png" border="0"><br>
							<!--<img src="images/model-01-b.jpg" border="0" height="139" width="268"><br>
							<img src="images/model-01-c.jpg" border="0" height="108" width="268">--><!-- MODEL IMAGE EN --></td>
					</div>
					</div>
					</div><br clear="all">
				</div>

			</div>

			<!-- BTM EN -->

			<div class="reg_m_border" style="border-top: 1px solid rgb(143, 167, 191); margin: 0pt 5px; padding:10px 0 0;">

				<!-- POLICY + SUBMIT ST -->
				<div class="smallblack" style="padding: 12px 0pt 0pt 25px; text-align: left;">

					<span class="input"><input tabindex="12" id="affirm" name="confirm_policy" type="checkbox"></span> <b><label for="affirm" style="cursor: pointer; font-family: arial; font-style: normal; font-variant: normal; font-weight: bold; font-size: 11px; line-height: normal; font-size-adjust: none; font-stretch: normal;">I have read and accepted Muslim Rose's <a style="text-decoration: underline;" href="terms_condition.php" class="smallbluelink" target="_blank"><b>Terms and Conditions</b></a> and <a style="text-decoration: underline;" href="privacy_policy.php" class="smallbluelink" target="_blank"><b>Privacy Policy</b></a>.<br><span style="line-height: 10px;"></span></label></b>

										<input src="images/submit.gif" border="0" hspace="0" type="image" vspace="15">
									</div>
				<!-- POLICY + SUBMIT EN -->

			</div>
			<!-- BTM EN -->
			</form>

			</div><br><br>



		</div>
	</div>


</center>




			
						
				<?PHP
				include("footer.php");
				?>
			
</body></html>
<?php unset($_SESSION['SESS_MSG']); ?>