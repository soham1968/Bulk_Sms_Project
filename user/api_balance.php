<?php

header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata');
include("config.php");
$username = $_GET['username'];

$sql = "SELECT * FROM `register_table` WHERE `Email` = '$username'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $api = $_GET['api'];
    $sql0 = "SELECT * FROM `api` WHERE `api`='$api' AND `username`='$username'";
    $res0 = mysqli_query($con, $sql0);

    if (mysqli_num_rows($res0) > 0) {
        $query2 = "SELECT * FROM `dashboard` where username = '$username'";
        $result2 = mysqli_query($con, $query2);
        $ch4 = mysqli_fetch_array($result2);
        // echo $ch4['credit_left'];
        $randam1 = array(
            'Credit-left' => $ch4['credit_left']
        );
        echo json_encode($randam1);
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
