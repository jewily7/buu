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

$(".nav-btn").click(function() {
    if ($(this).html() == "menu") {
        $(this).html("arrow_back");
        $(".nav,.side-menu,.main-container").addClass("act");
    } else {
        $(this).html("menu");
        $(".nav,.side-menu,.main-container").removeClass("act");
    }
});
var days = ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه"];
var schedule_day = document.getElementById("schedule_day");
days.forEach(day => {
    schedule_day.innerHTML += `<option value="${day}">${day}</option>`
});