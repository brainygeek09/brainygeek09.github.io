<?php

$fullName = trim($_POST['fullName']);
$emailaddress = trim($_POST['emailaddress']);
$phone = trim($_POST['phone']);
$country = trim($_POST['country']);
$gender = trim($_POST['gender']);
$course = trim($_POST['course']);
$qualification = trim($_POST['qualification']);
$tertiaryedu = trim($_POST['tertiaryedu']);
$listpro = trim($_POST['listpro']);
$description = trim($_POST['description']);
$site_owners_email = 'hello@datacquence.com'; // Replace this with your own email address
$message = $_POST['message'];

$msg = "<html><body style='font-family:Arial,sans-serif;'>";
$msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>DATACQUENCE</h2>\r\n";
$msg .= "<p><strong>From:</strong> " . $fullName . "</p>\r\n";
$msg .= "<p><strong>Email Address:</strong> " . $emailaddress . "</p>\r\n";
$msg .= "<p><strong>Phone:</strong> " . $phone . "</p>\r\n";
$msg .= "<p><strong>Country:</strong> " . $country . "</p>\r\n";
$msg .= "<p><strong>Gender:</strong> " . $gender . "</p>\r\n";
$msg .= "<p><strong>Course:</strong> " . $course . "</p>\r\n";
$msg .= "<p><strong>Highest Qualification:</strong> " . $qualification . "</p>\r\n";
$msg .= "<p><strong>Years of Post Tertiary Education:</strong> " . $tertiaryedu . "</p>\r\n";
$msg .= "<p><strong>Programming Languages:</strong> " . $listpro . "</p>\r\n";
$msg .= "<p><strong>Registration Goals:</strong> <br /> " . $description . " </p>";
$msg .= "<p><strong>Message:</strong> <br /> Please enroll me for " . $course . "</p>";
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

if ($country == "") {
    $error['country'] = "Please enter your country";
}

if ($gender == "") {
    $error['gender'] = "Please select your gender";
}

if ($course == "") {
    $error['course'] = "Please select a course";
}

if ($qualification == "") {
    $error['qualification'] = "Please input your highest qualification";
}

if ($tertiaryedu == "") {
    $error['tertiaryedu'] = "Please input your number of years of post tertiary education";
}

if ($listpro == "") {
    $error['listpro'] = "Please provide your list of programming languages";
}

if ($description == "") {
    $error['description'] = "Please describe your registration goals";
}

if (!$error) {
    $mail = mail($site_owners_email, $subject, $msg, $headers);

    echo "<div class='success'>" . $fullName . ", we've received your course enrollment application. Thanks for your interest in DataCquence. We'll be in touch with you as soon as possible! </div>";
} # end if no error
else {

    foreach ($error as $er) {
        echo '<div class="error">' . $er . '</div>';
    }
} # end if there was an error sending
?>