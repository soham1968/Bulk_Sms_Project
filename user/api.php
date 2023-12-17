<?php
include("config.php");
?>
<?php
if (isset($_GET['delete'])) {
   $sql = "DELETE FROM `api` WHERE `api`='" . $_GET['delete'] . "'";
   $result = mysqli_query($con, $sql);
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
   <title>API</title>
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
                           <h2>API</h2>
                        </div>
                     </div>

                  </div>
                  <div class="row">
                     <!-- invoice section -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2><i class="fa fa-users"></i> Create API</h2>
                                 <?php
                                 if (@$_SESSION['showApiError'] == true) {
                                 ?>
                                    <div class="alert alert-warning alert-dismissible">
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                       <strong>Warning!</strong> <?php echo $_SESSION['showApiError'] ?>
                                    </div>
                                 <?php
                                 }
                                 unset($_SESSION['showApiError']);
                                 ?>

                                 <?php
                                 if (@$_SESSION['showApi'] == true) {
                                 ?>
                                    <div class="alert alert-success alert-dismissible">
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                       <strong>Success!</strong> <?php echo $_SESSION['showApi'] ?>
                                    </div>
                                 <?php
                                 }
                                 unset($_SESSION['showApi']);
                                 ?>
                              </div>
                           </div>
                           <div class="padding_infor_info padding-bottom_3">
                              <button class="btn text-white" style="background-color:#ff5722; padding:7px 15px 7px 15px;" data-toggle="modal" data-target="#myModal">Create API Key</button>
                           </div>

                           <!-- The Modal -->
                           <div class="modal" id="myModal">
                              <div class="modal-dialog">
                                 <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                       <h4 class="modal-title">API Key Genarator</h4>
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <form action="submit.php" method="post">
                                       <div class="modal-body">
                                          <div class="form-group">
                                             <label for="exampleFormControlSelect1">Sender</label>
                                             <select class="form-control" required id="sender" name="sender">
                                                <option value="" disabled selected>Select Sender</option>
                                                <?php
                                                $username = $_SESSION['user'];
                                                $sqli = "SELECT sender_name FROM sender_request WHERE `status` = 'active' AND `username` = '$username' ";
                                                $result = mysqli_query($con, $sqli);
                                                while ($row = mysqli_fetch_array($result)) {
                                                   echo "<option value='" . $row['sender_name'] . "'>" . $row['sender_name'] . "</option>";
                                                }
                                                ?>
                                             </select>
                                          </div>
                                       </div>

                                       <!-- Modal footer -->
                                       <div class="modal-footer">
                                          <button type="submit" name="api_key" class="btn text-white" style="background-color:#ff5722; padding:7px 15px 7px 15px;">Create</button>
                                       </div>

                                    </form>
                                 </div>
                              </div>
                           </div>

                           <div class="padding_infor_info padding-bottom_3 table-responsive">
                              <!-- table section -->
                              <div class="col-md-12">
                                 <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                       <div class="heading1 margin_0">
                                          <h2>API Keys</h2>
                                       </div>
                                    </div>
                                    <div class="table_section padding_infor_info">
                                       <div class="table-responsive-sm">
                                          <table class="table table-striped">
                                             <thead>
                                                <tr>
                                                   <th>#</th>
                                                   <th>API Key</th>
                                                   <th>Sender Name</th>
                                                   <th>Created On</th>
                                                   <th>Status</th>
                                                   <th>Delete</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php
                                                $username       = $_SESSION['user'];
                                                $sql = "SELECT * FROM `api` WHERE `username` = '$username'";
                                                $lessonQ = mysqli_query($con, $sql);
                                                $i = 1;
                                                while ($r = mysqli_fetch_array($lessonQ)) {
                                                ?>
                                                   <tr>
                                                      <td><?php print($i); ?></td>
                                                      <td><?php print ucwords($r['api']); ?></td>
                                                      <td><?php print ucwords($r['sender_name']); ?></td>
                                                      <td><?php print ucwords($r['creation']); ?></td>
                                                      <td><?php print ucwords($r['status']); ?></td>
                                                      <td><a class="btn btn-danger" href="api.php?delete=<?php echo $r['api']; ?>" onClick="return confirm('Are you sure to delete this record?')">Delete</a></td>
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

                           <div class="padding_infor_info padding-bottom_3 table-responsive">
                              <div class="col-md-12">
                                 <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                       <div class="heading1 margin_0">
                                          <h2>Single/Multiple Sms Url</h2>
                                       </div>
                                    </div>
                                    <div class="padding_infor_info">
                                       <?php
                                       $username       = $_SESSION['user'];
                                       $sqlw = "SELECT * FROM `api` WHERE `username` = '$username' ORDER BY `sl_no` DESC";
                                       $lessonQw = mysqli_query($con, $sqlw);

                                       if (mysqli_num_rows($lessonQw) > 0) {
                                          $a = mysqli_fetch_array($lessonQw);
                                          $api = $a['api'];
                                       ?>
                                          <p>http://localhost/bulk/user/api_quick.php?username=<?php echo $username ?>&api=<?php echo $api ?>&sender_name=XXXXXX&service=XXXXXX&template=XXXXX&msg_body=XXXXXX&num=XXXXXXX&input_language=XX&target_language=XX
                                          </p>
                                       <?php
                                       } else {
                                       ?>
                                          <p>http://localhost/bulk/user/api_quick.php?username=<?php echo $username ?>&api=XXXXXX&sender_name=XXXXXX&service=XXXXXX&template=XXXXX&msg_body=XXXXXX&num=XXXXXXX&input_language=XX&target_language=XX</p>
                                       <?php
                                       }
                                       ?>

                                    </div>
                                 </div>
                              </div>

                              <div class="col-md-12">
                                 <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                       <div class="heading1 margin_0">
                                          <h2>Schedule Message Url</h2>
                                       </div>
                                    </div>
                                    <div class="padding_infor_info">
                                       <?php
                                       $username       = $_SESSION['user'];
                                       $sqlw = "SELECT * FROM `api` WHERE `username` = '$username' ORDER BY `sl_no` DESC";
                                       $lessonQw = mysqli_query($con, $sqlw);

                                       if (mysqli_num_rows($lessonQw) > 0) {
                                          $a = mysqli_fetch_array($lessonQw);
                                          $api = $a['api'];
                                       ?>
                                          <p>http://localhost/bulk/user/api_schedule.php?username=<?php echo $username ?>&api=<?php echo $api ?>&sender_name=XXXXXX&service=XXXXXX&schedule=YYYY-DD-MM_HH:MM:SS&template=XXXXX&msg_body=XXXXXX&num=XXXXXXX&input_language=XX&target_language=XX
                                          </p>
                                       <?php
                                       } else {
                                       ?>
                                          <p>http://localhost/bulk/user/api_schedule.php?username=<?php echo $username ?>&api=XXXXXX&sender_name=XXXXXX&service=XXXXXX&schedule=YYYY-DD-MM_HH:MM:SS&template=XXXXX&msg_body=XXXXXX&num=XXXXXXX&input_language=XX&target_language=XX</p>
                                       <?php
                                       }
                                       ?>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-md-12">
                                 <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                       <div class="heading1 margin_0">
                                          <h2>Group Message Url</h2>
                                       </div>
                                    </div>
                                    <div class="padding_infor_info">
                                       <?php
                                       $username       = $_SESSION['user'];
                                       $sqlw = "SELECT * FROM `api` WHERE `username` = '$username' ORDER BY `sl_no` DESC";
                                       $lessonQw = mysqli_query($con, $sqlw);

                                       if (mysqli_num_rows($lessonQw) > 0) {
                                          $a = mysqli_fetch_array($lessonQw);
                                          $api = $a['api'];
                                       ?>
                                          <p>http://localhost/bulk/user/api_group.php?username=<?php echo $username ?>&api=<?php echo $api ?>&sender_name=XXXXXX&service=XXXXXX&group_name=XXXXX&template=XXXXX&msg_body=XXXXXX&input_language=XX&target_language=XX
                                          </p>
                                       <?php
                                       } else {
                                       ?>
                                          <p>http://localhost/bulk/user/api_group.php?username=<?php echo $username ?>&api=XXXXXX&sender_name=XXXXXX&service=XXXXXX&group_name=XXXXX&template=XXXXX&msg_body=XXXXXX&input_language=XX&target_language=XX</p>
                                       <?php
                                       }
                                       ?>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                       <div class="heading1 margin_0">
                                          <h2>Balance Check Url</h2>
                                       </div>
                                    </div>
                                    <div class="padding_infor_info">
                                       <?php
                                       $username       = $_SESSION['user'];
                                       $sqlw = "SELECT * FROM `api` WHERE `username` = '$username' ORDER BY `sl_no` DESC";
                                       $lessonQw = mysqli_query($con, $sqlw);

                                       if (mysqli_num_rows($lessonQw) > 0) {
                                          $a = mysqli_fetch_array($lessonQw);
                                          $api = $a['api'];
                                       ?>
                                          <p>http://localhost/bulk/user/api_balance.php?username=<?php echo $username ?>&api=<?php echo $api ?>
                                          </p>
                                       <?php
                                       } else {
                                       ?>
                                          <p>http://localhost/bulk/user/api_balance.php?username=<?php echo $username ?>&api=XXXXXX
                                          <?php
                                       }
                                          ?>
                                    </div>
                                 </div>
                              </div>
                              <!-- http://localhost/bulk/api_delivery.php?username=Sohambehera33@gmail.com&api=4551562d40fda206&msg_id=c7e6f3e8 -->
                              <div class="col-md-12">
                                 <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                       <div class="heading1 margin_0">
                                          <h2>Delivery Report</h2>
                                       </div>
                                    </div>
                                    <div class="padding_infor_info">
                                       <?php
                                       $username       = $_SESSION['user'];
                                       $sqlw = "SELECT * FROM `api` WHERE `username` = '$username' ORDER BY `sl_no` DESC";
                                       $lessonQw = mysqli_query($con, $sqlw);

                                       if (mysqli_num_rows($lessonQw) > 0) {
                                          $a = mysqli_fetch_array($lessonQw);
                                          $api = $a['api'];
                                       ?>
                                          <p>http://localhost/bulk/user/api_delivery.php?username=<?php echo $username ?>&api=<?php echo $api ?>&msg_id=XXXXX
                                          </p>
                                       <?php
                                       } else {
                                       ?>
                                          <p>http://localhost/bulk/user/api_delivery.php?username=<?php echo $username ?>&api=XXXXXX&msg_id=XXXXX
                                          <?php
                                       }
                                          ?>
                                    </div>
                                 </div>
                              </div>

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
      document.getElementById("api").className += " bg-secondary";
   </script>
</body>

</html>