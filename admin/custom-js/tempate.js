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
});