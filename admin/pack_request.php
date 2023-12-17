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
                // $sql = "SELECT * FROM `sms_details` WHERE `username` = '$username'";
                // $lessonQ = mysqli_query($con, $sql);
                // $r = mysqli_fetch_array($lessonQ);
                ?>

                <!-- dashboard inner -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Pack Request</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- invoice section -->
                            <div class="col-md-12">
                                <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2><i class="fa fa-envelope"></i> Pack Request Report</h2>
                                            <?php
                                            if (@$_SESSION['showPackError'] == true) {
                                            ?>
                                                <div class="alert alert-warning alert-dismissible">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <strong>Warning!</strong> <?php echo $_SESSION['showPackError'] ?>
                                                </div>
                                            <?php
                                            }
                                            unset($_SESSION['showPackError']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="padding_infor_info padding-bottom_3 table-responsive">
                                        <!-- table section -->
                                        <div class="col-md-12">
                                            <div class="white_shd full margin_bottom_30">
                                                <!-- <div class="full graph_head">
                                                    <div class="heading1 margin_0">

                                                    </div>
                                                </div> -->
                                                <div class="table_section padding_infor_info">
                                                    <div class="table-responsive-sm">
                                                        <table class="table table-striped" id="myTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Username</th>
                                                                    <th>Pack Price</th>
                                                                    <th>Credit</th>
                                                                    <th>Request Date</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php

                                                                $sql = "SELECT * FROM `pack` WHERE `status` = 'pending'";
                                                                $lessonQ = mysqli_query($con, $sql);
                                                                $i = 1;
                                                                while ($r = mysqli_fetch_array($lessonQ)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php print($i); ?></td>
                                                                        <td><?php print ucwords($r['username']); ?></td>
                                                                        <td><?php print ucwords($r['pack']); ?></td>
                                                                        <td><?php print ucwords($r['credit']); ?></td>
                                                                        <td><?php print ucwords($r['date']); ?></td>
                                                                        <td>
                                                                            <a class="btn btn-success" href="request_handler.php?acceptPack=<?php echo $r['pack']; ?>&username=<?php echo $r['username']; ?>">
                                                                                <i class="fa fa-check"></i></a>
                                                                            <a class="btn btn-danger" href="request_handler.php?rejectPack=<?php echo $r['pack']; ?>&username=<?php echo $r['username']; ?>">
                                                                                <i class="fa fa-times"></i></a>
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
                // console.log(value);
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
        document.getElementById("pack_request").className += " bg-secondary";
    </script>
</body>

</html>