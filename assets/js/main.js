// @ts-nocheck
var date = document.querySelectorAll("#inp-date");
date.forEach((e) => {
    $(e).persianDatepicker()
});

$(".eye").click(function(e) {
    if ($(this).html() == "visibility") {
        $(this).html("visibility_off");
        $("#password").prop("type", "text");
    } else {
        $(this).html("visibility");
        $("#password").prop("type", "password");
    }
});