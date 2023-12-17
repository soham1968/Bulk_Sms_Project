<?php
require("config.php");
?>
<?php
session_start();
if (!isset($_SESSION['reset_login']) || $_SESSION['reset_login'] != true) {
    header("location: index.php");
    exit;
}
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
    <title>Forgot Password</title>
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
    <!-- calendar file css -->
    <!-- <link rel="stylesheet" href="js/semantic.min.css" /> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .disabled {
            pointer-events: none;
        }
    </style>
</head>

<body class="inner_page login">
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
                        <?php
                        if (@$_SESSION['showPassError'] == true) {
                        ?>
                            <div class="alert alert-warning alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Warning!</strong> <?php echo $_SESSION['showPassError'] ?>
                            </div>
                        <?php
                        }
                        unset($_SESSION['showPassError']);
                        ?>

                        <?php
                        if (@$_SESSION['showPass'] == true) {
                        ?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> <?php echo $_SESSION['showPass'] ?>
                            </div>
                        <?php
                        }
                        unset($_SESSION['showPass']);
                        ?>
                        <form action="forget_link.php" method="post">
                            <fieldset>
                                <div class="field">
                                    <label class="label_field">Email Address</label>
                                    <input type="text" name="email" readonly placeholder="Registerd E-mail" value="<?php echo $_SESSION['for_email'] ?>">
                                </div>
                                <div class="field">
                                    <label class="label_field">Verification Code</label>
                                    <input type="text" name="code" id="code" placeholder="Verification Code">
                                </div>
                                <div class="field">
                                    <label class="label_field">New Password</label>
                                    <input type="password" minlength="8" maxlength="15" name="password" placeholder="Password">
                                </div>
                                <div class="field">
                                    <label class="label_field">Confirm Password</label>
                                    <input type="password" name="cpassword" placeholder="Confirm Password">
                                </div>

                                <div class="field margin_0">
                                    <label class="label_field hidden">hidden label</label>
                                    <button class="main_bt" type="submit" name="reset">Reset</button>
                                </div>
                                <div class="field" style="margin-top:5rem">
                                    <a style="margin-left:2rem;" href="index.php"><i class="fa fa-long-arrow-left"></i> Back To Login</a>
                                </div>
                                <div class="field">
                                    <a style="margin-left:2rem;" id="resend" class="disabled" href="forget_link.php?resend_code=<?php echo $_SESSION['for_email'] ?>">Resend Verificartion Code</a>
                                </div>
                                <div class="field" id="timer">
                                    <p id="timeLeft" style="margin-left:2rem;color:red;font-weight:bold;">5:00</p>
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
        // console.log(Date.now());
        let times = <?php echo $_SESSION['expire']; ?>;
        let currtime = Math.floor(Date.now() / 1000);
        let timer = document.getElementById("timer");
        let timeLeft = document.getElementById("timeLeft");
        let element = document.getElementById("resend");
        let countdowntime = times - currtime;
        let count = countdowntime;
        let countdown = setInterval(function() {
            let minutes = Math.floor(count / 60);
            let seconds = count % 60;

            timeLeft.innerHTML = `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
            count--;

            if (count < 0) {
                clearInterval(countdown);
                timeLeft.innerHTML = "Time's up please resend the code!";
                code.value = "";
                code.disabled = true;
                code.readOnly = true;
                element.classList.remove("disabled");
            }
        }, 1000);
    </script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- wow animation -->
    <script src="js/animate.js"></script>
    <!-- select country -->
    <script src="js/bootstrap-select.js"></script>
    <!-- nice scrollbar -->
    <!-- <script src="js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script> -->
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>

</html>