<?php
require("config.php");
$found_numbers = array();
if (isset($_FILES['file']['tmp_name'])) {
    $file = $_FILES['file']['tmp_name'];
    $file_contents = file_get_contents($file);
    $lines = explode("\n", $file_contents);
    foreach ($lines as $line) {
        preg_match_all('/\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}/', $line, $phone_numbers);
        preg_match_all('/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})/', $line, $email_addresses);
        preg_match_all('/([A-Za-z]+\s[A-Za-z]+)/', $line, $names);
        $i = 0;
        if (!empty($names[0][$i]) && !empty($phone_numbers[0][$i]) && preg_match("/^[a-zA-Z ]*$/", $names[0][$i]) && preg_match("/^[0-9]{3}[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/", $phone_numbers[0][$i])) {
            if (!in_array($phone_numbers[0][$i], $found_numbers)) {
                array_push($found_numbers, $phone_numbers[0][$i]);
                echo  $names[0][$i] . " ";
                if (!empty($email_addresses[0][$i])) {
                    echo  $email_addresses[0][$i] . " ";
                }
                echo $phone_numbers[0][$i] . " , ";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
</head>

<body>
    <script>
        $(document).ready(function() {
            $('#file').on('change', function() {
                var value = $(this).val();
                var file = $('#file').prop('files')[0];
                var formData = new FormData();
                formData.append('file', file);
                formData.append('import-data', value);
                $.ajax({
                    url: "ran.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $("#add_mem").html(data);
                    }
                });
            });
        });
    </script>
    <form action="process_form.php" method="post" id="form_mem" enctype="multipart/form-data">
        <div class="custom-file col-md-3 d-block">
            <input type="file" class="" name="file" accept=".xls,.xlsx,.csv" id="file" aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="file">Choose file</label>
        </div>
        <textarea name="add_mem" id="add_mem" readonly cols="30" rows="10"></textarea>
        <div class="form-group" id="dis">
            <input type="submit" name="submit" value="Submit" class="btn btn-success btn-block">
        </div>
    </form>


</body>

</html>