<?php

// Pear library includes
// You should have the pear lib installed
include_once('Mail.php');
include_once('Mail_Mime/mime.php');

//Settings 
$max_allowed_file_size = 4096; // size in KB 
$allowed_extensions = array("jpg", "jpeg", "png", "pdf", "doc", "docx");
$upload_folder = './uploads/'; //<-- this folder must be writeable by the script
$your_email = 'edu@datacquence.com';//<<--  update this to your email address

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
$course = trim($_POST['course']);
$qualification = trim($_POST['qualification']);
$linkedinurl = trim($_POST['linkedinurl']);
$tertiaryedu = trim($_POST['tertiaryedu']);
$employment = trim($_POST['employment']);
$listpro = trim($_POST['listpro']);
$description = trim($_POST['description']);
$site_owners_email = 'edu@datacquence.com'; // Replace this with your own email address
$message = $_POST['message'];

$msg = "<html><body style='font-family:Arial,sans-serif;'>";
$msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>DATACQUENCE</h2>\r\n";
$msg .= "<p><strong>From:</strong> " . $fullName . "</p>\r\n";
$msg .= "<p><strong>Email Address:</strong> " . $emailaddress . "</p>\r\n";
$msg .= "<p><strong>Phone:</strong> " . $phone . "</p>\r\n";
$msg .= "<p><strong>Gender:</strong> " . $gender . "</p>\r\n";
$msg .= "<p><strong>Course:</strong> " . $course . "</p>\r\n";
$msg .= "<p><strong>Highest Qualification:</strong> " . $qualification . "</p>\r\n";
$msg .= "<p><strong>Years of Post Tertiary Education:</strong> " . $tertiaryedu . "</p>\r\n";
$msg .= "<p><strong>Employment Status:</strong> " . $employment . "</p>\r\n";
$msg .= "<p><strong>Programming Languages:</strong> " . $listpro . "</p>\r\n";
$msg .= "<p><strong>LinkedIn URL:</strong> " . $linkedinurl . "</p>\r\n";
$msg .= "<p><strong>Registration Goals:</strong> <br /> " . $description . " </p>";
$msg->addAttachment($uploads);
$msg .= "<p><strong>Message:</strong> <br /> Please enrol me for " . $course . "</p>";
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

if ($course == "") {
    $error['course'] = "Please select a course";
}

if ($linkedinurl == "") {
    $error['linkedinurl'] = "Please enter your LinkedIn URL";
}

if ($qualification == "") {
    $error['qualification'] = "Please input your highest qualification";
}

if ($tertiaryedu == "") {
    $error['tertiaryedu'] = "Please input your number of years of post tertiary education";
}

if ($employment == "") {
    $error['employment'] = "Please select your employment status";
}

if ($listpro == "") {
    $error['listpro'] = "Please provide your list of programming languages";
}

if ($description == "") {
    $error['description'] = "Please describe your registration goals";
}

if (!$error) {
    $mail = mail($site_owners_email, $subject, $msg, $headers);

    echo "<div class='success'>" . $fullName . ", we've received your course enrollment. Thanks for your interest in DataCquence. We'll be in touch with you as soon as possible! </div>";
} # end if no error
else {

    foreach ($error as $er) {
        echo '<div class="error">' . $er . '</div>';
    }
} # end if there was an error sending
?>