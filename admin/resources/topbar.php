<?php
require("config.php");
?>
<?php
require("config.php");

$username = $_SESSION['admin'];
$query21 = "SELECT * FROM `admin_register` where Email = '$username'";
$result21 = mysqli_query($con, $query21);
$reg = mysqli_fetch_array($result21);
?>
<div class="topbar">
   <nav class="navbar navbar-expand-lg navbar-light">
      <div class="full">
         <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
         <div class="logo_section">
            <a href="dashboard.php"><img class="img-responsive" src="images/logo/logo.png" alt="#" /></a>
         </div>
         <div class="right_topbar">
            <div class="icon_info">
               <ul class="user_profile_dd">
                  <li>

                     <?php

                     if ($reg['profile_photo'] != "") {
                     ?>
                        <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" height="35" src="uploads/profile_photos/<?php echo $reg['profile_photo'] ?>" alt="#" /><span class="name_user"> Admin</span></a>
                     <?php
                     } else {
                     ?>
                        <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" height="35" src="uploads/profile_photos/user_img.jpg" alt="#" /><span class="name_user">
                              Admin</span></a>

                     <?php
                     }
                     ?>

                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.php">Profile</a>
                        <a class="dropdown-item" href="logout.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </nav>
</div>