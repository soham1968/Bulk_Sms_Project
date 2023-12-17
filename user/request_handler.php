<?php
require_once("config.php");
session_start();

ini_set('display_errors', 0);
register_shutdown_function('handleFatalErrors');

// $mysqli = new mysqli('host', 'username', 'password', 'database');
// if ($mysqli->connect_error) {
//     $_SESSION['error'] = "Failed to connect to MySQL: " . $mysqli->connect_error;
//     header("Location: error_page.php");
//     exit;
// }

function handleFatalErrors()
{
    $error = error_get_last();
    if ($error['type'] === E_ERROR) {
        $_SESSION['showProfileError'] = "A user with same phone number or same email id already exists please try again with different number";
        header("Location: profile.php");
    }
}


// Register Page
if (isset($_REQUEST['register'])) {
    $name = $_REQUEST['name'];
    $number = $_REQUEST['phoneNumbers'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $cpassword = $_REQUEST['cpassword'];
    $active = "active";

    $isql = "SELECT * FROM `register_table` WHERE `Email` = '$email ' OR `Phone_number`='$number' ";
    $res = mysqli_query($con, $isql);

    if (mysqli_num_rows($res) == 0) {
        if ($cpassword == $password) {
            $_SESSION['user'] = $email;
            $_SESSION['loggedin'] = true;

            $password = hash('sha256', $password);

            $querry =  "INSERT INTO `register_table`( `Name`, `Phone_number`, `Email`, `Password`, `status`) VALUES ('$name','$number','$email','$password','$active')";
            $result = mysqli_query($con, $querry);

            $skv = "INSERT INTO `dashboard`( `username`, `total_msg`, `delivered`, `sent`, `rejected`, `msg_credit`, `credit_used`, `credit_left`) VALUES 
            ('$email','0','0','0','0','0','0','0')";
            $result2 = mysqli_query($con, $skv);

            header("Location: dashboard.php");
        } else {
            $_SESSION['showRegError'] = "Please enter same password...";
            header("Location: register.php");
        }
    } else {
        $_SESSION['showRegError'] = "User with same details already exists...";
        header("Location: register.php");
    }
}

// Login Page
if (isset($_REQUEST['login'])) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $password = hash('sha256', $password);
    $query = "SELECT * FROM `register_table` WHERE `Email`='$email' AND `Password`='$password'";
    $result = mysqli_query($con, $query);
    $ch4 = mysqli_fetch_array($result);


    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user'] = $email;
        $_SESSION['loggedin'] = true;

        $querry =  "INSERT INTO `user_login` (`Sl_No`, `user_name`, `Phone_number`, `Email_id`, `time`) VALUES (NULL, '$ch4[Name]', '$ch4[Phone_number]', '$ch4[Email]', current_timestamp());";
        $result = mysqli_query($con, $querry);
        header("Location: dashboard.php");
    } else {
        $_SESSION['showError'] = true;
        header("Location: index.php");
    }
}

