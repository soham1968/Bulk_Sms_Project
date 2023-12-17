<?php
require("config.php");
session_start();

if (isset($_REQUEST['update12'])) {
    $name        = $_REQUEST['name'];
    $mail        = $_REQUEST['mail'];
    $PhoneNumber = $_REQUEST['PhoneNumber'];
    $about       = $_REQUEST['about'];
    $username    = $_SESSION['user'];

    $isql = "SELECT * FROM `register_table` WHERE `Email` = '$mail' AND `Phone_number` = '$PhoneNumber' ";
    $check = mysqli_query($con, $isql);
    $var = mysqli_num_rows($check);

    echo "outside of profilephoto";
    // Check if the user selected a file
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        echo "inside of profilephoto";
        // Get the file name and extension
        $file_name = $_FILES['profile_photo']['name'];
        $file_ext = strtolower(end(explode('.', $file_name)));

        // Allow only certain file types
        $allowed_ext = array("jpg", "jpeg", "png");
        if (in_array($file_ext, $allowed_ext)) {
            echo "inside of profile";

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


    if (mysqli_num_rows($check) == 0) {
        $_SESSION['user'] = $mail;

        $querry =  "UPDATE `register_table` SET `Name`='$name',`Phone_number`='$PhoneNumber',`Email`='$mail',`about`='$about' WHERE `Email` = '$username';";
        $result = mysqli_query($con, $querry);
    } else {
        $querry =  "UPDATE `register_table` SET `Name`='$name',`about`='$about' WHERE `Email` = '$username';";
        $result = mysqli_query($con, $querry);

        $_SESSION['showProfileError'] = "Mail was not able to be updated as you have entered same details";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
</head>

<body>
    <form action="dem.php" method="post" id="">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" required class="form-control" name="name" id="name" value="<?php echo $reg['Name']; ?>" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="mail">Email:</label>
            <input type="email" required value="<?php echo $reg['Email']; ?>" class="form-control" name="mail" id="mail" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="PhoneNumber">Mobile No:</label>
            <input type="text" required value="<?php echo $reg['Phone_number']; ?>" class="form-control" maxlength="10" minlength="10" name="PhoneNumber" id="PhoneNumber" placeholder="Mobile No">
        </div>
        <div class="form-group">
            <label for="profile_photo">Profile
                Photo:</label>
            <input type="file" required accept="image/*" class="form-control" name="profile_photo" id="profile_photo">
        </div>
        <div class="form-group">
            <label for="about">About</label>
            <textarea class="form-control" required id="about" name="about" rows="3"><?php echo $reg['about']; ?></textarea>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn text-white" name="update12" style="background-color:#ff5722; padding:7px 15px 7px 15px;">Update</button>
        </div>
    </form>
</body>

</html>