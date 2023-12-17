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
   <title>Dashboard</title>
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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
            <?php
            $username = $_SESSION['user'];
            $query2 = "SELECT * FROM `dashboard` where username = '$username'";
            $result2 = mysqli_query($con, $query2);
            $ch4 = mysqli_fetch_array($result2);

            // Rejected msg
            $query1 = "SELECT `rejected_msg` FROM `sms_details` where username = '$username'";
            $result1 = mysqli_query($con, $query1);
            $data = array();
            if (mysqli_num_rows($result1) > 0) {
               while ($ch1 = mysqli_fetch_array($result1)) {
                  $data[] = $ch1['rejected_msg'];
               }
            }
            $datas = json_encode($data);

            // sent message
            $query12 = "SELECT `delivered_msg` FROM `sms_details` where username = '$username'";
            $result12 = mysqli_query($con, $query12);
            $data2 = array();
            if (mysqli_num_rows($result12) > 0) {
               while ($ch12 = mysqli_fetch_array($result12)) {
                  $data2[] = $ch12['delivered_msg'];
               }
            }
            $datas2 = json_encode($data2);

            // sent message
            $query3 = "SELECT `sent_on` FROM `sms_details` where username = '$username'";
            $result3 = mysqli_query($con, $query3);
            $dat3 = array();
            if (mysqli_num_rows($result3) > 0) {
               while ($ch3 = mysqli_fetch_array($result3)) {
                  $dat3[] = $ch3['sent_on'];
               }
            }
            $data3 = json_encode($dat3);
            ?>
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Dashboard</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row column1">
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-envelope-o yellow_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo @$ch4['total_msg']; ?></p>
                                 <!-- <p class="total_no"><?php echo $datas ?></p> -->
                                 <p class="head_couter">Total Message</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-envelope blue1_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo @$ch4['delivered']; ?></p>
                                 <p class="head_couter">Delivered</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-paper-plane green_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo @$ch4['sent']; ?></p>
                                 <p class="head_couter">Sent</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-close red_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo @$ch4['rejected']; ?></p>
                                 <p class="head_couter">Rejected</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row column1">
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-money orange_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo @$ch4['msg_credit']; ?></p>
                                 <p class="head_couter">Message Credit</p>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-money green_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo @$ch4['credit_used']; ?></p>
                                 <p class="head_couter">Credit Used</p>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-money red_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo @$ch4['credit_left']; ?></p>
                                 <p class="head_couter">Credit Left</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6"><canvas id="myChart3" style="width:100%;max-width:800px"></canvas></div>
                     <div class="col-md-6"><canvas id="myChart4" style="width:100%;max-width:800px"></canvas></div>
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
   <!-- for lined graph -->
   <script>
      var ctx = document.getElementById("myChart3").getContext("2d");
      var array = <?php echo $datas; ?>;
      var array2 = <?php echo $datas2; ?>;
      var array3 = <?php echo $data3; ?>;
      var data = {
         labels: array3,
         datasets: [{
               label: "Rejected",
               backgroundColor: "rgba(255, 99, 132, 0.2)",
               borderColor: "rgba(255, 99, 132, 1)",
               borderWidth: 2,
               data: array
            },
            {
               label: "Delivered",
               backgroundColor: "rgba(54, 162, 235, 0.2)",
               borderColor: "rgba(54, 162, 235, 1)",
               borderWidth: 2,
               data: array2
            }

         ]
      };

      var myLineChart = new Chart(ctx, {
         type: "line",
         data: data,
         options: {
            title: {
               display: true,
               text: "SMS Status Graph"
            }
         }
      });
   </script>
   <!-- circular graph -->
   <script>
      var bal = <?php echo $ch4['msg_credit']; ?>;
      var used = <?php echo $ch4['credit_used']; ?>;
      var left = <?php echo $ch4['credit_left']; ?>;
      var xValues = ["Balance", "Credit Used", "Credit Left"];
      var yValues = [bal, used, left];
      var barColors = [
         "purple",
         "pink",
         "violet",
      ];

      new Chart("myChart4", {
         type: "pie",
         data: {
            labels: xValues,
            datasets: [{
               backgroundColor: barColors,
               data: yValues
            }]
         },
         options: {
            title: {
               display: true,
               text: "SMS Recharge Graph"
            }
         }
      });
   </script>
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
      document.getElementById("dash").className += " bg-secondary";
   </script>
</body>

</html>