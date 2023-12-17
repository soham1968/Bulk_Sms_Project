<?php
include("config.php");
session_start();

// Quick message Page
if (isset($_REQUEST['submit_quick'])) {
    $phoneNumbers = $_REQUEST['phoneNumbers'];
    $service      = $_REQUEST['service'];
    $sender       = $_REQUEST['sender'];
    $template     = $_REQUEST['template'];
    $language     = $_REQUEST['language'];
    $message      = $_REQUEST['message'];
    $schedule     = $_REQUEST['schedule'];
    $no_of_msg    = $_REQUEST['no_of_msg'];
    $username     = $_SESSION['admin'];;
    $msg_sec      = "Quick Message";
    $uniqueId = uniqid();
    $uniqueNumber = substr($uniqueId, -8);

    $phoneNumbersArray = explode(',', $phoneNumbers);
    $count = count($phoneNumbersArray);
    $msg_credit = $count * $no_of_msg;

    $sql = "INSERT INTO 
    `sms_details`( `username`, `msg_type`,  `template`, `language`, `msg_id`, `msg_body`, `mobile_numbers`, `sender_name`, `service`, `delivered_msg`, `rejected_msg`, `credit_used`, 
    `scheduled`, `status`)
     VALUES      ('$username','$msg_sec','$template','$language','$uniqueNumber','$message','$phoneNumbers','$sender','$service','','','$msg_credit','$schedule','pending')";
    $res = mysqli_query($con, $sql);
    // echo $sql;
    if ($res) {

        $sqlm = "UPDATE `admin_dashboard` SET `total_msg`=`total_msg`+ $msg_credit, `sent`=`sent`+ $msg_credit  WHERE  `username` = '$username'";
        $resa = mysqli_query($con, $sqlm);


        $_SESSION['showAdminQuick'] = "Your Message has been stored";
        header("Location: quick.php");
    } else {
        $_SESSION['showAdminQuickError'] = "Your Message has not been accepted please try again";
        header("Location: quick.php");
    }
}

// CSV Section Insert
if (isset($_REQUEST['submit_csv'])) {
    $phoneNumbers = $_REQUEST['phoneNumbers'];
    $services     = $_REQUEST['services'];
    $sender       = $_REQUEST['sender'];
    $template     = $_REQUEST['template'];
    $message      = $_REQUEST['message'];
    $date_time    = $_REQUEST['date_time'];
    $msg_sec      = "CSV Message";
    $language     = "en";
    $username     = $_SESSION['admin'];;
    $uniqueId     = uniqid();
    $uniqueNumber = substr($uniqueId, -8);

    $no_of_msg    = $_REQUEST['no_of_msg'];
    $phoneNumbersArray = explode(',', $phoneNumbers);
    $count = count($phoneNumbersArray);
    $msg_credit = $count * $no_of_msg;

    $sql = "INSERT INTO 
    `sms_details`( `username`, `msg_type`,  `template`, `language`, `msg_id`, `msg_body`, `mobile_numbers`, `sender_name`, `service`, `delivered_msg`, `rejected_msg`, `credit_used`, 
    `scheduled`, `status`)
     VALUES      ('$username','$msg_sec','$template','$language','$uniqueNumber','$message','$phoneNumbers','$sender','$services','','','$msg_credit','$date_time','pending')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        // echo $sql;
        $sqlm = "UPDATE `admin_dashboard` SET `total_msg`=`total_msg`+ $msg_credit, `sent`=`sent`+ $msg_credit WHERE  `username` = '$username'";
        $resa = mysqli_query($con, $sqlm);

        $_SESSION['showCsv'] = "Your Message has been stored";
        header("Location: csv.php");
    } else {
        $_SESSION['showCsvError'] = "Your Message has not been accepted please try again";
        header("Location: csv.php");
    }
}



// Group Section Insert
if (isset($_REQUEST['group_msg'])) {

    $group        = $_REQUEST['group'];
    $services     = $_REQUEST['service'];
    $sender       = $_REQUEST['sender'];
    $template     = $_REQUEST['template'];
    $phoneNumbers = $_REQUEST['PhoneNumbers'];
    $message      = $_REQUEST['message'];
    $date_time    = $_REQUEST['date_time'];
    $msg_sec      = "Group Message";
    $language     = "en";
    $username     = $_SESSION['admin'];;
    $uniqueId     = uniqid();
    $uniqueNumber = substr($uniqueId, -8);

    $no_of_msg    = $_REQUEST['no_of_msg'];
    $phoneNumbersArray = explode(',', $phoneNumbers);
    $count = count($phoneNumbersArray);
    $msg_credit = $count * $no_of_msg;


    $sql = "INSERT INTO 
    `sms_details`( `username`, `msg_type`, `group_name`, `template`, `language`, `msg_id`, `msg_body`, `mobile_numbers`, `sender_name`, `service`, `delivered_msg`, `rejected_msg`, 
    `credit_used`, 
    `scheduled`, `status`)
     VALUES      ('$username','$msg_sec','$group','$template','$language','$uniqueNumber','$message','$phoneNumbers','$sender','$services','','','$msg_credit','$date_time','pending')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $sqlm = "UPDATE `admin_dashboard` SET `total_msg`=`total_msg`+ $msg_credit , `sent`=`sent`+ $msg_credit  WHERE  `username` = '$username'";
        $resa = mysqli_query($con, $sqlm);

        $_SESSION['showGroup'] = "Your Message has been stored";
        header("Location: grmes.php");
    } else {
        $_SESSION['showGroupError'] = "Your Message has not been accepted please try again";
        header("Location: grmes.php");
    }
}

// API Key Generator 
if (isset($_REQUEST['api_key'])) {
    $sender        = $_REQUEST['sender'];
    $username      = $_SESSION['admin'];;

    $bytes = random_bytes(8);
    $hex = bin2hex($bytes);
    $api_key = substr($hex, 0, 16);


    $sqlim = "INSERT INTO `api`( `username`, `api`, `sender_name`, `status`) VALUES ('$username','$api_key','$sender','active')";
    $resultant = mysqli_query($con, $sqlim);
    if ($resultant) {
        $_SESSION['showApi'] = "API Key has been sucessfully generated";
        header("Location: api.php");
    } else {
        $_SESSION['showApiError'] = "API Key has not been generated please try again";
        header("Location: api.php");
    }






    // $query = "SELECT * FROM `group_members` WHERE `username`='$username' AND `group_member_num`='$num' AND `group_name`='$group_name' ";
    // $result21 = mysqli_query($con, $query);

    // if ((mysqli_num_rows($result21) == 0)) {
    //     $sqle = "INSERT INTO `group_members`( `username`, `group_name`,`group_member_name`, `group_member_num`, `group_member_mail`) VALUES 
    //     ('$username','$group_name','$name','$num','$mail')";

    //     $inc = 1;
    //     $sqlm = "UPDATE `group_creation` SET `no_of_members` = `no_of_members`+ $inc WHERE `group_creation`.`username` = '$username' AND `group_creation`.`group_name` = '$group_name' ";
    //     $res = mysqli_query($con, $sqlm);
    //     header("Location: addmem.php");
    // } else {
    //     $_SESSION['showGroupMemberError'] = "A member with same number already exists in the group...";
    //     header("Location: addmem.php");
    // }
}
