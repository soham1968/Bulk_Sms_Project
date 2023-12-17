<?php
require("config.php");
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
   <title>Sms Summary</title>
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
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" />
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
   <script src="custom-js/datatable.js"></script>
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
            <?php
            $username       = $_SESSION['user'];
            $sql = "SELECT * FROM `sms_details` WHERE `username` = '$username'";
            $lessonQ = mysqli_query($con, $sql);
            $r = mysqli_fetch_array($lessonQ);


            ?>



            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Sms Summary</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <!-- invoice section -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2><i class="fa fa-envelope"></i> Sms Summary</h2>
                              </div>
                           </div>

                           <div class="padding_infor_info padding-bottom_3 table-responsive">
                              <!-- table section -->
                              <div class="col-md-12">
                                 <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                       <div class="heading1 margin_0">

                                       </div>
                                    </div>
                                    <div class="table_section padding_infor_info">
                                       <div class="table-responsive-sm">
                                          <table class="table table-striped" id="myTable">
                                             <thead>
                                                <tr>
                                                   <th>#</th>
                                                   <th>Service</th>
                                                   <th>Delivered</th>
                                                   <th>Rejected</th>
                                                   <!-- <th>Submited</th> -->
                                                   <th>Date</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php

                                                $sql = "SELECT * FROM `sms_details` WHERE `username` = '$username'";
                                                $lessonQ = mysqli_query($con, $sql);
                                                $i = 1;
                                                while ($r = mysqli_fetch_array($lessonQ)) {
                                                ?>
                                                   <tr>
                                                      <td><?php print($i); ?></td>
                                                      <td><?php print ucwords($r['service']); ?></td>
                                                      <td><?php print ucwords($r['delivered_msg']); ?></td>
                                                      <td><?php print ucwords($r['rejected_msg']); ?></td>
                                                      <!-- <td><?php print ucwords($r['rejected_msg']); ?></td> -->
                                                      <td><?php print ucwords($r['sent_on']); ?></td>

                                                   </tr>
                                                <?php
                                                   $i++;
                                                }
                                                ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- table section -->
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
      document.getElementById("report").className += " bg-secondary";
   </script>
</body>

</html>