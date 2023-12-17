$(document).ready(function () {
    $('#file').on('change', function () {
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
            success: function (data) {
                $("#phoneNumbers").html(data);
            }
        });
    });
});
