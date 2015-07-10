<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html> 
	<head> 
	<title>ERS Mobile</title> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400italic,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
    <link rel="stylesheet" href="flexslider.css" type="text/css" media="screen" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="jquery.flexslider-min.js"></script>
	<?php include("includesPHP.php"); ?>
	
    <link rel="stylesheet" href="myStyle.css" type="text/css" media="screen" />

<script type="text/javascript" src="js/includesJS.js"></script>

</head> 
<body onLoad="loaded()"> 
 
<div data-role="page">

    <div data-role="content">
    <div id="hh"><a href="home.html"><img src="top.png" width="257" height="91"></a></div>
     <div id="mybtnHol">
        <div id="bt1" onClick="expand(this)" data-role="button" class="my-btn">
        ABOUT US <br/><br/>
        <a href="Mission.html" rel="", data-ajax="false">MISSION STATEMENT</a><br/><br/>
        <a href="Company.html" rel="", data-ajax="false">COMPANY HISTORY</a>
        </div>
         <div id="bt2" onClick="expand(this)"  data-role="button" class="my-btn">
          SERVICES<br/><br/>
        <a href="MedicalCom.html" rel="", data-ajax="false">MEDICAL COMMUNICATIONS</a><br/><br/>
        <a href="SalesTraining.html" rel="", data-ajax="false">SALES TRAINING</a><br/><br/>
        <a href="WhoWeServe.html" rel="", data-ajax="false">WHO WE SERVE</a><br/><br/>
        <a href="Testimonials.html" rel="", data-ajax="false">TESTIMONIALS</a>
        </div>
         <div id="bt3" onClick="expand(this)"  data-role="button" class="my-btn">
          PORTFOLIO<br/><br/>
        <a href="Medical.html" rel="", data-ajax="false">MEDICAL ILLUSTRATION</a><br/><br/>
         <a href="Video.html" rel="", data-ajax="false">VIDEO</a>
        </div>
         <div id="bt4" onClick="expand(this)"  data-role="button" class="my-btn">
          CONTACT US<br/><br/>
        <a href="ContactUs.php" rel="", data-ajax="false">CONTACT INFO AND REQUEST FORM</a><br/><br/>
        <a href="Careers.html" rel="", data-ajax="false">CAREERS</a>
        </div>
      
      
        </div><!--endmybtnHol-->
             <div id="container" style="padding-bottom:30px; background:#FFFFFF;
										color:rgb(89,129,168);
										font-size:14px;
										line-height:22px;
										padding:10px 8% 10px 8%;" >
				<h3 style="font-size:16px;">CONTACT US</h3>
				<p style=" font-size:14px;"></p>
				
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
	"<form name='input' action='ContactUs.php' method='get'>

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
		// Display the name previously entered if email was not sent
		if( $formHasBeenSet && !$sendEmail )
		{
			echo " value='$name'";
		}
	echo
		"/> </p>

		<p class='title'>COMPANY </p>
		<p class='if_TypeI'> <input type='text' name='company'"; 
		// Display the company previously entered if email was not sent
		if( $formHasBeenSet && !$sendEmail )
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
		// Display the email previously entered if email was not sent
		if( $formHasBeenSet && !$sendEmail )
		{
			echo " value='$email'";
		}
	echo
		"size='25' /> </p>

		<p class='title'>QUESTIONS/COMMENTS </p>
		<p class='if_TypeII'> <textarea style='resize:none' cols='31' rows='7' name='question'>";
		// Display the name previously entered if email was not sent
		if( $formHasBeenSet && !$sendEmail )
		{
			echo "$question";
		}
	echo
		"</textarea> </p>

		<input type='submit' value='Submit' />

		</form>
	</div>";

	// If form has been filled out correctly, send email)
	if ( $formHasBeenSet && $sendEmail )
	{
		// Sends the email, testing whether or not it failed
		// CHANGE FIRST PARAMETER TO: 'info@educationalresource.com'
		$mailSuccess = mail( "info@educationalresource.com", "$name from $company", $question, "From: <$email>" );
		if( $mailSuccess )
		{
			echo "<span style='font-size:16px; font-style:italic;'>Thank you for using our mail form.</span>";
		}
		else
		{
			echo "Email failed.";
		}
	}
	else if( $formHasBeenSet && $dataTheSame && $validName && $validEmail )
	{
		echo "<span style='color:red'>Form data is the same. This email was already successfully sent.</span>";
	}
	
	?>
		
	<div id="rightCol">
		
		<div id="ColDivIII">
			<div class="title">OFFICE</div>
			<p style="font-size:14px;">732 842 0202</p>
		</div><!--end ColDivIII"-->

		<div id="ColDivIV">
			<div class="title">FAX</div>
			<p style="font-size:14px;">732 842 1707</p>
		</div><!--end ColDivIV-->

		<div id="ColDivV">
			<div class="title">ADDRESS</div>
			<p style="font-size:14px; line-height:20px;">The Galleria at 2 Bridge Avenue, Suite 623</p>
			<p style="font-size:14px; line-height:20px;">Red Bank, New Jersey 07701</p>
			<img src="../Images/galleria.png" style="width:100%;" alt="Galleria Image" />
		</div><!--end ColDivV-->	
		
	</div><!--end rightCol"-->
	
      </div>
		
      </div>
        
       <div id="ersBottomBarDiv" style="">
    <div id="floater3" align="center" style="color:#FFF;  text-shadow: none;font-size:12px;padding-right:10px; padding-left:10px;"><a href="home.html">HOME</a>
	<a href="SiteMap.html">SITE MAP</a>
	<a href="PrivacyPolicy.html">PRIVACY POLICY</a><br/>
	
		<a href="http://twitter.com/_ERS_" target="_blank"><img src="twit.png" width="23" height="16" style="border:0;" ></a>
		<a href="http://www.linkedin.com/company/educational-resource-systems-inc." target="_blank"><img src="linked.png" width="17" height="16" style="border:0;"></a>
	</div>
</div><!--end ersBottomBarDiv-->
<div id="ersBottomDiv" align="center" style=" color:white; padding-top:8px; font-size:12px; text-shadow:none;"><span>&#169;2012, Educational Resource Systems. All Rights Reserved.</span>
</div>

</div>
</body></html>