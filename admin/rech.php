<?php
$jan_rech = 0;
$rev = array();
$jan = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 1;";
$jan_res = mysqli_query($con, $jan);
if (mysqli_num_rows($jan_res) > 0) {
    while ($ch1 = mysqli_fetch_array($jan_res)) {
        $jan_rech += $ch1['topup'];
    }
}

$feb_rech = 0;
$feb = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 2;";
$feb_res = mysqli_query($con, $feb);
if (mysqli_num_rows($feb_res) > 0) {
    while ($ch01 = mysqli_fetch_array($feb_res)) {
        $feb_rech += $ch01['topup'];
    }
}

$mar_rech = 0;
$mar = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 3;";
$mar_res = mysqli_query($con, $mar);
if (mysqli_num_rows($mar_res) > 0) {
    while ($ch02 = mysqli_fetch_array($mar_res)) {
        $mar_rech += $ch02['topup'];
    }
}

$apr_rech = 0;
$apr = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 4;";
$apr_res = mysqli_query($con, $apr);
if (mysqli_num_rows($apr_res) > 0) {
    while ($ch03 = mysqli_fetch_array($apr_res)) {
        $apr_rech += $ch03['topup'];
    }
}

$may_rech = 0;
$may = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 5;";
$may_res = mysqli_query($con, $may);
if (mysqli_num_rows($may_res) > 0) {
    while ($ch04 = mysqli_fetch_array($may_res)) {
        $may_rech += $ch04['topup'];
    }
}

$jun_rech = 0;
$jun = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 6;";
$jun_res = mysqli_query($con, $jun);
if (mysqli_num_rows($jun_res) > 0) {
    while ($ch05 = mysqli_fetch_array($jun_res)) {
        $jun_rech += $ch05['topup'];
    }
}

$jul_rech = 0;
$jul = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 7;";
$jul_res = mysqli_query($con, $jul);
if (mysqli_num_rows($jul_res) > 0) {
    while ($ch06 = mysqli_fetch_array($jul_res)) {
        $jul_rech += $ch06['topup'];
    }
}

$aug_rech = 0;
$aug = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 8;";
$aug_res = mysqli_query($con, $aug);
if (mysqli_num_rows($aug_res) > 0) {
    while ($ch07 = mysqli_fetch_array($aug_res)) {
        $aug_rech += $ch07['topup'];
    }
}

$sep_rech = 0;
$sep = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 9;";
$sep_res = mysqli_query($con, $sep);
if (mysqli_num_rows($sep_res) > 0) {
    while ($ch08 = mysqli_fetch_array($sep_res)) {
        $sep_rech += $ch08['topup'];
    }
}

$oct_rech = 0;
$oct = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 10;";
$oct_res = mysqli_query($con, $oct);
if (mysqli_num_rows($oct_res) > 0) {
    while ($ch09 = mysqli_fetch_array($oct_res)) {
        $oct_rech += $ch09['topup'];
    }
}

$nov_rech = 0;
$nov = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 11;";
$nov_res = mysqli_query($con, $nov);
if (mysqli_num_rows($nov_res) > 0) {
    while ($ch10 = mysqli_fetch_array($nov_res)) {
        $nov_rech += $ch10['topup'];
    }
}

$dec_rech = 0;
$dec = "SELECT * FROM `recharge_log` WHERE EXTRACT(MONTH FROM trans_time) = 12;";
$dec_res = mysqli_query($con, $dec);
if (mysqli_num_rows($dec_res) > 0) {
    while ($ch11 = mysqli_fetch_array($dec_res)) {
        $dec_rech += $ch11['topup'];
    }
}
array_push($rev, $jan_rech, $feb_rech, $mar_rech, $apr_rech, $may_rech, $jun_rech, $jul_rech, $aug_rech, $sep_rech, $oct_rech, $nov_rech, $dec_rech);
$revenue = json_encode($rev);
