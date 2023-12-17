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
   <title>Sent Message</title>
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
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" />
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
   <style>
      .noid {
         word-break: break-all;
      }
   </style>
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
            $username       = $_SESSION['admin'];
            $sql = "SELECT * FROM `sms_details` WHERE `username` = '$username'";
            $lessonQ = mysqli_query($con, $sql);
            $r = mysqli_fetch_array($lessonQ);

            ?>


            <!-- Modal -->
            <div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Message Body</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>

                     <div class="modal-body">
                        <p id="modal_msg" class="noid"></p>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- modal ends here -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Phone Numbers</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>

                     <div class="modal-body">
                        <p id="modal_number" class="noid"><?php echo $r['mobile_numbers']; ?></p>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- modal ends here -->


            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Sent Message</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <!-- invoice section -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2><i class="fa fa-envelope"></i> Sent Message Report</h2>
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
                                                   <th>Id</th>
                                                   <th>Message</th>
                                                   <th>Mobile No.</th>
                                                   <th>Sent On</th>
                                                   <th>Status</th>
                                                   <th>Service</th>
                                                   <th>Sender Name</th>
                                                   <th>Credit</th>
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
                                                      <td><?php print ucwords($r['msg_id']); ?></td>
                                                      <td>
                                                         <button type="button" class="btn btn-primary btn-1" value="<?php echo $r['msg_id']; ?>"> Show message</button>
                                                      </td>
                                                      <td>
                                                         <button type="button" class="btn btn-primary btn-2" value="<?php echo $r['msg_id']; ?>"> Show numbers </button>
                                                      </td>
                                                      <td><?php print ucwords($r['sent_on']); ?></td>
                                                      <td><?php print ucwords($r['status']); ?></td>
                                                      <td><?php print ucwords($r['service']); ?></td>
                                                      <td><?php print ucwords($r['sender_name']); ?></td>
                                                      <td><?php print ucwords($r['credit_used']); ?></td>

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
   <script>
      $(document).ready(function() {
         $(".btn-2").click(function() {
            var value = $(this).val();
            console.log(value);
            $.ajax({
               url: "getmsg.php",
               type: "GET",
               data: 'requesten=' + value,
               success: function(data) {
                  $("#modal_number").html(data);
               }
            });
            $("#exampleModalLong").modal("show");
         });
         $('#myTable').DataTable();
         $(".btn-1").click(function() {
            var value2 = $(this).val();
            console.log(value2);
            $.ajax({
               url: "getmsg.php",
               type: "GET",
               data: 'alpha=' + value2,
               success: function(data) {
                  $("#modal_msg").html(data);
               }
            });
            $("#exampleModalLong2").modal("show");
         });
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
      document.getElementById("report").className += " bg-secondary";
   </script>
</body>

</html>