// Update Password Page
if (isset($_REQUEST['pass_update'])) {

    $cur_pass = $_REQUEST['cur_pass'];
    $cur_pass = hash('sha256', $cur_pass);

    $new_pass = $_REQUEST['new_pass'];
    $cnew_pass = $_REQUEST['cnew_pass'];
    $username    = $_SESSION['user'];

    $msql = "SELECT * FROM `register_table` WHERE `Email` = '$username'";
    $rem = mysqli_query($con, $msql);
    $ch5 = mysqli_fetch_array($rem);
    $prev_pass = $ch5['Password'];

    if ($prev_pass == $cur_pass) {
        if ($new_pass == $cnew_pass) {
            $new_pass = hash('sha256', $new_pass);
            $mysqlm = "UPDATE `register_table` SET `Password`='$new_pass' WHERE `Email`= '$username'";
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

// Profile Page
if (isset($_REQUEST['update12'])) {
    $name        = $_REQUEST['name'];
    $mail        = $_REQUEST['mail'];
    $PhoneNumber = $_REQUEST['PhoneNumber'];
    $about       = $_REQUEST['about'];
    $username    = $_SESSION['user'];



    if ($username != $mail) {
        $querry =  "UPDATE `register_table` SET `Name`='$name',`Phone_number`='$PhoneNumber',`Email`='$mail',`about`='$about' WHERE `Email` = '$username';";
        $result = mysqli_query($con, $querry);

        if ($result) {
            $_SESSION['user'] = $mail;
            $querry0 =  "UPDATE `user_login`     SET `Email_id`='$mail' WHERE `Email_id` = '$username';";
            $result0 = mysqli_query($con, $querry0);

            $querry1 =  "UPDATE `dashboard`      SET `username`='$mail' WHERE `username` = '$username';";
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
            $_SESSION['showProfileError'] = "A user with same phone number or email id already exists please try again with different number";
            header("Location: profile.php");
        }
    } else {
        $querry =  "UPDATE `register_table` SET `Name`='$name',`Phone_number`='$PhoneNumber',`Email`='$mail',`about`='$about' WHERE `Email` = '$username';";
        $result = mysqli_query($con, $querry);

        if ($result) {
            $_SESSION['user'] = $mail;
            $querry0 =  "UPDATE `user_login`     SET `Email_id`='$mail' WHERE `Email_id` = '$username';";
            $result0 = mysqli_query($con, $querry0);

            $querry1 =  "UPDATE `dashboard`      SET `username`='$mail' WHERE `username` = '$username';";
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
            $_SESSION['showProfileError'] = "A user with same phone number or mail id already exists please try again with different number";
            header("Location: profile.php");
        }
    }


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
            $username = $_SESSION['user'];
            $querry =  "UPDATE `register_table` SET `profile_photo`='$new_file_name' WHERE `Email` = '$username';";
            $result = mysqli_query($con, $querry);
        } else {
            // Display an error message
            $_SESSION['showProfileError'] = "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
        }
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
    $username = $_SESSION['user'];

    $sql = "INSERT INTO 
    `template`(`username`, `sender_id`, `entity_id`, `template_name`, `template_body`, `template_id`, `date`) 
    VALUES ('$username','$sender_id','$entity_id','$template_name','$template_body','$uniqueNumber',current_timestamp())";
    $result = mysqli_query($con, $sql);
    header("Location: dlt.php");
    // echo $uniqueNumber;
    // echo $num;
}


// Sendername Page
if (isset($_REQUEST['sender'])) {
    $sender_name     = $_REQUEST['sender_name'];

    $uniqueId1 = uniqid();
    $entity_id = substr($uniqueId1, -6);

    $username = $_SESSION['user'];
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
    $username = $_SESSION['user'];


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
    $username       = $_SESSION['user'];


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
    $username       = $_SESSION['user'];
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
    $username       = $_SESSION['user'];

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

// Buy 1500 pack
if (isset($_GET["buy15"])) {
    $username       = $_SESSION['user'];
    $buy15          = $_GET["buy15"];
    $credit         = "1500";
    $mn = "INSERT INTO 
    `pack`( `username`, `pack`, `credit`, `expiry`, `status`) 
    VALUES ('$username ','$buy15','$credit','','pending')";
    $result15 = mysqli_query($con, $mn);
    if ($result15) {
        $_SESSION['showPrice'] = "You have sucessfully applied for basic pack";
        header("Location: price.php");
    } else {
        $_SESSION['showPriceError'] = "Your Process Couldnt be completed please try again later";
        header("Location: price.php");
    }
}

if (isset($_GET["buy20"])) {
    $username       = $_SESSION['user'];
    $buy20          = $_GET["buy20"];
    $credit         = "2000";
    $mn = "INSERT INTO 
    `pack`( `username`, `pack`, `credit`, `expiry`, `status`) 
    VALUES ('$username ','$buy20','$credit','','pending')";
    $result15 = mysqli_query($con, $mn);
    if ($result15) {
        $_SESSION['showPrice'] = "You have sucessfully applied for standard pack";
        header("Location: price.php");
    } else {
        $_SESSION['showPriceError'] = "Your Process Couldnt be completed please try again later";
        header("Location: price.php");
    }
}

if (isset($_GET["buy25"])) {
    $username       = $_SESSION['user'];
    $buy25          = $_GET["buy25"];
    $credit         = "2500";
    $mn = "INSERT INTO 
    `pack`( `username`, `pack`, `credit`, `expiry`, `status`) 
    VALUES ('$username ','$buy25','$credit','','pending')";
    $result15 = mysqli_query($con, $mn);
    if ($result15) {
        $_SESSION['showPrice'] = "You have sucessfully applied for Plus pack";
        header("Location: price.php");
    } else {
        $_SESSION['showPriceError'] = "Your Process Couldnt be completed please try again later";
        header("Location: price.php");
    }
}

if (isset($_GET["buy40"])) {
    $username       = $_SESSION['user'];
    $buy40          = $_GET["buy40"];
    $credit         = "4000";
    $mn = "INSERT INTO 
    `pack`( `username`, `pack`, `credit`, `expiry`, `status`) 
    VALUES ('$username ','$buy40','$credit','','pending')";
    $result15 = mysqli_query($con, $mn);
    if ($result15) {
        $_SESSION['showPrice'] = "You have sucessfully applied for Premium pack";
        header("Location: price.php");
    } else {
        $_SESSION['showPriceError'] = "Your Process Couldnt be completed please try again later";
        header("Location: price.php");
    }
}
