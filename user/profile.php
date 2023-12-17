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
    <title>Profile</title>
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
</head>

<body class="inner_page profile_page">
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


                $query21 = "SELECT * FROM `register_table` where Email = '$username'";
                $result21 = mysqli_query($con, $query21);
                $reg = mysqli_fetch_array($result21);


                ?>
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Profile</h2>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row column1">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2>User profile</h2>
                                        </div>
                                        <?php
                                        if (@$_SESSION['showProfileError'] == true) {
                                        ?>
                                            <div class="alert alert-warning alert-dismissible">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Warning!</strong> <?php echo $_SESSION['showProfileError'] ?>
                                            </div>
                                        <?php
                                        }
                                        unset($_SESSION['showProfileError']);
                                        ?>
                                    </div>
                                    <div class="full price_table padding_infor_info">
                                        <div class="row">
                                            <!-- user profile section -->
                                            <!-- profile image -->
                                            <div class="col-lg-12">
                                                <div class="full dis_flex center_text">
                                                    <?php

                                                    if ($reg['profile_photo'] != "") {
                                                    ?>

                                                        <div class="profile_img"><img width="150" height="150" class="rounded-circle" src="uploads/profile_photos/<?php echo $reg['profile_photo'] ?>" alt="#" /></div>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="profile_img"><img width="150" height="150" class="rounded-circle" src="uploads/profile_photos/user_img.jpg" alt="#" /></div> <?php
                                                                                                                                                                                                }                                                                                                                                                                                     ?>
                                                    <div class="profile_contant">
                                                        <div class="contact_inner">
                                                            <h3><?php echo $reg['Name']; ?></h3>
                                                            <!-- <p><strong>About: </strong>Frontend Developer</p> -->
                                                            <ul class="list-unstyled">
                                                                <li><i class="fa fa-envelope-o"></i> :
                                                                    <?php echo $reg['Email']; ?></li>
                                                                <li><i class="fa fa-phone"></i> :
                                                                    <?php echo $reg['Phone_number']; ?></li>
                                                            </ul>
                                                            <button class="btn" style="margin-top:2rem;" data-toggle="modal" data-target="#myModal">Update</button>
                                                        </div>

                                                        <div class="user_progress_bar">
                                                            <div class="progress_bar">
                                                                <!-- Skill Bars -->
                                                                <span class="skill">Total Credit Used <span id="per"></span> %<span class="info_valume"></span></span>
                                                                <div class="progress skill-bar ">
                                                                    <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" id="bar">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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
                                                                            <input type="text" required class="form-control" name="name" id="name" value="<?php echo $reg['Name']; ?>" placeholder="Name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="mail">Email:</label>
                                                                            <input type="email" required value="<?php echo $reg['Email']; ?>" class="form-control" name="mail" id="mail" placeholder="Email">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="PhoneNumber">Mobile No:</label>
                                                                            <input type="text" required value="<?php echo $reg['Phone_number']; ?>" class="form-control" maxlength="10" minlength="10" name="PhoneNumber" id="PhoneNumber" placeholder="Mobile No">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="profile_photo">Profile
                                                                                Photo:</label>
                                                                            <input type="file" accept="image/*" class="form-control" name="profile_photo" id="profile_photo">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="about">About</label>
                                                                            <textarea class="form-control" required id="about" name="about" rows="3"><?php echo $reg['about']; ?></textarea>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn text-white" name="update12" style="background-color:#ff5722; padding:7px 15px 7px 15px;">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <!-- Modal footer -->


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- profile contant section -->
                                                <div class="full inner_elements margin_top_30">
                                                    <div class="tab_style2">
                                                        <div class="tabbar">
                                                            <nav>
                                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#recent_activity" role="tab" aria-selected="true">About</a>
                                                                </div>
                                                            </nav>
                                                            <div class="tab-content" id="nav-tabContent">
                                                                <div class="tab-pane fade show active" id="recent_activity" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                    <p><?php echo $reg['about']; ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end user profile section -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <!-- end row -->
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
    </div>
    <!-- jQuery -->
    <script>
        $(document).ready(function() {
            var max_credit = <?php echo $ch4['msg_credit']; ?>;
            var used_credit = <?php echo $ch4['credit_used']; ?>;
            var percent = used_credit / max_credit * 100;
            if (percent > 0) {
                // console.log(max_credit + "max credit");
                // console.log(used_credit + "used credit");
                // console.log(percent + "percent");
                var rounded = Math.floor(percent);
                document.getElementById('bar').style.width = percent + "%";

                document.getElementById('per').innerHTML = rounded;
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
    <script src="js/custom.js"></script>
    <!-- calendar file css -->
    <script src="js/semantic.min.js"></script>
    <script>
        document.getElementById("set").className += " bg-secondary";
    </script>
</body>

</html>