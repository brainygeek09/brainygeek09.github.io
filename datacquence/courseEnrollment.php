<?php

$fullName = trim($_POST['fullName']);
$emailaddress = trim($_POST['emailaddress']);
$phone = trim($_POST['phone']);
$gender = trim($_POST['gender']);
$course = trim($_POST['course']);
$site_owners_email = 'edu@datacquence.com'; // Replace this with your own email address
$message = $_POST['message'];

$msg = "<html><body style='font-family:Arial,sans-serif;'>";
$msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>DATACQUENCE</h2>\r\n";
$msg .= "<p><strong>From:</strong> " . $fullName . "</p>\r\n";
$msg .= "<p><strong>Email Address:</strong> " . $emailaddress . "</p>\r\n";
$msg .= "<p><strong>Phone:</strong> " . $phone . "</p>\r\n";
$msg .= "<p><strong>Gender:</strong> " . $gender . "</p>\r\n";
$msg .= "<p><strong>Course:</strong> " . $course . "</p>\r\n";
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
    $error['message'] = "Please select a course";
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