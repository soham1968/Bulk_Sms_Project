<?php
require_once("config.php");
session_start();


// Login Page
if (isset($_REQUEST['login'])) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    // $password = hash('sha256', $password);
    $query = "SELECT * FROM `admin_register` WHERE `Email`='$email' AND `password`='$password'";
    $result = mysqli_query($con, $query);
    $ch4 = mysqli_fetch_array($result);
    echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin'] = $email;
        $_SESSION['login'] = true;
        header("Location: dashboard.php");
    } else {
        $_SESSION['showError'] = true;
        header("Location: index.php");
    }
}

// Sendername Page
if (isset($_REQUEST['sender'])) {
    $sender_name     = $_REQUEST['sender_name'];

    $uniqueId1 = uniqid();
    $entity_id = substr($uniqueId1, -6);

    $username = $_SESSION['admin'];
    $sender_name = strtoupper($sender_name);

    $isql = "SELECT * FROM `sender_request` WHERE `sender_name` = '$sender_name ' AND `username`='$username' ";
    $res = mysqli_query($con, $isql);

    $check_send = "SELECT * FROM `sender_request` WHERE `sender_name` = '$sender_name'";
    $result_send_check = mysqli_query($con, $check_send);

    if (mysqli_num_rows($result_send_check) == 0) {
        if (strlen($sender_name) == 6) {
            if (mysqli_num_rows($res) == 0) {

                $sql = "INSERT INTO 
            `sender_request`(`username`, `sender_name`, `entity_id`,`approve_date`, `status`) 
            VALUES ('$username','$sender_name ','$entity_id ','N/A','pending')";

                $result = mysqli_query($con, $sql);
                header("Location: sendername.php");
            } else {
                $_SESSION['showSenderError'] = "Sender name already exists...";
                header("Location: sendername.php");
            }
        } else {
            $_SESSION['showSenderError'] = "please enter sender name of 6 characters...";
            header("Location: sendername.php");
        }
    } else {
        $_SESSION['showSenderError'] = "Sender Name Already Exists..Please Try Again With Different Sender Name";
        header("Location: sendername.php");
    }
}

// Template Page
if (isset($_REQUEST['temp'])) {
    $sender_id     = $_REQUEST['sender_name'];
    $entity_id     = $_REQUEST['entity_id'];
    $template_name = $_REQUEST['template_name'];
    $template_body = $_REQUEST['template_body'];
    // $num = substr(uniqid(), 0, 6);
    $uniqueId = uniqid();
    $uniqueNumber = substr($uniqueId, -6);
    $username = $_SESSION['admin'];

    $sql = "INSERT INTO 
    `template`(`username`, `sender_id`, `entity_id`, `template_name`, `template_body`, `template_id`, `date`) 
    VALUES ('$username','$sender_id','$entity_id','$template_name','$template_body','$uniqueNumber',current_timestamp())";
    $result = mysqli_query($con, $sql);
    header("Location: dlt.php");
    // echo $uniqueNumber;
    // echo $num;
}


// Sender Request
if (isset($_REQUEST['accept'])) {

    $entity = $_GET["accept"];
    $username = $_GET["username"];
    // echo $entity . $username;

    $query = "UPDATE `sender_request` SET `approve_date`=NOW(),`status`='active' WHERE `username` = '$username' AND `entity_id` = '$entity'";
    echo $query;
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Location: sender_request.php");
    } else {
        $_SESSION['showSendError'] = "Could Not be accepted please try again later";
    }
}
if (isset($_REQUEST['reject'])) {

    $entity = $_GET["reject"];
    $username = $_GET["username"];
    // echo $entity . $username;

    $query = "UPDATE `sender_request` SET `approve_date`=NOW(),`status`='Rejected' WHERE `username` = '$username' AND `entity_id` = '$entity'";
    echo $query;
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Location: sender_request.php");
    } else {
        $_SESSION['showSendError'] = "Could Not be accepted please try again later";
    }
}


