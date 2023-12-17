$(document).ready(function () {
    // create the validator
    var validator = $("#formID").validate({
        rules: {
            phoneNumbers: {
                required: true,
                phoneNumbers: true,
                noDuplicate: true,
            },
            message: {
                required: true,
            },
        },
        messages: {
            phoneNumbers: {
                required: "Please enter at least one phone number",
                phoneNumbers: "Please enter valid phone numbers, separated by commas",
                noDuplicate: "Please enter unique phone numbers",
            },
            message: {
                required: "PLease fill this part",
            },
        },
        submitHandler: function (form) {
            form.submit();
        },
    });
    // add custom validation method for phone numbers
    $.validator.addMethod(
        "phoneNumbers",
        function (value, element) {
            var phoneNumbers = value.split(",");
            for (var i = 0; i < phoneNumbers.length; i++) {
                var phoneNumber = phoneNumbers[i].trim();
                if (
                    !/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/.test(
                        phoneNumber
                    )
                ) {
                    return false;
                }
            }
            return true;
        },
        "Please enter valid phone numbers, separated by commas"
    );

    // add custom validation method to check for duplicate phone numbers
    $.validator.addMethod(
        "noDuplicate",
        function (value, element) {
            var phoneNumbers = value.split(",");
            var uniquePhoneNumbers = new Set(phoneNumbers);
            return phoneNumbers.length === uniquePhoneNumbers.size;
        },
        "Please enter unique phone numbers"
    );

    // bind the validation function to the input event of the textarea
    $("#phoneNumbers").bind("input", function () {
        validator.element("#phoneNumbers");
    });
});
