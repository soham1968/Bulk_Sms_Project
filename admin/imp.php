<?php
require("config.php");
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
                    echo  $email_addresses[0][$i] . " ";
                }
                if (end($found_numbers) == $phone_numbers[0][$i]) {
                    echo $phone_numbers[0][$i];
                } else {
                    echo $phone_numbers[0][$i] . ", ";
                }
            }
        }
    }
}
