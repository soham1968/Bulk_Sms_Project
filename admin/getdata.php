<?php
require("config.php");

if (isset($_GET['alpha'])) {
    $alpha = $_GET['alpha'];
    // echo $requesten;
    $isql = "SELECT * FROM `register_table` WHERE `Phone_number` = '$alpha'";
    $result = mysqli_query($con, $isql);
    $valuee = mysqli_fetch_array($result);

    $data = array(
        "sl_no" => $valuee['Sl_no'],
        "name" => $valuee['Name'],
        "num" => $valuee['Phone_number'],
        "email" => $valuee['Email'],
        "about" => $valuee['about']
    );

    echo json_encode($data);
}
