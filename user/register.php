<?php
session_start();
unset($_SESSION['reset_login']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Register</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="images/fevicon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- color css -->

    <!-- select bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
</head>

<body class="inner_page login">
    <?php
    if (@$_SESSION['showRegError'] == true) {
    ?>
        <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> <?php echo $_SESSION['showRegError'] ?>
        </div>
    <?php
    }
    unset($_SESSION['showRegError']);
    ?>
    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section">
                    <div class="logo_login">
                        <div class="center">
                            <img width="210" src="images/logo/logo.png" alt="#" />
                        </div>
                    </div>

                    <div class="login_form">
                        <form method="POST" action="request_handler.php" id="formID">
                            <fieldset>
                                <div class="field">
                                    <label class="label_field">Name</label>
                                    <input type="text" name="name" placeholder="Name" />
                                </div>
                                <div class="field">
                                    <label class="label_field">Phone Number</label>
                                    <input type="text" name="phoneNumbers" placeholder="Phone Number" />
                                </div>
                                <div class="field">
                                    <label class="label_field">Email Address</label>
                                    <input type="email" name="email" placeholder="E-mail" />
                                </div>
                                <div class="field">
                                    <label class="label_field">Password</label>
                                    <input type="password" name="password" placeholder="Password" />
                                </div>
                                <div class="field">
                                    <label class="label_field">Confirm Password</label>
                                    <input type="password" name="cpassword" placeholder="Confirm Password" />
                                </div>
                                <div class="field margin_0">
                                    <label class="label_field hidden">hidden label</label>
                                    <input type="submit" name="register" value="submit" class="main_bt">
                                </div>
                                <div class="field" style="margin-top:10rem">
                                    <a style="margin-left:2rem;" href="index.php"><i class="fa fa-long-arrow-left"></i> Back To Login</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script>
        $(document).ready(function() {
            // create the validator
            var validator = $("#formID").validate({
                rules: {
                    phoneNumbers: {
                        required: true,
                        phoneNumbers: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        maxlength: 15
                    }
                },
                messages: {
                    phoneNumbers: {
                        required: "Please enter at least one phone number",
                        phoneNumbers: "Please enter valid phone numbers"
                    },
                    password: {
                        required: "Please enter a password",
                        minlength: "Password must be at least 8 characters",
                        maxlength: "Password cannot be more than 15 characters"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            // add custom validation method for phone numbers
            $.validator.addMethod("phoneNumbers", function(value, element) {
                var phoneNumbers = value.split(',');
                for (var i = 0; i < phoneNumbers.length; i++) {
                    var phoneNumber = phoneNumbers[i].trim();
                    if (!/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/.test(phoneNumber)) {
                        return false;
                    }
                }
                return true;
            }, "Please enter valid phone numbers, separated by commas");
        });
    </script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- wow animation -->
    <script src="js/animate.js"></script>
    <!-- select country -->
    <script src="js/bootstrap-select.js"></script>
    <!-- nice scrollbar -->
    <script src="js/perfect-scrollbar.min.js"></script>
    <!-- <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script> -->
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>

</html>