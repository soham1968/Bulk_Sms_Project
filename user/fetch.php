<?php
require("config.php");

if (isset($_GET['requesten'])) {
    $requesten = $_GET['requesten'];
    // echo $requesten;
    $isql="SELECT * FROM `template` WHERE `template_name` = '$requesten'";
    $result = mysqli_query($con, $isql);
    $valuee=mysqli_fetch_array($result);
    echo $valuee['template_body'];
}
