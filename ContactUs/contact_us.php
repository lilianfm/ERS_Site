<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include Files -->
<link rel=StyleSheet href="../style.css">
<script type="text/javascript" src="../Includes/jquery-1.7.2.js"></script>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<?php 
	include("../Includes/includesPHP.php"); 
	// SMTP needs accurate times, set the timezone for PHP
	//date_default_timezone_set('Etc/UTC');
	date_default_timezone_set('America/New_York');
	require '../Includes/PHPMailer-master/PHPMailerAutoload.php';
?>

<title>Contact Us: Contact Info and Request Form</title>
</head>
<body onload="windowResize();"><!-- oncontextmenu="return false;"-->

<script type="text/javascript" src="../Includes/includesJS.js"></script>

<!-- Begin Page Content -->
<div id="container">

<div id="topDiv" class="topDiv">
	<a href="../index.html"><div id="ersLogo"></div></a>
	<div id="tabs">
		<div id="topDivButton" title="aboutUs"   class="AboutUs.html"   onmouseover="overTab(this)"> <p>ABOUT US</p>  </div>
		<div id="topDivButton" title="services"  class="Services.html"  onmouseover="overTab(this)"> <p>SERVICES</p>  </div>
		<div id="topDivButton" title="portfolio" class="Portfolio.html" onmouseover="overTab(this)"> <p>PORTFOLIO</p> </div>
		<div id="topDivButton" title="contactUs" class="contact_us.php" onmouseover="overTab(this)"> <p>CONTACT</p>   </div>

	</div><!--end tabs-->
</div><!--end topDiv-->

<div id="headerRunner">
	<div id="runnerLinks">
		<div id="aboutUs">
			<a href='../AboutUs/mission.html'>Mission Statement</a> 
			<a href='../AboutUs/history.html'>Company History</a>
		</div>
		<div id="services">
			<a href='../Services/medcom.html'>Medical Communications</a> 
			<a href='../Services/salesTraining.html'>Sales Training</a>
			<a href='../Services/whoWeServe.html'>Who We Serve</a>
			<a href='../Services/testimonials.html'>Testimonials</a>
		</div>
		<div id="portfolio">
			<a href='../Portfolio/medIllustration.html'>Medical Illustration</a> 
			<a href='../Portfolio/video.html'>Video</a>
		</div>
		<div id="contactUs">
			<a href='#nogo'><strong>Contact Info and Request Form</strong></a> 
			<a href='careers.html'>Careers</a>
		</div>
	</div><!--end runnerLinks-->
</div><!--end headerRunner-->

<div id="topImage" class="contact">
</div><!--end topImage-->

