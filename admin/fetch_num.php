<?php
require("config.php");

if (isset($_GET['requesten'])) {
    $requesten = $_GET['requesten'];
    $isql = "SELECT `group_member_num` FROM `group_members` WHERE `group_name` = '$requesten'";
    $result = mysqli_query($con, $isql);

    if (mysqli_num_rows($result) > 0) {
        $nums = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $nums[] = $row['group_member_num'];
        }
        echo implode(",", $nums);
    } else {
        echo "0 results";
    }
}
