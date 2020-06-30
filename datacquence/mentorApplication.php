<?php

// Pear library includes
// You should have the pear lib installed
include_once('Mail.php');
include_once('Mail_Mime/mime.php');

//Settings 
$max_allowed_file_size = 4096; // size in KB 
$allowed_extensions = array("jpg", "jpeg", "png", "pdf", "doc", "docx");
$upload_folder = './uploads/'; //<-- this folder must be writeable by the script
$your_email = 'hello@datacquence.com';//<<--  update this to your email address

$errors ='';

if(isset($_POST['submit']))
{
	//Get the uploaded file information
	$name_of_uploaded_file =  basename($_FILES['uploaded_file']['name']);
	
	//get the file extension of the file
	$type_of_uploaded_file = substr($name_of_uploaded_file, 
							strrpos($name_of_uploaded_file, '.') + 1);
	
	$size_of_uploaded_file = $_FILES["uploaded_file"]["size"]/1024;
	
	if($size_of_uploaded_file > $max_allowed_file_size ) 
	{
		$errors .= "\n Size of file should be less than $max_allowed_file_size";
	}
	
	//------ Validate the file extension -----
	$allowed_ext = false;
	for($i=0; $i<sizeof($allowed_extensions); $i++) 
	{ 
		if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0)
		{
			$allowed_ext = true;		
		}
	}
	
	if(!$allowed_ext)
	{
		$errors .= "\n The uploaded file is not supported file type. ".
		" Only the following file types are supported: ".implode(',',$allowed_extensions);
    }
    
$fullName = trim($_POST['fullName']);
$emailaddress = trim($_POST['emailaddress']);
$phone = trim($_POST['phone']);
$gender = trim($_POST['gender']);
$linkedinurl = trim($_POST['linkedinurl']);
$twitterurl = trim($_POST['twitterurl']);
$facebookurl = trim($_POST['facebookurl']);
$portfoliourl = trim($_POST['portfoliourl']);
$site_owners_email = 'careers@datacquence.com'; // Replace this with your own email address
$biography = $_POST['biography'];

$msg = "<html><body style='font-family:Arial,sans-serif;'>";
$msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>DATACQUENCE</h2>\r\n";
$msg .= "<p><strong>From:</strong> " . $fullName . "</p>\r\n";
$msg .= "<p><strong>Email Addess:</strong> " . $emailaddress . "</p>\r\n";
$msg .= "<p><strong>Phone:</strong> " . $phone . "</p>\r\n";
$msg .= "<p><strong>Gender:</strong> " . $gender . "</p>\r\n";
$msg .= "<p><strong>LinkedIn URL:</strong> " . $linkedinurl . "</p>\r\n";
$msg .= "<p><strong>Twitter URL:</strong> " . $twitterurl . "</p>\r\n";
$msg .= "<p><strong>Facebook URL:</strong> " . $facebookurl . "</p>\r\n";
$msg .= "<p><strong>Portfolio URL:</strong> " . $portfoliourl . "</p>\r\n";
$msg .= "<p><strong>Biography:</strong> <br /> " . $biography . " </p>";
$msg->addAttachment($uploads);
$msg .= "</body></html>";

$headers = "From: " . $fullName . " \r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

if ($fullName == "") {
    $error['fullName'] = "Please enter your full name";
}

if ($emailaddress == "") {
    $error['emailaddress'] = "Please enter your email address";
}

if ($phone == "") {
    $error['phone'] = "Please enter your phone number";
}

if ($gender == "") {
    $error['gender'] = "Please select your gender";
}

if ($linkedinurl == "") {
    $error['linkedinurl'] = "Please enter your LinkeIn URL";
}

if ($twitterurl == "") {
    $error['twitterurl'] = "Please enter your Twitter URL";
}

if ($facebookurl == "") {
    $error['facebookurl'] = "Please enter your Facebook URL";
}

if ($portfoliourl == "") {
    $error['portfoliourl'] = "Please enter your Portfolio URL";
}

if ($biography == "") {
    $error['biography'] = "Please enter your biography";
}

if (!$error) {
    $mail = mail($site_owners_email, $subject, $msg, $headers);

    echo "<div class='success'>" . $fullName . ", we've received your application. Thanks for your interest in joining our network of instructors. We'll be in touch with you as soon as possible! </div>";
} # end if no error
else {

    foreach ($error as $er) {
        echo '<div class="error">' . $er . '</div>';
    }
} # end if there was an error sending

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>