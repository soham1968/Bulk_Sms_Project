<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\phpmailer\src\Exception.php';
require 'C:\xampp\htdocs\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\phpmailer\src\SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sohambehera33@gmail.com';
    $mail->Password = 'Meow@143';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('sohambehera33@gmail.com', 'Soham Behera');
    $mail->addAddress('sangramkesharibarik88@gmail.com', 'Sangram Keshari Barik');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email from Localhost using Gmail SMTP';
    $mail->Body    = 'This is a test email sent from localhost using PHP and Gmail SMTP.';
    $mail->AltBody = 'This is a plain text email body.';

    $mail->send();
    echo 'Email sent successfully.';
} catch (Exception $e) {
    echo 'Failed to send email: ' . $mail->ErrorInfo;
}

?>
