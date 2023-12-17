<?php
require("config.php");
if (isset($_REQUEST['add_members'])) {
    $group_name     = $_REQUEST['group_name'];
    $username       = $username = $_SESSION['admin'];;
    echo $username;
    echo $group_name;

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
                    echo  $names[0][$i] . " ";
                    if (!empty($email_addresses[0][$i])) {
                        echo $email_addresses[0][$i] . " ";
                    }
                    echo $phone_numbers[0][$i] . " , ";
                    // Insert the data into the table
                    $group  = $_POST['group_name'];
                    echo $group;
                    $name = $names[0][$i];
                    $email = !empty($email_addresses[0][$i]) ? $email_addresses[0][$i] : '';
                    $phone = $phone_numbers[0][$i];

                    $query123 = "SELECT * FROM `group_members` WHERE `username`='$username' AND `group_member_num`='$phone'";
                    $result21 = mysqli_query($con, $query123);

                    if ((mysqli_num_rows($result21) == 0)) {
                        $sql = "INSERT INTO members (name, email, phone) VALUES ('$name', '$email', '$phone')";
                        if (mysqli_query($con, $sql)) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                        }
                    }
                }
            }
        }
        // header("Location: addmem.php");
    }
}
