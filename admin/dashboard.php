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

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="css/perfect-scrollbar.css" />
   <!-- color css -->
   <link rel="stylesheet" href="css/custom.css" />
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
            <?php include("rech.php") ?>
            <!-- end topbar -->
            <!-- dashboard inner -->
            <?php
            $username = $_SESSION['admin'];
            $query2 = "SELECT * FROM `admin_dashboard` where username = '$username'";
            $result2 = mysqli_query($con, $query2);
            $ch4 = mysqli_fetch_array($result2);
            $query5 = "SELECT * FROM `sms_details`";
            $result5 = mysqli_query($con, $query5);
            $sum = 0;
            while ($row = mysqli_fetch_array($result5)) {
               $sum += intval($row['credit_used']);
            }
            // sent message
            $query12 = "SELECT * FROM `sms_details`";
            $result12 = mysqli_query($con, $query12);
            $reject = 0;
            $sent = 0;
            $delivered = 0;
            $pending = 0;
            $arr = array();
            if (mysqli_num_rows($result12) > 0) {
               while ($ch12 = mysqli_fetch_array($result12)) {
                  $reject += intval($ch12['rejected_msg']);
                  $sent += intval($ch12['credit_used']);
                  $delivered += intval($ch12['delivered_msg']);
               }
            }
            $query3 = "SELECT `credit_used` FROM `sms_details` WHERE `status` = 'pending'";
            $result3 = mysqli_query($con, $query3);
            if (mysqli_num_rows($result3) > 0) {
               while ($ch0 = mysqli_fetch_array($result3)) {
                  $pending += intval($ch0['credit_used']);
               }
            }
            array_push($arr, $sent, $delivered, $reject, $pending);
            $data = json_encode($arr);
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
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-envelope-o yellow_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo @$sum; ?></p>
                                 <p class="head_couter">Message Sent by User</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <canvas id="myChart4" style="width:100%;max-width:800px"></canvas>
                     </div>
                     <div class="col-md-6">
                        <canvas id="myChart3" style="width:100%;max-width:800px"></canvas>
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
   <!-- for bar graph -->
   <script>
      var count = <?php echo $data; ?>;
      var xValues = ["msg sent", "delivered", "rejected", "pending"];
      var yValues = count;
      var barColors = ["purple", "green", "red", "yellow"];

      new Chart("myChart3", {
         type: "bar",
         data: {
            labels: xValues,
            datasets: [{
               backgroundColor: barColors,
               data: yValues
            }]
         },
         options: {
            legend: {
               display: false
            },
            title: {
               display: true,
               text: "SMS Details Track"
            }
         }
      });
   </script>
   <!-- Lined graph -->
   <script>
      var revenue = <?php echo $revenue; ?>;
      var ctx = document.getElementById("myChart4").getContext("2d");

      var data = {
         labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
         datasets: [{
            label: "Revenue",
            backgroundColor: "rgba(54, 162, 235, 0.2)",
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 2,
            data: revenue
         }]
      };

      var myLineChart = new Chart(ctx, {
         type: "line",
         data: data,
         options: {
            resetZoom: {
               display: false
            }
         }
      });
   </script>

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
      document.getElementById("dash").className += " bg-secondary";
   </script>
</body>

</html>