// Pack Request
if (isset($_REQUEST['acceptPack'])) {
    // echo "eNTERED";
    $pack = $_GET["acceptPack"];
    $username = $_GET["username"];
    $uniqueId = uniqid();
    $rech_id = substr($uniqueId, -6);

    $re = "SELECT * FROM `register_table` WHERE `Email` = '$username'";
    $result25 = mysqli_query($con, $re);
    // echo $re;

    $re8 = "SELECT * FROM `recharge_log` WHERE `username` = '$username' ORDER BY `Sl_no` DESC";
    $result258 = mysqli_query($con, $re8);
    // echo $re8;


    if (mysqli_num_rows($result258) > 0) {
        $re_res8 = mysqli_fetch_array($result258);
        $perv = $re_res8['topup'];
    } else {
        $perv = "N/A";
    }
    // echo $perv;
    // echo $re_res8['topup'];


    if ($result25) {

        $re_res = mysqli_fetch_array($result25);
        $num = $re_res['Phone_number'];
        $query = "UPDATE `pack` SET `expiry`=DATE_ADD(NOW(),INTERVAL 30 DAY),`status`='active' WHERE `username` = '$username' AND `pack` = '$pack'";
        $result = mysqli_query($con, $query);

        $dash = "UPDATE `dashboard` SET `msg_credit`=`msg_credit` + $pack,`credit_left`=`credit_left` + $pack WHERE `username`= '$username'";
        $result2 = mysqli_query($con, $dash);

        // $rech = "UPDATE `recharge_log` SET `old_credit`=`topup` ,`topup`='$pack' , `trans_time` = NOW(), `validity` = DATE_ADD(NOW(),INTERVAL 30 DAY)  WHERE `username`= '$username'";
        // $res_rech = mysqli_query($con, $rech);

        $skv3 = "INSERT INTO 
        `recharge_log`( `username`, `recharge_id`, `mobile_no`, `old_credit`, `topup`, `validity`, `trans_time`, `service`, `trans_type`) 
        VALUES           ('$username','$rech_id','$num','$perv','$pack', DATE_ADD(NOW(),INTERVAL 30 DAY) ,NOW(),'N/A','UPI')";
        $result23 = mysqli_query($con, $skv3);

        if ($result && $result2 && $result23) {
            header("Location: pack_request.php");
        } else {
            $_SESSION['showPackError'] = "Could Not be accepted please try again later";
        }
    }
}
if (isset($_REQUEST['rejectPack'])) {

    $pack = $_GET["rejectPack"];
    $username = $_GET["username"];

    $query = "UPDATE `pack` SET `expiry`='',`status`='Rejected' WHERE `username` = '$username' AND `pack` = '$pack'";
    echo $query;
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Location: pack_request.php");
    } else {
        $_SESSION['showPackError'] = "Could Not be accepted please try again later";
    }
}

// User Update
if (isset($_REQUEST['user_update'])) {
    $sl_no        = $_REQUEST['sl_no'];
    $name        = $_REQUEST['name'];
    $mail        = $_REQUEST['mail'];
    $PhoneNumber = $_REQUEST['PhoneNumber'];
    $Password    = $_REQUEST['Password'];
    $about       = $_REQUEST['about'];
    if ($Password != " ") {
        $Password = hash('sha256', $Password);
        $query = "UPDATE `register_table` SET `Name`='$name',`Phone_number`='$PhoneNumber',`Email`='$mail',`Password`='$Password',`about`='$about' WHERE `Sl_no`='$sl_no'";
        $result = mysqli_query($con, $query);
        if ($result) {
            header("Location: user_update.php");
        } else {
            $_SESSION['showUserError'] = "Could Not be updated please try again later";
        }
    } else {
        $query = "UPDATE `register_table` SET `Name`='$name',`Phone_number`='$PhoneNumber',`Email`='$mail',`about`='$about' WHERE `Sl_no`='$sl_no'";
        $result = mysqli_query($con, $query);
        if ($result) {
            header("Location: user_update.php");
        } else {
            $_SESSION['showUserError'] = "Could Not be updated please try again later";
        }
    }
}


// Delete Update
if (isset($_REQUEST['delete_user'])) {
    $PhoneNumber  = $_REQUEST['delete_user'];

    $query = "DELETE FROM `register_table` WHERE `Phone_number` = '$PhoneNumber'";
    echo $query;
    $result = mysqli_query($con, $query);
    header("Location: user_update.php");
}



// file extraction of quick message page
if (isset($_REQUEST['extract'])) {
    $file = $_FILES['file']['tmp_name'];

    // check if file is a csv or xls/xlsx file
    $file_ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if ($file_ext == 'csv' || $file_ext == 'xls' || $file_ext == 'xlsx') {
        // read file
        $a = 0;
        if ($file_ext == 'csv') {
            $handle = fopen($file, 'r');
            $headers = fgetcsv($handle); // Skip first row, which contain column names
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $_phonenumbers[] = $data[0];
                ++$a;
            }
            fclose($handle);
            header("Location: quick.php");
        } else {
            echo "exit";
            header("Location: quick.php");
            // read xls/xlsx file
            // use appropriate library for reading xls/xlsx files
        }
    } else {
        header("Location: quick.php");
        echo 'Invalid file type. Please select a CSV or Excel file.';
    }
}

