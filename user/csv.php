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
   <title>CSV/XLS Message</title>
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
                           <h2>CSV/XLS Message</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <!-- invoice section -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2><i class="fa fa-envelope-o"></i> CSV/XLS Message</h2>
                                 <?php
                                 if (@$_SESSION['showCsv'] == true) {
                                 ?>
                                    <div class="alert alert-success alert-dismissible">
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                       <strong>Success !</strong> <?php echo $_SESSION['showCsv'] ?>
                                    </div>
                                 <?php
                                 }
                                 unset($_SESSION['showCsv']);
                                 ?>

                                 <?php
                                 if (@$_SESSION['showCsvError'] == true) {
                                 ?>
                                    <div class="alert alert-warning alert-dismissible">
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                       <strong>Warning !</strong> <?php echo $_SESSION['showCsvError'] ?>
                                    </div>
                                 <?php
                                 }
                                 unset($_SESSION['showCsvError']);
                                 ?>
                              </div>
                           </div>
                           <div class="padding_infor_info padding-bottom_3">
                              <form action="submit.php" method="post" id="formID">
                                 <div class="row">
                                    <div class="col-md-5 input-group">
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" required name="file" accept=".xls,.xlsx,.csv" id="file">
                                          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group padding-bottom_2">
                                    <small>Please make sure that your phone numbers are in the <strong>first column</strong></small>
                                 </div>
                                 <div class="form-group" id="dis" style="display: none;">
                                    <label for="phoneNumbers">Phone Numbers</label>
                                    <textarea class="form-control" readonly name="phoneNumbers" id="phoneNumbers" rows="5"></textarea>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-3 form-group">
                                       <label for="services">Services</label>
                                       <select class="form-control" id="services" required name="services">
                                          <option value="" disabled selected>Select Service</option>
                                          <?php
                                          $sql = "SELECT service_name FROM service";
                                          $result = mysqli_query($con, $sql);

                                          while ($row = mysqli_fetch_array($result)) {
                                             echo "<option value='" . $row['service_name'] . "'>" . $row['service_name'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                       <label for="sender">Sender Name</label>
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
                                    <div class="col-md-3 form-group">
                                       <label for="template">Template</label>
                                       <select class="form-control" id="template" name="template">
                                          <option value="" disabled selected>Select Template</option>
                                          <?php
                                          // $username = $_SESSION['user'];
                                          $sqli = "SELECT template_name FROM template WHERE `username` = '$username' ";
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
                                 <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" required id="message" name="message" rows="5"></textarea>
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
                                          <input type="text" id="no_of_msg" style="display: none;" name="no_of_msg">
                                          <input class="form-check-input" onclick="leta()" type="checkbox" id="pik">
                                          <label class="form-check-label" for="pik">
                                             Schedule
                                          </label>
                                       </div>
                                    </div>
                                    <div class="row padding-bottom_3">
                                       <div class="col-md-4 form-group">
                                          <input id="dd" type="datetime-local" name="date_time" class="form-control" style="width:10rem; display:none;">
                                       </div>
                                    </div>
                                 </div>
                                 <button type="submit" class="btn text-white" name="submit_csv" style="background-color:#ff5722; padding:7px 15px 7px 15px;">Send</button>
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
   <!-- jQuery -->
   <script src="custom-js/tempate.js"></script>

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
               url: "import.php",
               type: "POST",
               data: formData,
               processData: false,
               contentType: false,
               success: function(data) {
                  $("#phoneNumbers").html(data);
               }
            });
         });
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