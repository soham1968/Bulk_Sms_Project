$(document).ready(function () {
    // create the validator
    var validator = $("#formID").validate({
        rules: {
            phoneNumbers: {
                required: true,
                phoneNumbers: true,
                noDuplicate: true
            },
        },
        messages: {
            phoneNumbers: {
                required: "Please enter at least one phone number",
                phoneNumbers: "Please enter valid phone numbers, separated by commas",
                noDuplicate: "Please enter unique phone numbers"
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});