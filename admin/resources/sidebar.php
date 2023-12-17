<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
   header("location: index.php");
   exit;
}
?>
<?php
require("config.php");

$username = $_SESSION['admin'];
$query21 = "SELECT * FROM `admin_register` where Email = '$username'";
$result21 = mysqli_query($con, $query21);
$reg = mysqli_fetch_array($result21);
?>

<nav id="sidebar">
   <div class="sidebar_blog_1">
      <div class="sidebar-header">
         <div class="logo_section">
            <a href="index.php"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png" alt="#" /></a>
         </div>
      </div>
      <div class="sidebar_user_info">
         <div class="icon_setting"></div>
         <div class="user_profle_side">
            <!-- <div class="user_img"><img class="img-responsive" height="75" width="75" src="uploads/profile_photos/<?php echo $reg['profile_photo'] ?>" alt="#" /></div> -->

            <!-- <div class="user_img"><img class="img-responsive" height="75" width="75" src="uploads/profile_photos/user_img.jpg" alt="#" /></div> -->
            <?php

            if ($reg['profile_photo'] != "") {
            ?>
               <div class="user_img"><img class="img-responsive" height="75" width="75" src="uploads/profile_photos/<?php echo $reg['profile_photo'] ?>" alt="#" /></div>
            <?php
            } else {
            ?>
               <div class="user_img"><img class="img-responsive" height="75" width="75" src="uploads/profile_photos/user_img.jpg" alt="#" /></div>
            <?php
            }
            ?>

            <div class="user_info">
               <h6>Admin</h6>
               <p><span class="online_animation"></span> Online</p>
            </div>
         </div>
      </div>
   </div>
   <div class="sidebar_blog_2">
      <h4>Bulk SMS</h4>
      <ul class="list-unstyled components">
         <li class="active"><a id="dash" href="dashboard.php"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a></li>
         <li>
            <a href="#element" id="mess" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-envelope-o green_color"></i> <span>Send Message</span></a>
            <ul class="collapse list-unstyled" id="element">
               <li><a href="quick.php">> <span>Quick Message</span></a></li>
               <li><a href="csv.php">> <span>Csv/Xls Message</span></a></li>
               <li><a href="grmes.php">> <span>Group Message</span></a></li>
            </ul>
         </li>
         <li><a id="dlt" href="dlt.php"><i class="fa fa-table purple_color2"></i> <span>DLT Template</span></a></li>
         <li><a id="sender" href="sendername.php"><i class="fa fa-user blue1_color"></i> <span>Sender Name</span></a></li>
         <li class="active">
            <a id="report" href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clone yellow_color"></i> <span>Reports</span></a>
            <ul class="collapse list-unstyled" id="additional_page">
               <li>
                  <a href="sent.php">> <span>Sent SMS</span></a>
               </li>
               <li>
                  <a href="smssum.php">> <span>SMS Summary</span></a>
               </li>
               <li>
                  <a href="rechargelog.php">> <span>Recharge Log</span></a>
               </li>
               <li>
                  <a href="sce.php">> <span>Scheduled Message</span></a>
               </li>
            </ul>
         </li>
         <li class="active">
            <a id="mgp" href="#additional_page2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users orange_color"></i> <span>Groups</span></a>
            <ul class="collapse list-unstyled" id="additional_page2">
               <li>
                  <a href="mgp.php">> <span>Manage Group</span></a>
               </li>
               <li>
                  <a href="addmem.php">> <span>Add Member</span></a>
               </li>
            </ul>
         </li>

         <li class="active">
            <a id="set" href="#additional_page3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a>
            <ul class="collapse list-unstyled" id="additional_page3">
               <li>
                  <a href="profile.php">> <span>My Profile</span></a>
               </li>
               <li>
                  <a href="uppass.php">> <span>Change Password</span></a>
               </li>
            </ul>
         </li>
         <li><a id="api" href="api.php"><i class="fa fa-map purple_color2"></i> <span>Developer API</span></a></li>
         <li><a id="price" href="price.php"><i class="fa fa-money green_color"></i> <span>Pricing</span></a></li>
         <li><a id="sender_request" href="sender_request.php"><i class="fa fa-user-plus blue1_color"></i> <span>Sender Request</span></a></li>
         <li><a id="pack_request" href="pack_request.php"><i class="fa fa-money orange_color"></i> <span>Pack Request</span></a></li>
         <li><a id="user_update" href="user_update.php"><i class="fa-solid fa-user-pen yellow_color"></i> <span>User Update</span></a></li>

         <li><a id="log" href="logout.php"><i class="fa fa-sign-out black_color" style="color: grey;"></i> <span>Log Out</span></a></li>
      </ul>
   </div>
</nav>