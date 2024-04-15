/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import "./bootstrap";

import $ from "jquery";
import "jquery.cookie";

if (!!localStorage.getItem("mode-themes")) {
    if (localStorage.getItem("mode-themes") == "dark") {
        $("html").attr("mode", localStorage.getItem("mode-themes"));
        $('.mode-item >.r-mode[mode="sun"]').removeClass("active");
        $('.mode-item >.r-mode[mode="moon"]').addClass("active");
        $(".mode-item >.bg-mode").attr("data", "moon");
    } else {
        $("html").attr("mode", "light");
        $('.mode-item >.r-mode[mode="moon"]').removeClass("active");
        $(".mode-item >.bg-mode").attr("data", "sun");
    }
} else {
    $("html").attr("mode", "light");
    $('.mode-item >.r-mode[mode="moon"]').removeClass("active");
    $('.mode-item >.r-mode[mode="sun"]').addClass("active");
    $(".mode-item >.bg-mode").attr("data", "sun");
}

$(".mode-item >.r-mode").click(function () {

    if ($(this).attr("mode") == "sun") {
        $("html").attr("mode", "light");
        $('.mode-item >.r-mode[mode="sun"]').addClass("active");
        $('.mode-item >.r-mode[mode="moon"]').removeClass("active");
        localStorage.setItem("mode-themes", "light");
    } else {
        $("html").attr("mode", "dark");
        localStorage.setItem("mode-themes", "dark");
        $('.mode-item >.r-mode[mode="sun"]').removeClass("active");
        $('.mode-item >.r-mode[mode="moon"]').addClass("active");
    }

    $(".mode-item >.bg-mode").attr("data", $(this).attr("mode"));
    
});

$("#more-content").click(function () {
    $(".content-film").addClass("show");
    $("#hidden-content").show();
    $("#more-content").hide();
});

$("#hidden-content").click(function () {
    $(".content-film").removeClass("show");
    $("#hidden-content").hide();
    $("#more-content").show();
});


$(".avatar-user").click(function(e){
    $(".dropdown-user").slideToggle(200);
})


