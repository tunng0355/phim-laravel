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


$(".navbar .brand > .menu").click(function () {
    $(".sidebar").toggleClass("show");
});
$("#more-content").click(function () {
    $(".content-film").addClass("show");
    $("#hidden-content").show();
    $("#more-content").hide();
});

$(document).click(function (e) {
    var sidebar = $(".sidebar, .navbar .brand > .menu");

    if (!sidebar.is(e.target) && sidebar.has(e.target).length === 0) {
        $(".sidebar").removeClass('show');
    }
});

$(function() {
    $('.nav-link[href="'+location.pathname+'"]').addClass('active');
});

$("#hidden-content").click(function () {
    $(".content-film").removeClass("show");
    $("#hidden-content").hide();
    $("#more-content").show();
});


function CurlHttp(url, method = 'GET', data = null, button = null) {
    if (button == null) {
        $.ajax({
            type: method,
            url: url,
            data: data,
            dataType: "json",
            statusCode: {
                403: function () {
                    noti("error", "Đường dẫn API không chính xác");
                },
                404: function () {
                    noti("error", "Đường dẫn API không chính xác");
                },
                500: function () {
                    noti("danger", "500 status code! server error");
                },
            },
            success: (data) => {
                if (!data && data == "undefined") {
                    noti("error", "Không thể lấy dữ liệu");
                } else {
                    if (data.href) {
                        setInterval(() => {
                            window.location.href = data.href;
                        }, 700);
                    }
                    noti(data.status, data.message);
                }
            },
        });
    } else {
        let textButton = button.html().trim();

        $.ajax({
            type: method,
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            statusCode: {
                403: function () {
                    noti("error", "Đường dẫn API không chính xác");
                },
                404: function () {
                    noti("error", "Đường dẫn API không chính xác");
                },
                500: function () {
                    noti("error", "500 status code! server error");
                },
                400: function (response) {
                    let data = JSON.parse(response.responseText);
                    if (!data && data == "undefined") {
                        noti("error", "Không thể lấy dữ liệu");
                    } else {
                        if (data.href) {
                            setInterval(() => {
                                window.location.href = data.href;
                            }, 700);
                        }
                        noti(data.status, data.message);
                    }
                },
                401: function (response) {
                    let data = JSON.parse(response.responseText);
                    if (!data && data == "undefined") {
                        noti("error", "Không thể lấy dữ liệu");
                    } else {
                        if (data.href) {
                            setInterval(() => {
                                window.location.href = data.href;
                            }, 700);
                        }
                        noti(data.status, data.message);
                    }
                }
            },
            beforeSend: function () {
                $("body").append(`<div class="ta-loader"><div role="status" class="spinner-border text-main" style="width: 3.5rem; height: 3.5rem; animation-duration: 0.8s; border-width: 0.35em;"><span class="sr-only">Loading...</span></div></div>`);

                button
                    .prop("disabled", !0)
                    .html('<i class="fas fa-spinner fa-spin"></i> Đang tải...');
            },
            complete: function () {
                button.prop("disabled", !1).html(textButton);
                $(`.ta-loader`).remove();
            },
            success: (data) => {
                if (!data && data == "undefined") {
                    noti("error", "Không thể lấy dữ liệu");
                } else {
                    if (data.href) {
                        setInterval(() => {
                            window.location.href = data.href;
                        }, 700);
                    }
                    noti(data.status, data.message);
                }
            },
        });
    }
}


function noti(status, message, delay = 1500) {

    if (status == 'error') {
        var statuss = 'danger';
        var icon = '<i class="pe-1 fal fa-exclamation-circle"></i>';
    } else {
        var statuss = 'success';
        var icon = '<i class="pe-1 fal fa-check-circle"></i>';
    }

    var date = new Date().getTime();

    if (typeof $(".toast-container").html() === "undefined") {
        $("body").append(
            '<div class="toast-container mt-2 mt-sm-0 position-fixed toast-center p-3 top-0 end-0"></div>');
        $(".toast-container").append(
            `<div role="alert" aria-live="assertive" toasts-id="${date}" data-bs-delay="${delay}" aria-atomic="true" class="toast fade show"><div class="toast-header bg-${statuss}"><h5 class="me-auto m-0 fs-14">${icon} Thông báo</h5> <span data-bs-dismiss="toast" aria-label="Close" class="text-white cursor-pointer"><i class="fa fa-times fw-normal"></i></span></div><div class="toast-body"><span>${message}</span></div></div></div>`
        );
        var load = setInterval(() => {
            clearInterval(load);
            $(`[toasts-id="${date}"]`).remove();
        }, delay)

    } else {
        $(".toast-container").append(
            `<div role="alert" aria-live="assertive" toasts-id="${date}" data-bs-delay="${delay}" aria-atomic="true" class="toast fade show"><div class="toast-header bg-${statuss}"><h5 class="me-auto m-0 fs-14">${icon} Thông báo</h5> <span data-bs-dismiss="toast" aria-label="Close" class="text-white cursor-pointer"><i class="fa fa-times fw-normal"></i></span></div><div class="toast-body"><span>${message}</span></div></div></div>`
        );
        var load = setInterval(() => {
            clearInterval(load);
            $(`[toasts-id="${date}"]`).remove();
            if ($(".toast-container").html() == '') {
                $(".toast-container").remove();
            }
        }, delay)
    }
}

$("form[next]").submit(function (e) {
    e.preventDefault();
    CurlHttp($(this).attr("action"), $(this).attr("method"), new FormData(this), $(this).find('button[type=submit]'));
});