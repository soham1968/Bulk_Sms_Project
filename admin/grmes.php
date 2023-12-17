<?php
include("config.php");
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
   <title>Group Message</title>
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
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
   <style>
      .box {
         width: 130px;
         height: 35px;
         border: 0.1px;
         margin-right: 5px;
         padding: 2px;
         color: white;
         background-color: #ff5722;
         display: flex;
         align-items: center;
         justify-content: space-around;
         box-shadow: 0px 0px 5px #888888;
      }

      .datas {
         background-color: white;
         color: black;
         border-radius: 50%;
         width: 20%;
         height: 90%;
         display: flex;
         justify-content: center;
         align-items: center;
         font-size: 12px;
         font-weight: bold;

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
            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Group Message</h2>
                           <?php
                           if (@$_SESSION['showGroup'] == true) {
                           ?>
                              <div class="alert alert-success alert-dismissible">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>Success !</strong> <?php echo $_SESSION['showGroup'] ?>
                              </div>
                           <?php
                           }
                           unset($_SESSION['showGroup']);
                           ?>

                           <?php
                           if (@$_SESSION['showGroupError'] == true) {
                           ?>
                              <div class="alert alert-warning alert-dismissible">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>Warning !</strong> <?php echo $_SESSION['showGroupError'] ?>
                              </div>
                           <?php
                           }
                           unset($_SESSION['showGroupError']);
                           ?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <!-- invoice section -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2><i class="fa fa-envelope-o"></i> Group Message</h2>
                              </div>
                           </div>
                           <div class="padding_infor_info padding-bottom_3">
                              <form action="submit.php" method="post" id="formID">
                                 <div class="row">
                                    <div class="col-md-3 form-group">
                                       <label for="group">Group</label>
                                       <select class="form-control" required name="group" id="group">
                                          <option value="#" disabled selected>Select Group</option>
                                          <?php
                                          $username = $_SESSION['admin'];
                                          $sqlx = "SELECT `group_name` FROM `group_creation` WHERE `username` = '$username'";
                                          $result = mysqli_query($con, $sqlx);
                                          while ($row = mysqli_fetch_array($result)) {
                                             echo "<option value='" . $row['group_name'] . "'>" . $row['group_name'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                       <label for="service">Services</label>
                                       <select class="form-control" required name="service" id="service">
                                          <option value="" disabled selected>Select Service</option>
                                          <?php
                                          $sqlx = "SELECT `service_name` FROM `service`";
                                          $result = mysqli_query($con, $sqlx);
                                          while ($row = mysqli_fetch_array($result)) {
                                             echo "<option value='" . $row['service_name'] . "'>" . $row['service_name'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                       <label for="sender">Sender Name</label>
                                       <select class="form-control" required name="sender" id="sender">
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
                                    <div class="col-md-3 form-group">
                                       <label for="template">Template</label>
                                       <select class="form-control" name="template" id="template">
                                          <option value="" disabled selected>Select Template</option>
                                          <?php
                                          $sqli = "SELECT `template_name` FROM template WHERE `username` = '$username' ";
                                          $result = mysqli_query($con, $sqli);
                                          while ($row = mysqli_fetch_array($result)) {
                                             echo "<option value='" . $row['template_name'] . "'>" . $row['template_name'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                       <label for="language">Language</label>
                                       <select class="form-control" id="language" name="language">
                                          <option value="af">Afrikaans</option>
                                          <option value="ar">Arabic</option>
                                          <option value="bg">Bulgarian</option>
                                          <option value="zh-CN">Chinese</option>
                                          <option value="cs">Czech</option>
                                          <option value="nl">Dutch</option>
                                          <option selected value="en">English</option>
                                          <option value="hi">Hindi</option>
                                          <option value="ga">Irish</option>
                                          <option value="it">Italian</option>
                                          <option value="ja">Japanese</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group" id="con" style="display: none;">
                                    <label for="PhoneNumbers">Contact Details</label>
                                    <textarea class="form-control" readonly id="message2" name="PhoneNumbers" rows="5"></textarea>
                                 </div>
                                 <div class="form-group">
                                    <input type="text" id="no_of_msg" style="display: none;" name="no_of_msg">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" name="message" id="message" rows="5"></textarea>
                                 </div>
                                 <div class="d-flex w-100 justify-content-end pr-3">
                                    <div class="box">
                                       <div id="char-count" class="datas">0</div>
                                       <div>
                                          <p class="text-white m-0 pl-1">Char Count</p>
                                       </div>
                                    </div>
                                    <div class="box">
                                       <div id="char" class="datas">160</div>
                                       <div>
                                          <p class="text-white m-0 pl-1">MAX Char</p>
                                       </div>
                                    </div>
                                    <div class="box">
                                       <div id="msg" class="datas">0</div>
                                       <div>
                                          <p class="text-white m-0 pl-1">No. of Msg</p>
                                       </div>
                                    </div>
                                    <input type="button" id="translate-btn" class="btn btn-success" value="Translate">
                                 </div>
                                 <div class="row padding-bottom_3">
                                    <div class="col-md-4 form-group">
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" id="pik" onclick="leta()">
                                          <label class="form-check-label" for="pik">
                                             Schedule
                                          </label>
                                       </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                       <input id="dd" type="datetime-local" name="date_time" class="form-control" style="width:10rem; display:none;">
                                    </div>
                                 </div>
                                 <button type="submit" class="btn text-white" name="group_msg" style="background-color:#ff5722; padding:7px 15px 7px 15px;">Send</button>
                              </form>
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
         // $('#file').on('change', function() {
         //    document.getElementById('dis').style.display = "block";
         //    var value = $(this).val();
         //    var file = $('#file').prop('files')[0];
         //    var formData = new FormData();
         //    formData.append('file', file);
         //    formData.append('import-data', value);
         //    $.ajax({
         //       url: "import.php",
         //       type: "POST",
         //       data: formData,
         //       processData: false,
         //       contentType: false,
         //       success: function(data) {
         //          $("#phoneNumbers").html(data);
         //       }
         //    });
         // });
         // Emoji Count
         $("#message").keyup(function() {
            var text = $("#message").val();
            emojiCount = text.match(/([\uD800-\uDBFF][\uDC00-\uDFFF])/g) || [];
            // $("#emoji-count").text("E: " + emojiCount.length);
            if (emojiCount.length > 0) {
               document.getElementById("char").innerHTML = "70";
               msgCount = 70;
            }
            if (emojiCount.length == 0) {
               document.getElementById("char").innerHTML = "160";
               msgCount = 160;
            }
         });

         // Number of message Count
         $("#message").keyup(function() {
            var text = $("#message").val();
            var charCount = text.length;
            $("#char-count").text(charCount);
            if (charCount > 0) {
               var msg = Math.ceil(charCount / msgCount);
               document.getElementById("msg").innerHTML = msg;
               // document.getElementById("no_of_msg").value = msg;
            } else {
               document.getElementById("msg").innerHTML = "0";
               // document.getElementById("no_of_msg").value = "0";

            }
         });
         $("#formID").submit(function() {
            var text = $("#message").val();
            emojiCount = text.match(/([\uD800-\uDBFF][\uDC00-\uDFFF])/g) || [];
            // $("#emoji-count").text("E: " + emojiCount.length);
            if (emojiCount.length > 0) {
               document.getElementById("char").innerHTML = "70";
               msgCount = 70;
            }
            if (emojiCount.length == 0) {
               document.getElementById("char").innerHTML = "160";
               msgCount = 160;
            }

            var text = $("#message").val();
            var charCount = text.length;
            $("#char-count").text(charCount);
            if (charCount > 0) {
               var msg = Math.ceil(charCount / msgCount);
               document.getElementById("msg").innerHTML = msg;
               document.getElementById("no_of_msg").value = msg;
            } else {
               document.getElementById("msg").innerHTML = "0";
               document.getElementById("no_of_msg").value = "0";

            }
         });
      });
   </script>
   <script>
      $(document).ready(function() {
         $('#template').on('change', function() {
            var value = $(this).val();
            $.ajax({
               url: "fetch.php",
               type: "GET",
               data: 'requesten=' + value,
               success: function(data) {
                  $("#message").html(data);
                  var text = $("#message").val();
                  var charCount = text.length;
                  console.log(charCount);
                  $("#char-count").html(text.length);
               }
            });

         });
         // Translate Button
         $("#translate-btn").click(function() {
            var text = $("#message").val();
            var targetLanguage = lang;
            var inputLanguage = "en";
            var url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=" + inputLanguage + "&tl=" + targetLanguage + "&dt=t&q=" + encodeURI(text);
            $.ajax({
               url: url,
               success: function(result) {
                  var text = result[0][0][0];
                  $("#message").val(text + " ");
                  var charCount = text.length;
                  console.log(charCount);
                  $("#char-count").html(text.length);
               }
            });
            console.log(text);
         });
      });
   </script>
   <script src="custom-js/csv.js"></script>
   <script src="custom-js/translate.js"></script>
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
      document.getElementById("mess").className += " bg-secondary";
   </script>
   <script>
      function leta() {
         var dr = document.getElementById('dd');
         var mt = document.getElementById('pik');

         if (mt.checked == true) {
            dr.style.display = "block";
         } else {
            dr.style.display = "none";
         }
      }
   </script>
</body>

</html>