<div id="content" style="width:75%;">

	<div id="contentHeader" style="padding-top:32px;">
		<h1>CONTACT US</h1>
		<p style="color:rgb(0,61,161);"></p>
	</div><!--end contentHeader-->

	<?php
	// Below is contact form code. On the first load of the page, it allows the user to fill out the form.
	// After the submit button is pressed, it links back to this page again. If it has been filled out correctly
	// it will send the email, clearing the values previously entered. If the form was filled out incorrectly, it 
	// sets which information was incorrect and re-echos the form with the added inconsistencies below.
	// The session variables are to test if the page was refreshed and the data is the same, therefore meaning the
	// email should only be sent once.
	if ( isset( $_REQUEST['email'] ) )
	{
		$formHasBeenSet = true;
		
		// Collect the forms information
		$email    = $_REQUEST['email'];
		$name     = $_REQUEST['name'];		
		$company  = $_REQUEST['company'];
		$question = $_REQUEST['question'];
		
		// Test the mandatory form fields (email and name)
		// Is the email valid?
		if( valEmail( $email ) )
			$validEmail = true;
		else
			$validEmail = false;
		// Is the name valid?
		$name = trim($name);
		if( $name != '' )
			$validName = true;
		else
			$validName = false;
		
		// Should the email be sent?
		if( $validName && $validEmail )
			$sendEmail = true;
		else
			$sendEmail = false;
			
		// Finally, the below code retests if this "Submit" of the form was simply a page refresh
		// and will block a resend of the same data twice.
		
		// Test if the form data is the same as last session, if so don't send email
		if( $_SESSION['email'] == $email && $_SESSION['name'] == $name && $_SESSION['company'] == $company && $_SESSION['question'] == $question )
		{
			$sendEmail = false;
			$dataTheSame = true;
		}
		else
		{
			// Save the new input variables in session for one refresh.
			$_SESSION['email'] = $email;
			$_SESSION['name'] = $name;		
			$_SESSION['company'] = $company;
			$_SESSION['question'] = $question;
			
			$dataTheSame = false;
		}
	}
	else
	{
		$formHasBeenSet = false;
	}
	
	// Begin echoing the form
	echo
	"<form name='input' action='contact_us.php' method='get'>

	<div id='leftCol'>
		<p class='title'>NAME*"; 
		// If the form was set and the name was invalid
		if( $formHasBeenSet && !$validName )
		{
			echo "  <span style='color:red'>Please enter your name.</span>";
		}
	echo
		"</p>
		<p class='if_TypeI'> <input type='text' name='name'";
		// Display the name previously entered
		if( $formHasBeenSet )
		{
			echo " value='$name'";
		}
	echo
		"/> </p>

		<p class='title'>COMPANY </p>
		<p class='if_TypeI'> <input type='text' name='company'"; 
		// Display the company previously entered
		if( $formHasBeenSet )
		{
			echo " value='$company'";
		}
	echo
		"/> </p>

		<p class='title'>EMAIL*";
		// If the form was set and the email was invalid
		if( $formHasBeenSet && !$validEmail )
		{
			echo "  <span style='color:red'>Please enter a valid email address.</span>";
		}
	echo
		"</p>
		<p class='if_TypeI'> <input type='text' name='email'"; 
		// Display the email previously entered
		if( $formHasBeenSet )
		{
			echo " value='$email'";
		}
	echo
		"size='25' /> </p>

		<p class='title'>QUESTIONS/COMMENTS </p>
		<p class='if_TypeII'> <textarea style='resize:none' cols='31' rows='7' name='question'>";
		// Display the name previously entered if entered
		if( $formHasBeenSet )
		{
			echo "$question";
		}
	echo
		"</textarea> </p>

		<input type='image' src='../Images/submit.png' height='32px' width='81px' border='0' alt='Submit Form'>

		</form>";

	// If form has been filled out correctly, send email)
	if ( $formHasBeenSet && $sendEmail )
	{
		// Sends the email, testing whether or not it failed
		// CHANGE FIRST PARAMETER TO: 'info@educationalresource.com'
		//$mailSuccess = mail( "info@educationalresource.com", "$name from $company", $question, "From: <$email>" );

		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = "secure.emailsrvr.com";
		//Set the SMTP port number - likely to be 25, 465 or 587
		$mail->Port = 465;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		//Username to use for SMTP authentication
		$mail->Username = "ers_info@educationalresource.com";
		//Password to use for SMTP authentication
		$mail->Password = "Fish20!5";
		//Set who the message is to be sent from
		$mail->setFrom($email, $name);
		//Set an alternative reply-to address
		//$mail->addReplyTo('replyto@example.com', $name);
		//Set who the message is to be sent to
		$mail->addAddress('ers_info@educationalresource.com', 'ers_info@educationalresource.com');
		//Set the subject line
		$mail->Subject = 'Question/Comment from ' . $name;
		// Set the body of the email
		$mail->Body = "Company: " . $company . "<br /> Question/Comment: <br />" . $question;
		//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';
		if( $mail->send() )
		{
			echo "<div style='color:rgb(0,61,161); font-size:20px; font-style:italic;'>Thank you for using our mail form!</div>";
		}
		else
		{
			echo "<div style='color:red;'>Email failed.</div>";
			//echo "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	else if( $formHasBeenSet && $dataTheSame && $validName && $validEmail )
	{
		echo "<div style='color:red;'>Form data is the same. This email was already successfully sent.</div>";
	}
	
	?>

	</div><!--end leftCol-->
	
	<div id="rightCol" style="line-height:20px;">

		<div id="ColDivIII">
			<div class="title">OFFICE</div>
			<p style="font-size:14px; color:rgb(0,61,161);">732.842.0202</p>
		</div><!--end ColDivIII"-->

		<div id="ColDivIV">
			<div class="title">FAX</div>
			<p style="font-size:14px; color:rgb(0,61,161);">732.842.1707</p>
		</div><!--end ColDivIV-->

		<div id="ColDivV">
			<div class="title">ADDRESS</div>
			<p style="font-size:14px; color:rgb(0,61,161);">The Galleria at 2 Bridge Avenue</p><p style="font-size:14px; color:rgb(0,61,161);">Suite 623</p>
			<p style="font-size:14px; color:rgb(0,61,161);">Red Bank, New Jersey 07701</p>
			<img src="../Images/galleria.png" alt="Galleria Image" />
		</div><!--end ColDivV-->

	</div><!--end rightCol"-->

</div><!--end content-->

<div id="ersBottomBarDiv" style="text-align:center;">
    <span id="floater3" style="float:left; padding-right:2em;  padding-left:18%;padding-top:5px; color:#FFF;  text-shadow: none;font-size:12px;"><a href="../index.html">HOME</a></span>
	<span id="floater4" style="float:left; padding-right:2em; padding-top:5px; color:#FFF;font-size:12px; text-shadow: none;" ><a href="../Services/SiteMap.html">SITE MAP</a></span>
	<span id="floater5" style="float:left; padding-right:2em; padding-top:5px; color:#FFF;font-size:12px; text-shadow: none;"><a href="../AboutUs/PrivacyPolicy.html">PRIVACY POLICY</a></span>
	<span id="floater1" style="float:right; padding-right:18%; padding-top:5px;">
		<a href="http://twitter.com/_ERS_" target="_blank"><img src="../Images/twit.png" width="23" height="16" style="border:0;"></a>
		<a href="http://www.linkedin.com/company/educational-resource-systems-inc." target="_blank"><img src="../Images/linked.png" width="17" height="16" style="border:0;"></a>
	</span>
</div><!--end ersBottomBarDiv-->
<div id="ersBottomDiv" style="text-align:center;">
	<span style="float:left; color:white; padding-left:18%; padding-top:6px; font-size:11px; text-shadow:none;">&#169;2016, Educational Resource Systems. All Rights Reserved.</span>
</div><!--end ersBottomDiv-->



</div><!--end container-->

<div id="clock"></div>


</body>
</html>