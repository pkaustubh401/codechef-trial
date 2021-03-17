<?php
//message Vars
$msg = '';
$msgClass = '';

if (filter_has_var(INPUT_POST, 'submit')) {

    //get data in variables
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $codechef = htmlspecialchars($_POST['codechef']);
    $phone = htmlspecialchars($_POST['phone']);
    $department = htmlspecialchars($_POST['department']);
    $graduation = htmlspecialchars($_POST['graduation']);
    $message = htmlspecialchars($_POST['message']);

    //check required
    if (!empty($name) && !empty($email) && !empty($phone)) {
        //PASSES
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            //failed email
            $msg = 'Email is not valid';
            $msgClass = 'alert-danger';
        } else {
            //recipient email
            $toEmail = 'pkaustubh401@gmail.com';
            $subject = 'Contact Request Form' . $name;
            $body = '<h2>Contact Request</h2>
                    <h4>Name</h4><p>' . $name . '</p>
                    <h4>Email</h4><p>' . $email . '</p>
                    <h4>codechef username</h4><p>' . $codechef . '</p>
                    <h4>phone</h4><p>' . $phone . '</p>
                    <h4>department</h4><p>' . $department . '</p>
                    <h4>graduation</h4><p>' . $graduation . '</p>
                    <h4>Message</h4><p>' . $message . '</p>';

            //email headers
            $headers = "MINE-version: 1.0" . "\r\n";
            $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

            //additional headers
            $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";

            if (mail($toEmail, $subject, $body, $headers)) {
                $msg = 'Email sent';
                $msgClass = 'alert-success';
            } else {
                $msg = 'Email was not sent';
                $msgClass = 'alert-danger';
            }
        }
    } else {
        //failed
        $msg = 'Please fill in all fields';
        $msgClass = 'alert-danger';
    }
}