// Group Creation Page
if (isset($_REQUEST['create_group'])) {
    $group_name     = $_REQUEST['group_name'];
    $username = $_SESSION['admin'];


    $query = "SELECT * FROM `group_creation` WHERE `username`='$username' AND `group_name`='$group_name'";
    $result21 = mysqli_query($con, $query);


    if ((mysqli_num_rows($result21) == 0) && (strlen($group_name) > 0)) {
        $sqle = "INSERT INTO `group_creation`( `username`, `group_name`) VALUES ('$username','$group_name')";
        $resu = mysqli_query($con, $sqle);
        header("Location: mgp.php");
    } else {
        $_SESSION['showGroupError'] = "check group name properly or it already exists";
        header("Location: mgp.php");
    }
}

// Add Member Page
if (isset($_REQUEST['addmem'])) {
    $group_name     = $_REQUEST['group_name'];
    $name           = $_REQUEST['name'];
    $num            = $_REQUEST['phoneNumbers'];
    $mail           = $_REQUEST['mail'];
    $username       = $_SESSION['admin'];


    $query = "SELECT * FROM `group_members` WHERE `username`='$username' AND `group_member_num`='$num' AND `group_name`='$group_name' ";
    $result21 = mysqli_query($con, $query);

    if ((mysqli_num_rows($result21) == 0)) {
        $sqle = "INSERT INTO `group_members`( `username`, `group_name`,`group_member_name`, `group_member_num`, `group_member_mail`) VALUES ('$username','$group_name','$name','$num','$mail')";
        $resu = mysqli_query($con, $sqle);

        $inc = 1;
        $sqlm = "UPDATE `group_creation` SET `no_of_members` = `no_of_members`+ $inc WHERE `group_creation`.`username` = '$username' AND `group_creation`.`group_name` = '$group_name' ";
        $res = mysqli_query($con, $sqlm);
        header("Location: addmem.php");
    } else {
        $_SESSION['showGroupMemberError'] = "A member with same number already exists in the group...";
        header("Location: addmem.php");
    }
}

// Delete  Group Member
if (isset($_GET["deletee"])) {
    $username       = $_SESSION['admin'];
    $group_member_num = $_GET["deletee"];
    $group_name = $_GET["group_name"];
    $sqli = "DELETE FROM `group_members` WHERE `group_member_num`  = '$group_member_num' AND `group_name` = '$group_name'";
    $results = mysqli_query($con, $sqli);

    $inc = 1;
    $sqlm = "UPDATE `group_creation` SET `no_of_members` = `no_of_members` - $inc WHERE `group_creation`.`username` = '$username' AND `group_creation`.`group_name` = '$group_name' ";
    $result = mysqli_query($con, $sqlm);
    header("Location: addmem.php");
}

// Addmember page group using csv
if (isset($_REQUEST['add_members'])) {
    $group_name     = $_REQUEST['group_name'];
    $username       = $_SESSION['admin'];

    $found_numbers = array();

    if (isset($_FILES['file']['tmp_name'])) {
        $file = $_FILES['file']['tmp_name'];
        $file_contents = file_get_contents($file);
        $lines = explode("\n", $file_contents);
        foreach ($lines as $line) {
            preg_match_all('/\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}/', $line, $phone_numbers);
            preg_match_all('/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})/', $line, $email_addresses);
            preg_match_all('/([A-Za-z]+\s[A-Za-z]+)/', $line, $names);
            $i = 0;
            if (!empty($names[0][$i]) && !empty($phone_numbers[0][$i]) && preg_match("/^[a-zA-Z ]*$/", $names[0][$i]) && preg_match("/^[0-9]{3}[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/", $phone_numbers[0][$i])) {
                if (!in_array($phone_numbers[0][$i], $found_numbers)) {
                    array_push($found_numbers, $phone_numbers[0][$i]);
                    // Insert the data into the table
                    $name = $names[0][$i];
                    $email = !empty($email_addresses[0][$i]) ? $email_addresses[0][$i] : '';
                    $phone = $phone_numbers[0][$i];

                    // Check any number is already in the group or not
                    $query123 = "SELECT * FROM `group_members` WHERE `username`='$username' AND `group_member_num`='$phone' AND `group_name`= '$group_name'";
                    $result21 = mysqli_query($con, $query123);

                    if ((mysqli_num_rows($result21) == 0)) {
                        $sql15 = "INSERT INTO 
                        `group_members`(`username`, `group_name`, `group_member_name`, `group_member_num`, `group_member_mail`) 
                                VALUES ('$username','$group_name','$name','$phone','$email')";
                        $resa = mysqli_query($con, $sql15);

                        if ($resa) {
                            $inc = 1;
                            $sqlm = "UPDATE `group_creation` SET `no_of_members` = `no_of_members`+ $inc WHERE `group_creation`.`username` = '$username' AND `group_creation`.`group_name` = '$group_name' ";
                            $res = mysqli_query($con, $sqlm);
                            header("Location: addmem.php");
                        }
                    } else {
                        $_SESSION['showGroupMemberError'] = "A member with same number already exists in the group...";
                        header("Location: addmem.php");
                    }
                }
            }
        }
    }
}


