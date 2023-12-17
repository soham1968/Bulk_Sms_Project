var lang;
var emojiCount = 0;
var tuext = [];
var msgCount = 0;
var lastTranslatedWord = "";

$(document).ready(function () {
    $('#language').on('change', function () {
        lang = $(this).val();
        $("#message").keyup(function (e) {
            tuext.push($("#message").val());
            var cursorPos = document.getElementById("message").selectionStart;
            // alert(cursorPos);
            if (e.keyCode === 32) { // spacebar has the keyCode 32
                var targetLanguage = lang;
                var inputLanguage = "en";
                var url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=" + inputLanguage + "&tl=" + targetLanguage + "&dt=t&q=" + encodeURI(tuext[tuext.length - 1]);
                $.ajax({
                    url: url,
                    success: function (result) {
                        var translatedText = result[0][0][0];
                        tuext.push(translatedText + " ")
                        lastTranslatedWord = translatedText;
                        $("#message").val(tuext[tuext.length - 1]);
                        document.getElementById("message").setSelectionRange(cursorPos, cursorPos);
                        console.log(tuext);
                    }
                });

            } if (e.keyCode === 8) { // backspace has the keyCode 8
                var currentText = $("#message").val();
                tuext.push(currentText);
                $("#message").val(tuext[tuext.length - 1]);
            }
        });
    });
    // Emoji Count
    $("#message").keyup(function () {
        var text = $("#message").val();
        emojiCount = text.match(/([\uD800-\uDBFF][\uDC00-\uDFFF])/g) || [];
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
    $("#message").keyup(function () {
        var text = $("#message").val();
        var charCount = text.length;
        $("#char-count").text(charCount);
        if (charCount > 0) {
            var msg = Math.ceil(charCount / msgCount);
            document.getElementById("msg").innerHTML = msg;
        } else {
            document.getElementById("msg").innerHTML = "0";

        }
    });
    $("#formID").submit(function () {
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


    // Translate Button
    $("#translate-btn").click(function () {
        var text = $("#message").val();
        // tuext.push($("#message").val());
        var targetLanguage = lang;
        var inputLanguage = "en";
        var url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=" + inputLanguage + "&tl=" + targetLanguage + "&dt=t&q=" + encodeURI(text);
        $.ajax({
            url: url,
            success: function (result) {
                var text = result[0][0][0];
                $("#message").val(text + " ");

            }
        });
        console.log(text);
    });
});