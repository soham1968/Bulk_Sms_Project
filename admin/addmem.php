<?php
require("config.php");
?>
<?php
// delete members

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
   <title>Add Members</title>
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
            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Add Members To Group</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <!-- invoice section -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2><i class="fa fa-users"></i> Add Members To Group</h2>
                                 <?php
                                 if (@$_SESSION['showGroupMemberError'] == true) {
                                 ?>
                                    <div class="alert alert-warning alert-dismissible">
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                       <strong>Warning!</strong> <?php echo $_SESSION['showGroupMemberError'] ?>
                                    </div>
                                 <?php
                                 }
                                 unset($_SESSION['showGroupMemberError']);
                                 ?>
                              </div>
                           </div>
                           <div class="padding_infor_info padding-bottom_3">
                              <form action="request_handler.php" method="post" id="form_mem" onsubmit="return validation()">
                                 <div class="row">
                                    <div class="col-md-3 form-group">
                                       <label for="group_name">Group</label>
                                       <select class="form-control" required name="group_name">
                                          <option value=" " disabled selected>Select Group</option>
                                          <?php
                                          $username = $_SESSION['admin'];
                                          $sql = "SELECT `group_name` FROM `group_creation` WHERE `username` = '$username' ";
                                          $result = mysqli_query($con, $sql);

                                          while ($row = mysqli_fetch_array($result)) {
                                             echo "<option value='" . $row['group_name'] . "'>" . $row['group_name'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                       <label for="name">Name</label>
                                       <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                    </div>
                                    <div class="col-md-3 form-group">
                                       <label for="num">Number</label>
                                       <input type="text" class="form-control" minlength="10" maxlength="10" name="phoneNumbers" id="phoneNumbers" placeholder="Number">
                                    </div>

                                    <div class="col-md-3 form-group">
                                       <label for="mail">Email(Optional)</label>
                                       <input type="text" class="form-control" name="mail" aria-describedby="emailHelp" placeholder="Email">
                                    </div>
                                 </div>

                                 <button type="submit" name="addmem" class="btn text-white" style="background-color:#ff5722; padding:7px 15px 7px 15px; ">Add</button>
                              </form>

                              <!-- Import form -->
                              <form action="request_handler.php" method="post" id="form_import" enctype="multipart/form-data" class="mt-3" onsubmit="return validation()">
                                 <legend class="text-dark">Add Members Using CSV Or Excel File</legend>
                                 <div class="row d-flex align-items-end align-items-start">
                                    <div class="col-md-3 d-flex m-0 flex-column align-content-end form-group">
                                       <label for="group_name">Group</label>
                                       <select class="form-control" required name="group_name">
                                          <option value=" " disabled selected>Select Group</option>
                                          <?php
                                          $username = $_SESSION['admin'];
                                          $sql = "SELECT `group_name` FROM `group_creation` WHERE `username` = '$username' ";
                                          $result = mysqli_query($con, $sql);

                                          while ($row = mysqli_fetch_array($result)) {
                                             echo "<option value='" . $row['group_name'] . "'>" . $row['group_name'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-3 d-flex m-0 flex-column align-content-end form-group">
                                       <input type="file" class="custom-file-input" name="file" accept=".xls,.xlsx,.csv" id="file" aria-describedby="inputGroupFileAddon01">
                                       <label class="custom-file-label" for="file">Choose file</label>
                                    </div>
                                 </div>
                                 <div class="form-group " id="dis" style="display: none;">
                                    <textarea class="form-control" readonly id="add_mem" rows="5"></textarea>
                                    <button type="submit" name="add_members" class="btn text-white" style="background-color:#ff5722; padding:7px 15px 7px 15px;margin-top:10px;">Submit</button>
                                 </div>

                              </form>
                           </div>

                           <div class="padding_infor_info padding-bottom_3 table-responsive">
                              <!-- table section -->
                              <div class="col-md-12">
                                 <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                       <div class="heading1 margin_0">
                                          <h2>Members</h2>
                                       </div>
                                    </div>
                                    <div class="table_section padding_infor_info">
                                       <div class="table-responsive-sm">
                                          <table class="table table-striped" id="myTable">
                                             <thead>
                                                <tr>
                                                   <th>#</th>
                                                   <th>Group</th>
                                                   <th>Name</th>
                                                   <th>Number</th>
                                                   <th>Email</th>
                                                   <th>Added On</th>
                                                   <th>Remove</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php

                                                $sql = "SELECT * FROM `group_members` WHERE `username` = '$username'";
                                                $lessonQ = mysqli_query($con, $sql);
                                                $i = 1;
                                                while ($r = mysqli_fetch_array($lessonQ)) {
                                                ?>
                                                   <tr>
                                                      <td><?php print($i); ?></td>
                                                      <td><?php print ucwords($r['group_name']); ?></td>
                                                      <td><?php print ucwords($r['group_member_name']); ?></td>
                                                      <td><?php print ucwords($r['group_member_num']); ?></td>
                                                      <td><?php print ucwords($r['group_member_mail']); ?></td>
                                                      <td><?php print ucwords($r['date_time']); ?></td>
                                                      <td><a class="btn btn-danger" href="request_handler.php?deletee=<?php echo $r['group_member_num']; ?>&group_name=<?php echo
                                                                                                                                                                        $r['group_name']; ?>" onClick="return confirm('Are you sure to delete this record?')">Delete</a></td>
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
   <script>
      $(document).ready(function() {

         $('#file').on('change', function() {
            document.getElementById('dis').style.display = "block";
            var value = $(this).val();
            var file = $('#file').prop('files')[0];
            var formData = new FormData();
            formData.append('file', file);
            formData.append('import-data', value);
            $.ajax({
               url: "imp.php",
               type: "POST",
               data: formData,
               processData: false,
               contentType: false,
               success: function(data) {
                  $("#add_mem").html(data);
               }
            });
         });


         $.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
         }, "Letters only please");


         // create the validator
         var validator = $("#form_mem").validate({
            rules: {
               name: {
                  required: true,
                  lettersonly: true
               },
               phoneNumbers: {
                  required: true,
                  phoneNumbers: true,
                  minlength: 10,
                  maxlength: 10
               }
            },
            messages: {
               name: {
                  required: "Please enter a name",
                  lettersonly: "Please enter a valid name, only characters are allowed"
               },
               phoneNumbers: {
                  required: "Please enter at least one phone number",
                  phoneNumbers: "Please enter valid phone numbers, separated by commas",
                  minlength: "Please enter a valid phone number, minimum 10 digits required",
                  maxlength: "Please enter a valid phone number, maximum 10 digits allowed"
               }
            },
            submitHandler: function(form) {
               form.submit();
            }
         });

      });
   </script>
   <!-- jQuery -->
   <script src="custom-js/validation.js"></script>
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
      document.getElementById("mgp").className += " bg-secondary";
   </script>
</body>

</html>