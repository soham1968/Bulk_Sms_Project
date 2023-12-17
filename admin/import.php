<?php
require("config.php");
if (isset($_FILES['file']['tmp_name'])) {
    $file = $_FILES['file']['tmp_name'];
    $file_contents = file_get_contents($file);
    preg_match_all('/\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}/', $file_contents, $matches);
    $phone_numbers = array_unique($matches[0]);
    $phone_numbers = implode(',', $phone_numbers);
    echo $phone_numbers;
}
