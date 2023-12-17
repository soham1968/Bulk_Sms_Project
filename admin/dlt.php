<?php
require("config.php");
?>
<?php
if (isset($_GET['delete'])) {

   $sql = "DELETE FROM template WHERE template_id='" . $_GET['delete'] . "'";
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
   <title>DLT Template</title>
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
                           <h2>DLT Template</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <!-- invoice section -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2><i class="fa fa-table"></i> DLT Template</h2>
                              </div>
                           </div>
                           <div class="padding_infor_info padding-bottom_3">

                              <button type="submit" class="btn text-white" style="background-color:#ff5722; padding:7px 15px 7px 15px;" data-toggle="modal" data-target="#myModal">Add New Template</button>

                              <!-- The Modal -->
                              <div class="modal" id="myModal">
                                 <div class="modal-dialog">
                                    <div class="modal-content">

                                       <!-- Modal Header -->
                                       <div class="modal-header">
                                          <h4 class="modal-title">Add DLT Template</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       </div>
                                       <!-- Modal body -->
                                       <div class="modal-body">
                                          <form action="request_handler.php" method="post" id="">
                                             <div class="form-group">
                                                <label for="sender_id">Sender Name:</label>
                                                <select class="form-control" id="sender_name" name="sender_name">
                                                   <option value="" disabled selected>Select Sender</option>
                                                   <?php
                                                   $username = $_SESSION['admin'];
                                                   $sqli = "SELECT sender_name FROM sender_request WHERE `status` = 'active' AND `username` = '$username' ";
                                                   $result = mysqli_query($con, $sqli);
                                                   while ($row = mysqli_fetch_array($result)) {
                                                      echo "<option value='" . $row['sender_name'] . "'>" . $row['sender_name'] . "</option>";
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="form-group">
                                                <label for="entity_id">Entity Id:</label>
                                                <input type="text" class="form-control" name="entity_id" readonly id="alpha" placeholder="Entity Id">
                                             </div>
                                             <div class="form-group">
                                                <label for="template_name">Template Name:</label>
                                                <input type="text" class="form-control" name="template_name" id="template_name" placeholder="#Example OTP">
                                             </div>
                                             <div class="form-group">
                                                <label for="template_body">Template Body:</label>
                                                <input type="text" class="form-control" name="template_body" id="template_body" placeholder="#Example Dear user..">
                                             </div>
                                             <!-- Modal footer -->
                                             <div class="modal-footer">
                                                <input type="submit" value="submit" name="temp" class="btn text-white" style="background-color:#ff5722; padding:7px 15px 7px 15px;">
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="padding_infor_info padding-bottom_3">
                              <div class="table-responsive-sm">
                                 <table class="table table-striped" id="myTable">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Sender Name</th>
                                          <th>Template Id</th>
                                          <th>Template Name</th>
                                          <th>Entity Id</th>
                                          <th>Body</th>
                                          <th>Created Date</th>
                                          <th>Delete</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <?php
                                          $username = $_SESSION['admin'];
                                          $sql = "SELECT * FROM `template` WHERE `username`= '$username'";
                                          $lessonQ = mysqli_query($con, $sql);


                                          $i = 1;
                                          while ($r = mysqli_fetch_array($lessonQ)) {
                                          ?>
                                             <td><?php print ucwords($i); ?></td>
                                             <td><?php print ucwords($r['sender_id']); ?></td>
                                             <td><?php print ucwords($r['template_id']); ?></td>
                                             <td><?php print ucwords($r['template_name']); ?></td>
                                             <td><?php print ucwords($r['entity_id']); ?></td>
                                             <td><?php print ucwords($r['template_body']); ?></td>
                                             <td><?php print ucwords($r['date']); ?></td>
                                             <td><a class="btn btn-danger" href="dlt.php?delete=<?php echo $r['template_id']; ?>" onClick="return confirm('Are you sure to delete this template?')">Delete</a></td>
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
         $('#myTable').DataTable();
      });
   </script>
   <script>
      $(document).ready(function() {
         $('#sender_name').on('change', function() {
            // alert("change");
            // alert("hi")
            var value = $(this).val();
            $.ajax({
               url: "change.php",
               type: "GET",
               data: 'requesten=' + value,
               success: function(data) {
                  $("#alpha").val(data);
               }
            });
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
      document.getElementById("dlt").className += " bg-secondary";
   </script>

</body>


</html>