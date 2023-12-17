$(document).ready(function () {
    $('#template').on('change', function () {
        // alert("hi")
        var value = $(this).val();
        $.ajax({
            url: "fetch.php",
            type: "GET",
            data: 'requesten=' + value,
            success: function (data) {
                $("#message").html(data);
            }
        });
    });
    $('#group').on('change', function () {
        document.getElementById('con').style.display = "block";
        var value = $(this).val();
        $.ajax({
            url: "fetch_num.php",
            type: "GET",
            data: 'requesten=' + value,
            success: function (data) {
                $("#message2").html(data);
            }
        });
    });
    // create the validator
    var validator = $("#formID").validate({
        rules: {
            group: {
                required: true,
            },
            message: {
                required: true,
            },
        },
        messages: {
            group: {
                required: "This field is required.",
            },
            message: {
                required: "This field is required.",
            },
        },
        submitHandler: function (form) {
            form.submit();
        },
    });
});