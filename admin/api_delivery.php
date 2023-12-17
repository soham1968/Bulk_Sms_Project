<?php

header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata');
include("config.php");
$username = $_GET['username'];

$sql = "SELECT * FROM `admin_register` WHERE `Email` = '$username'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $api = $_GET['api'];
    $sql0 = "SELECT * FROM `api` WHERE `api`='$api' AND `username`='$username'";
    $res0 = mysqli_query($con, $sql0);

    if (mysqli_num_rows($res0) > 0) {
        $msg_id = $_GET['msg_id'];
        // echo $msg_id;

        $sqlx = "SELECT * FROM `sms_details` WHERE `msg_id` = '$msg_id'";
        $lessonQ = mysqli_query($con, $sqlx);
        if (mysqli_num_rows($lessonQ) > 0) {
            $ran = mysqli_fetch_array($lessonQ);
            $randam11 = array(
                'Sent on' => $ran['sent_on'],
                'Delivered' => $ran['delivered_msg'],
                'Rejected'  => $ran['rejected_msg']
            );
            echo json_encode($randam11);
        } else {
            $randam14 = array(
                'Message' => 'Message Id is Incorrect'
            );
            echo json_encode($randam14);
        }
    } else {
        $randam1 = array(
            'Message' => 'Api key Not found ',
            'Delivered' => 'Undelivered'
        );
        echo json_encode($randam1);
    }
} else {
    $randam2 = array(
        'Message' => 'Username not found',
        'Delivered' => 'Undelivered'
    );
    echo json_encode($randam2);
}
