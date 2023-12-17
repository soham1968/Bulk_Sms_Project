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
   <title>Login</title>
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

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="css/bootstrap-select.css" />
   <!-- color css -->
   <link rel="stylesheet" href="css/custom.css" />
   <!-- calendar file css -->
   <!-- <link rel="stylesheet" href="js/semantic.min.css" /> -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="inner_page login">
   <?php
   if (@$_SESSION['showError'] == true) {
   ?>
      <div class="alert alert-warning alert-dismissible">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Warning!</strong> Please enter valid credentials
      </div>
   <?php
   }
   unset($_SESSION['showError']);
   ?>
   <?php
   if (@$_SESSION['showReset'] == true) {
   ?>
      <div class="alert alert-warning alert-dismissible">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Success!</strong> <?php echo $_SESSION['showReset'] ?>
      </div>
   <?php
   }
   unset($_SESSION['showReset']);
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
                  <form method="POST" action="request_handler.php">
                     <fieldset>
                        <div class="field">
                           <label class="label_field">Email Address</label>
                           <input type="email" name="email" placeholder="E-mail" />
                        </div>
                        <div class="field">
                           <label class="label_field">Password</label>
                           <input type="password" name="password" placeholder="Password" />
                        </div>
                        <div class="field">
                           <label class="label_field hidden">hidden label</label>
                           <label class="form-check-label"><input type="checkbox" class="form-check-input"> Remember Me</label>
                           <a class="forgot" href="forget.php">Forgotten Password?</a>
                        </div>
                        <div class="field margin_0">
                           <label class="label_field hidden">hidden label</label>
                           <!-- <button class="main_bt" value="submit" name="submit">Submit</button> -->
                           <!-- <a class="forgot" href="register.php">Register Now</a> -->
                           <input type="submit" name="login" value="submit" class="main_bt">
                        </div>
                     </fieldset>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- jQuery -->
   <script src="js/jquery.min.js"></script>
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