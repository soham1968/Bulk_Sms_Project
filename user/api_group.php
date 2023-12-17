<?php

header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata');
include("config.php");
$username = $_GET['username'];

$sql = "SELECT * FROM `register_table` WHERE `Email` = '$username'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $api = $_GET['api'];
    $sender_name = $_GET['sender_name'];
    $sql0 = "SELECT * FROM `api` WHERE `api`='$api' AND `sender_name`='$sender_name'";
    $res0 = mysqli_query($con, $sql0);

    if (mysqli_num_rows($res0) > 0) {
        $service = $_GET['service'];
        $sql1 = "SELECT * FROM `service` WHERE `service_name` = '$service'";
        $res1 = mysqli_query($con, $sql1);

        if (mysqli_num_rows($res1) > 0) {
            $group_name = $_GET['group_name'];
            // echo $group_name;
            $isql = "SELECT `group_member_num` FROM `group_members` WHERE `group_name` = '$group_name'";
            $group_num = mysqli_query($con, $isql);
            if (mysqli_num_rows($group_num) > 0) {
                $nums = array();
                while ($row = mysqli_fetch_assoc($group_num)) {
                    $nums[] = $row['group_member_num'];
                }
                $numbers = implode(",", $nums);
                $count_num = count($nums);

                $template = $_GET['template'];
                $sql2 = "SELECT * FROM `template` WHERE `template_name` = '$template'";
                $res2 = mysqli_query($con, $sql2);
                $temp = "";
                if (mysqli_num_rows($res2) > 0) {
                    $as = mysqli_fetch_array($res2);
                    $temp = $as['template_body'];
                    $msg = $_GET['msg_body'];
                    $msg_body = $temp . " " . $msg;
                } else {
                    $template = " ";
                    $msg = $_GET['msg_body'];
                    $msg_body = $msg;
                }
                $msg_sec      = "Scheduled Message";
                $uniqueId = uniqid();
                $msg_id = substr($uniqueId, -8);

                // Max Character count
                $msgcount;
                // Check for emoji
                if (preg_match('/[\x{1F600}-\x{1F64F}]/u', $msg_body)) {
                    $msgcount = 70;
                } else {
                    $msgcount = 170;
                }
                // Total CHracter count
                function count_emoji($msg_body)
                {
                    $count = 0;
                    $emoji_pattern = '/[\x{1F600}-\x{1F64F}]/u';
                    preg_match_all($emoji_pattern, $msg_body, $matches);
                    $count += count($matches[0]) * 2;
                    $count += mb_strlen($msg_body) - count($matches[0]);
                    return $count;
                }

                $count = count_emoji($msg_body);
                $inputLanguage = $_GET['input_language'];
                $targetLanguage = $_GET['target_language'];

                $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=" . $inputLanguage . "&tl=" . $targetLanguage . "&dt=t&q=" . urlencode($msg_body);
                $translatedText = json_decode(file_get_contents($url), true);

                $msg_body = $translatedText[0][0][0];
                // No of message to be sent
                $no_msg = ceil($count / $msgcount);
                $msg_credit = $count_num * $no_msg;

                $querry1 = "INSERT INTO 
                `sms_details`( `username`, `msg_type`,  `template`, `language`, `msg_id`, `msg_body`, `mobile_numbers`, `sender_name`, `service`, `delivered_msg`, `rejected_msg`, 
                `credit_used`, 
                `scheduled`, `status`)
                 VALUES      ('$username','$msg_sec','$template','$targetLanguage','$msg_id','$msg_body','$numbers','$sender_name','$service','','','$msg_credit','','success')";
                $resultant_querry = mysqli_query($con, $querry1);
                if ($resultant_querry) {
                    $sqlmn = "UPDATE `dashboard` SET `total_msg`=`total_msg`+ $msg_credit, `msg_credit`=`msg_credit` - $msg_credit,`credit_used`=`credit_used` +  
                    $msg_credit,`credit_left`=`credit_left`- $msg_credit  WHERE  `username` = '$username'";
                    $resa = mysqli_query($con, $sqlmn);

                    $randam = array(
                        'Message' => 'Success',
                        'Message-Id' => $msg_id,
                        'Credit' => $msg_credit,
                        'Delivered' => 'Sent'
                    );
                    echo json_encode($randam);
                }
            } else {
                $randam12 = array(
                    'Message' => 'Rejected, Group name is incorrect',
                    'Delivered' => 'Undelivered'
                );
                echo json_encode($randam12);
            }
        } else {
            // echo "service name is incorrect";
            $randam0 = array(
                'Message' => 'Rejected, Service name is incorrect',
                'Delivered' => 'Undelivered'
            );
            echo json_encode($randam0);
        }
    } else {
        // echo "Api key Not found or sender name is incorrect";
        $randam1 = array(
            'Message' => 'Api key Not found or sender name is incorrect',
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
