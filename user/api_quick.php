<?php

header("Access-Control-Allow-Origin: *");

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
            $num = $_GET['num'];

            $msg_sec      = "Quick Message";
            $uniqueId = uniqid();
            $msg_id = substr($uniqueId, -8);

            $num = trim($num, ',');
            $array = explode(',', $num);
            $lastelement = end($array);
            if (empty($lastelement)) {
                array_pop($array);
            }
            // Total Numbers
            $count = count($array);
            $unique_array = array_unique($array);
            $unique_count = count($unique_array);
            $valid_numbers = array();
            foreach ($unique_array as $value) {
                if (preg_match("/^[0-9]{10}$/", $value)) {
                    $valid_numbers[] = $value;
                }
            }
            $duplicate = $count - $unique_count;

            // number of perfect numbers
            $count_unique = count($valid_numbers);
            $imperfect = $duplicate + $count_unique;
            if ($imperfect != 0) {

                // echo "total count of numbers is : " . $count . " ,";
                // echo "total count of duplicate numbers is : " . $duplicate . " ,";
                // echo "total count of perfect numbers is : " . $count_unique . " ,";
                // echo "total count of imperfect numbers is : " . $count - $imperfect . " ,";

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
                // Numbers
                $val_num = implode(',', $valid_numbers);
                $msg_credit = $count_unique * $no_msg;


                // echo "The number of characters in the message is: " . $count . " , ";
                // echo "total perfect numbers are : " . $val_num  . " , ";
                // echo "max character : " . $msgcount . " , ";
                // echo "total no. of message to be sent is : " . $no_msg . " , ";
                // echo "the message is : " . $msg_body . " , ";

                $querry1 = "INSERT INTO 
                `sms_details`( `username`, `msg_type`,  `template`, `language`, `msg_id`, `msg_body`, `mobile_numbers`, `sender_name`, `service`, `delivered_msg`, `rejected_msg`, 
                `credit_used`, 
                `scheduled`, `status`)
                VALUES  ('$username','$msg_sec','$template','$targetLanguage','$msg_id','$msg_body','$val_num','$sender_name','$service','','','$msg_credit','','success')";
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
                $randam51 = array(
                    'Message' => 'Rejected, enter atleast 1 number perfectly',
                    'Delivered' => 'Undelivered'
                );
                echo json_encode($randam51);
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
