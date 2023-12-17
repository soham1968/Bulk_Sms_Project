<?php
require("config.php");

if (isset($_GET['requesten'])) {
    $requesten = $_GET['requesten'];
    // echo '<script>alert("' . $requesten . '")</script>';
    $isql = "SELECT * FROM `sender_request` WHERE `sender_name` = '$requesten'";
    $result = mysqli_query($con, $isql);
    $valuee = mysqli_fetch_array($result);
    echo $valuee['entity_id'];
}
