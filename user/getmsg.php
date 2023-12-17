<?php
require("config.php");

if (isset($_GET['requesten'])) {
    $requesten = $_GET['requesten'];
    // echo $requesten;
    $isql = "SELECT * FROM `sms_details` WHERE `msg_id` = '$requesten'";
    $result = mysqli_query($con, $isql);
    $valuee = mysqli_fetch_array($result);
    echo $valuee['mobile_numbers'];
}

if (isset($_GET['alpha'])) {
    $alpha = $_GET['alpha'];
    // echo $requesten;
    $isql = "SELECT * FROM `sms_details` WHERE `msg_id` = '$alpha'";
    $result = mysqli_query($con, $isql);
    $valuee = mysqli_fetch_array($result);
    echo $valuee['msg_body'];
}
