<?php
ob_start();
include("config.php");
session_start();

?>


<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
if (isset($_REQUEST['forget'])) {
    $rec = $_REQUEST['email'];
    $sql = "SELECT `Email` FROM `register_table` WHERE `Email` = '$rec' ";
    $res = mysqli_query($con, $sql);
    if ((mysqli_num_rows($res) == 1)) {

        $mail = new PHPMailer(true);
        // Generate a random string with 8 characters
        $randString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
        // Store the generated string in a session variable
        $_SESSION['rand_string'] = $randString;
        // Set the expiration time of the session variable to 10 seconds
        $expiration = time() + 300;
        $_SESSION['expire'] = $expiration;

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sohambehera33@gmail.com';
            $mail->Password = 'cslsvjvbutepoyut';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('sohambehera33@gmail.com');
            $mail->addAddress($rec);
            $mail->isHTML(true);
            $mail->Subject = "Password Change";
            $mail->Body = "Your code to change password is : " . $_SESSION['rand_string'];

            $mail->send();
            // echo "<script>alert('Sent Successfully');document.location.href = 'index.php';</script>";
            $_SESSION['for_email'] = $rec;
            $_SESSION['reset_login'] = true;
            $_SESSION['showPass'] = "Verification Code has been sent to you mail id";
            header("Location: reset.php");
        } catch (Exception $e) {
            // echo "<script>alert('Message could not be sent. Error: {$mail->ErrorInfo}');document.location.href = 'index.php';</script>";
            $_SESSION['showPassError'] = "Verification Code has not been sent to you mail id";
            header("Location: forget.php");
        }
    } else {
        $_SESSION['showPassError'] = "Username doesnot exist";
        header("Location: forget.php");
    }
}

if (isset($_REQUEST['reset'])) {
    $mail      = $_REQUEST['email'];
    $password  = $_REQUEST['password'];
    $cpassword = $_REQUEST['cpassword'];
    $code      = $_REQUEST['code'];
    $match = "";
    if (time() > $_SESSION['expire']) {
        unset($_SESSION['rand_string']);
    }
    if ($code == $_SESSION['rand_string']) {
        if ($password == $cpassword) {
            $password = hash('sha256', $password);
            $querry = "UPDATE `register_table` SET `Password`='$password' WHERE `Email` = '$mail'";
            $resultant_querry = mysqli_query($con, $querry);
            if ($resultant_querry) {
                unset($_SESSION['reset_login']);
                $_SESSION['showReset'] = "Your password has been updated";
                header("Location: index.php");
            } else {
                unset($_SESSION['reset_login']);
                $_SESSION['showPassError'] = "Your Password has not been updated please try again";
                header("Location: forget.php");
            }
        } else {
            $_SESSION['showPassError'] = "Please enter same password";
            header("Location: reset.php");
        }
    } else {
        $_SESSION['showPassError'] = "Please check verification code or code has been expired";
        header("Location: reset.php");
    }
}

if (isset($_REQUEST['resend_code'])) {
    $rec = $_GET["resend_code"];
    // Generate a random string with 8 characters
    $randString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
    // Store the generated string in a session variable
    $_SESSION['rand_string'] = $randString;
    // Set the expiration time of the session variable to 10 seconds
    $expiration = time() + 300;
    $_SESSION['expire'] = $expiration;

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sohambehera33@gmail.com';
        $mail->Password = 'cslsvjvbutepoyut';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('sohambehera33@gmail.com');
        $mail->addAddress($rec);
        $mail->isHTML(true);
        $mail->Subject = "Password Change";
        $mail->Body = "Your code to change password is : " . $_SESSION['rand_string'];

        $mail->send();
        // echo "<script>alert('Sent Successfully');document.location.href = 'index.php';</script>";
        $_SESSION['for_email'] = $rec;
        $_SESSION['reset_login'] = true;
        $_SESSION['showPass'] = "Verification Code has been sent to you mail id";
        header("Location: reset.php");
    } catch (Exception $e) {
        // echo "<script>alert('Message could not be sent. Error: {$mail->ErrorInfo}');document.location.href = 'index.php';</script>";
        $_SESSION['showPassError'] = "Verification Code has not been sent to you mail id please try again";
        header("Location: reset.php");
    }
}
?>
