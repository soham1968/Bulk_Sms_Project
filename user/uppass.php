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
   <title>Update Password</title>
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
</head>

<body class="dashboard dashboard_1">
   <div class="full_container">
      <div class="inner_container">
         <!-- Sidebar  -->
         <?php include("resources/sidebar.php") ?>
         <!-- end sidebar -->
         <!-- right content -->
         <div id="content">
            <!-- topbar -->
            <?php include("resources/topbar.php") ?>
            <!-- end topbar -->
            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Update Password</h2>
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
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <!-- invoice section -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2><i class="fa fa-key"></i> Update Password</h2>
                              </div>
                           </div>
                           <div class="padding_infor_info padding-bottom_3">
                              <form action="request_handler.php" method="post">

                                 <div class="row">
                                    <div class="col-md-4 form-group">
                                       <label for="cur_pass">Current Password</label>
                                       <input type="password" class="form-control" id="cur_pass" name="cur_pass" aria-describedby="emailHelp" placeholder="Current Password">
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-md-4 form-group">
                                       <label for="new_pass">New Password</label>
                                       <input type="password" class="form-control" maxlength="15" minlength="8" id="new_pass" name="new_pass" aria-describedby="emailHelp" placeholder="New Password">
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-md-4 form-group">
                                       <label for="cnew_pass">Confirm Password</label>
                                       <input type="password" class="form-control" id="cnew_pass" name="cnew_pass" aria-describedby="emailHelp" placeholder="Confirm Password">
                                    </div>
                                 </div>

                                 <button type="submit" class="btn text-white" name="pass_update" style="background-color:#ff5722; padding:7px 15px 7px 15px;">Update</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
               <!-- footer -->
               <div class="container-fluid">
                  <div class="footer">
                     <p>Copyright © 2023 Metaveos Consultancy
                     </p>
                  </div>
               </div>
            </div>
            <!-- end dashboard inner -->
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
   <!-- owl carousel -->
   <script src="js/owl.carousel.js"></script>
   <!-- chart js -->
   <script src="js/Chart.min.js"></script>
   <script src="js/Chart.bundle.min.js"></script>
   <script src="js/utils.js"></script>
   <script src="js/analyser.js"></script>
   <!-- nice scrollbar -->
   <script src="js/perfect-scrollbar.min.js"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
   <!-- custom js -->
   <script src="js/chart_custom_style1.js"></script>
   <script src="js/custom.js"></script>
   <script>
      document.getElementById("set").className += " bg-secondary";
   </script>
</body>

</html>