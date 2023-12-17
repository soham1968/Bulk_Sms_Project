<?php
$con = mysqli_connect('localhost', 'root', '', 'bulk_sms');
// Check connection
if (mysqli_connect_errno()) {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>