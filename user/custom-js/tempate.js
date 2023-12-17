$(document).ready(function () {
    $('#template').on('change', function () {
        var value = $(this).val();
        $.ajax({
            url: "fetch.php",
            type: "GET",
            data: 'requesten=' + value,
            success: function (data) {
                $("#message").html(data);
                var text = $("#message").val();
                var charCount = text.length;
                console.log(charCount);
                $("#char-count").html(text.length);
            }
        });

    });
});