// Profile Page
if (isset($_REQUEST['update12'])) {
    $name        = $_REQUEST['name'];
    $mail        = $_REQUEST['mail'];
    $PhoneNumber = $_REQUEST['PhoneNumber'];
    $username    = $_SESSION['admin'];

    $isql = "SELECT * FROM `admin_register` WHERE `Email` = '$mail' AND `Phone_number` = '$PhoneNumber' ";
    $check = mysqli_query($con, $isql);
    $var = mysqli_num_rows($check);

    // Check if the user selected a file
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        // Get the file name and extension
        $file_name = $_FILES['profile_photo']['name'];
        $file_ext_array = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext_array));


        // Allow only certain file types
        $allowed_ext = array("jpg", "jpeg", "png");
        if (in_array($file_ext, $allowed_ext)) {

            // Generate a new file name and upload the file
            $new_file_name = uniqid() . "." . $file_ext;
            move_uploaded_file($_FILES['profile_photo']['tmp_name'], "uploads/profile_photos/" . $new_file_name);
            echo "moved";

            // Update the profile photo in the database
            $username = $_SESSION['admin'];
            $querry =  "UPDATE `admin_register` SET `profile_photo`='$new_file_name' WHERE `Email` = '$username';";
            $result = mysqli_query($con, $querry);
        } else {
            // Display an error message
            $_SESSION['showProfileError'] = "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
        }
    }


    if (mysqli_num_rows($check) == 0) {
        $_SESSION['user'] = $mail;

        $querry =  "UPDATE `admin_register` SET `Name`='$name',`Phone_number`='$PhoneNumber',`Email`='$mail' WHERE `Email` = '$username';";
        $result = mysqli_query($con, $querry);

        $querry1 =  "UPDATE `admin_dashboard`      SET `username`='$mail' WHERE `username` = '$username';";
        $result1 = mysqli_query($con, $querry1);

        $querry2 =  "UPDATE `group_creation` SET `username`='$mail' WHERE `username` = '$username';";
        $result2 = mysqli_query($con, $querry2);

        $querry3 =  "UPDATE `group_members`  SET `username`='$mail' WHERE `username` = '$username';";
        $result3 = mysqli_query($con, $querry3);

        $querry4 =  "UPDATE `sender_request` SET `username`='$mail' WHERE `username` = '$username';";
        $result4 = mysqli_query($con, $querry4);

        $querry5 =  "UPDATE `template`       SET `username`='$mail' WHERE `username` = '$username';";
        $result5 = mysqli_query($con, $querry5);
        header("Location: profile.php");
    } else {
        $querry =  "UPDATE `register_table` SET `Name`='$name',`about`='$about' WHERE `Email` = '$username';";
        $result = mysqli_query($con, $querry);

        $_SESSION['showProfileError'] = "Some Details was not able to be updated as you have entered same details";
        header("Location: profile.php");
    }
}

// Update Password Page
if (isset($_REQUEST['pass_update'])) {

    $cur_pass = $_REQUEST['cur_pass'];

    $new_pass = $_REQUEST['new_pass'];
    $cnew_pass = $_REQUEST['cnew_pass'];
    $username    = $_SESSION['admin'];

    $msql = "SELECT * FROM `admin_register` WHERE `Email` = '$username'";
    $rem = mysqli_query($con, $msql);
    $ch5 = mysqli_fetch_array($rem);
    $prev_pass = $ch5['Password'];

    if ($prev_pass == $cur_pass) {
        if ($new_pass == $cnew_pass) {
            $mysqlm = "UPDATE `admin_register` SET `Password`='$new_pass' WHERE `Email`= '$username'";
            $resal = mysqli_query($con, $mysqlm);

            $_SESSION['showPass'] = "Your Password has been updated sucessfully";
            header("Location: uppass.php");
        } else {
            $_SESSION['showPassError'] = "Please enter same new passwords...";
            header("Location: uppass.php");
        }
    } else {
        $_SESSION['showPassError'] = "Please enter your previous password corrrectly";
        header("Location: uppass.php");
    }
}
