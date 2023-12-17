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
    <title>Pack Request</title>
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
                $sql = "SELECT * FROM `admin_register`";
                $lessonQd = mysqli_query($con, $sql);
                $fet = mysqli_fetch_array($lessonQd);
                ?>

                <!-- dashboard inner -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Update User Details</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- invoice section -->
                            <div class="col-md-12">
                                <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2><i class="fa fa-user mr-1"></i>Update User Details</h2>
                                            <?php
                                            if (@$_SESSION['showUserError'] == true) {
                                            ?>
                                                <div class="alert alert-warning alert-dismissible">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <strong>Warning!</strong> <?php echo $_SESSION['showUserError'] ?>
                                                </div>
                                            <?php
                                            }
                                            unset($_SESSION['showUserError']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="padding_infor_info padding-bottom_3 table-responsive">
                                        <!-- table section -->
                                        <div class="col-md-12">
                                            <div class="white_shd full margin_bottom_30">
                                                <div class="table_section padding_infor_info">
                                                    <div class="table-responsive-sm">
                                                        <table class="table table-striped" id="myTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Full Name</th>
                                                                    <th>Phone Number</th>
                                                                    <th>Email</th>
                                                                    <th>No. of Msg Sent</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $query5 = "SELECT * FROM `sms_details`";
                                                                $result5 = mysqli_query($con, $query5);
                                                                $sum = 0;
                                                                while ($row = mysqli_fetch_array($result5)) {
                                                                    $sum += $row['credit_used'];
                                                                }


                                                                $sql = "SELECT `register_table`.`Name`, `register_table`.`Phone_number` , `register_table`.`Email` , 
                                                                `dashboard`.`credit_used` FROM `register_table` INNER JOIN `dashboard` ON `register_table`.Email=`dashboard`.username;";
                                                                $lessonQ = mysqli_query($con, $sql);
                                                                $i = 1;
                                                                while ($r = mysqli_fetch_array($lessonQ)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php print($i); ?></td>
                                                                        <td><?php print ucwords($r['Name']); ?></td>
                                                                        <td><?php print ucwords($r['Phone_number']); ?></td>
                                                                        <td><?php print ucwords($r['Email']); ?></td>
                                                                        <td><?php print ucwords($r['credit_used']); ?></td>
                                                                        <td>
                                                                            <!-- <a class="btn btn-success" data-toggle="modal" data-target="#myModal" href="#"> Update</a> -->
                                                                            <button type="button" class="btn btn-primary btn-1" value="<?php echo $r['Phone_number']; ?>">Update</button>
                                                                            <a class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this User?')" href="request_handler.php?delete_user=<?php echo $r['Phone_number']; ?>">Delete</a>
                                                                        </td>
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
                                        <div>
                                            <!-- The Modal -->
                                            <div class="modal" id="myModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Profile</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <form action="request_handler.php" method="post" id="" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <label for="name">Name:</label>
                                                                    <input type="text" required class="form-control" name="name" id="name" value="" placeholder="Name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="mail">Email:</label>
                                                                    <input type="email" required value="" class="form-control" name="mail" id="mail" placeholder="Email">
                                                                    <input type="text" value="" class="form-control" style="display: none;" name="sl_no" id="sl_no" placeholder="sl_no">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="PhoneNumber">Mobile No:</label>
                                                                    <input type="text" required value="" class="form-control" maxlength="10" minlength="10" name="PhoneNumber" id="PhoneNumber" placeholder="Mobile No">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="PhoneNumber">Password:</label>
                                                                    <input type="text" value="" class="form-control" maxlength="15" minlength="8" name="Password" id="password" placeholder="Password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="about">About</label>
                                                                    <textarea class="form-control" id="about" required id="about" name="about" rows="3"></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn text-white" name="user_update" style="background-color:#ff5722; padding:7px 15px 7px 15px;">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <!-- Modal footer -->


                                                    </div>
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
    <script>
        $(document).ready(function() {
            $(".btn-1").click(function() {
                var value2 = $(this).val();
                console.log(value2);
                $.ajax({
                    url: "getdata.php",
                    type: "GET",
                    data: 'alpha=' + value2,
                    success: function(data) {
                        const obj = JSON.parse(data)
                        $('#sl_no').val(obj.sl_no)
                        $('#name').val(obj.name)
                        $('#mail').val(obj.email)
                        $('#PhoneNumber').val(obj.num)
                        $('#about').val(obj.about)
                    }
                });
                $("#myModal").modal("show");
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
        document.getElementById("user_update").className += " bg-secondary";
    </script>
</body>

</html>