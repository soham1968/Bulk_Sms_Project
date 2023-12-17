var lang;
var emojiCount = 0;
var tuext = [];
var msgCount = 0;
var lastTranslatedWord = "";

$(document).ready(function () {
    $('#language').on('change', function () {
        lang = $(this).val();
        $("#message").keyup(function (e) {
            var aple = ($("#message").val());

            if (e.keyCode === 32) { // spacebar has the keyCode 32
                tuext.push($("#message").val());
                // var multipleSpaces = /\s{2,}/;
                // if (!multipleSpaces.test(tuext[tuext.length - 1])) {
                var targetLanguage = lang;
                var inputLanguage = "en";
                if (tuext[tuext.length - 1] != " ") {
                    var url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=" + inputLanguage + "&tl=" + targetLanguage + "&dt=t&q=" + encodeURI(tuext[tuext.length - 1]);
                    $.ajax({
                        url: url,
                        success: function (result) {
                            var translatedText = result[0][0][0];
                            tuext.push(translatedText + " ")
                            lastTranslatedWord = translatedText;
                            $("#message").val(tuext[tuext.length - 1]);
                        }
                    });
                }

                console.log(tuext);
                console.log(tuext[tuext.length - 1]);
                // }
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
                // var currentText = $("#message").val();
                var text = result[0][0][0];
                // tuext += " " + result[0][0][0];
                $("#message").val(text + " ");
            }
        });
        console.log(text);
    });


});