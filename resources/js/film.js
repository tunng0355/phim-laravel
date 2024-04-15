import $ from "jquery";

jwplayer.key = "W7zSm81+mmIsg7F+fyHRKhF3ggLkTqtGMhvI92kbqf/ysE99";



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

$("form[comment]").submit(function (e) {
    e.preventDefault();

    $.ajax({
        type: $(this).attr("method"),
        url: `/api/${$("[data-episode]").attr("data-episode")}/comment`,
        data: $(this).serialize(),
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
        success: (data) => {
            if (!data && data == "undefined") {
                noti("error", "Không thể lấy dữ liệu");
            } else {
                if (data.href) {
                    setInterval(() => {
                        window.location.href = data.href;
                    }, 700);
                }
                if(data.status == "success"){
                    $(".comment-up").append(`<div class="w-100 d-flex flex-row mb-4 align-items-start">
                    <img src="/assets/img/default_avatar.png" width="43" height="43">
                    <div class="ms-2 d-flex flex-column">
                        <div class="text-gray d-flex fs-13">
                            <span class="fw-500">${data.comment.name}</span>
                            <span class="ms-2">vừa xong</span>
                        </div>
                        <div class="fs-13 mt-1">
                        ${data.comment.comment}
                        </div>
                    </div>
                </div>`);
                $(".comment-new").append(`<div class="w-100 d-flex flex-row mb-4 align-items-start">
                <img src="/assets/img/default_avatar.png" width="43" height="43">
                <div class="ms-2 d-flex flex-column">
                    <div class="text-gray d-flex fs-13">
                        <span class="fw-500">${data.comment.name}</span>
                        <span class="ms-2">vừa xong</span>
                    </div>
                    <div class="fs-13 mt-1">
                    ${data.comment.comment}
                    </div>
                </div>
            </div>`);
                }
                noti(data.status, data.message);
            }
        },
    });
});

$(function () {
    
    $.ajax({
        type: "GET",
        url: `/api/${$("[data-episode]").attr("data-episode")}/get-comment`,
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
        success: (data) => {
            if (!data && data == "undefined") {
                noti("error", "Không thể lấy dữ liệu");
            } else {
                if (data.href) {
                    setInterval(() => {
                        window.location.href = data.href;
                    }, 700);
                }
                if(data.status == "success"){
                    $(".comment-up").html('');
                    $(".comment-new").html('');
                    data.comment.forEach(element => {
                             $(".comment-new").append(`<div class="w-100 d-flex flex-row mb-4 align-items-start">
                    <img src="/assets/img/default_avatar.png" width="43" height="43">
                    <div class="ms-2 d-flex flex-column">
                        <div class="text-gray d-flex fs-13">
                            <span class="fw-500">${element.name}</span>
                            <span class="ms-2">${element.date}</span>
                        </div>
                        <div class="fs-13 mt-1">
                        ${element.comment}
                        </div>
                    </div>
                </div>`);  
                $(".comment-up").append(`<div class="w-100 d-flex flex-row mb-4 align-items-start">
                <img src="/assets/img/default_avatar.png" width="43" height="43">
                <div class="ms-2 d-flex flex-column">
                    <div class="text-gray d-flex fs-13">
                        <span class="fw-500">${element.name}</span>
                        <span class="ms-2">${element.date}</span>
                    </div>
                    <div class="fs-13 mt-1">
                    ${element.comment}
                    </div>
                </div>
            </div>`);  
                    });
             
                }
            }
        },
    });

    $.ajax({
        type: "POST",
        url: `/api/${$("[data-film]").attr("data-film")}/get-video`,
        data: {
            idPart: $(".text-bg-primary[data-part]").attr("data-part"),
            episode: $(".text-bg-primary[data-episode]").attr("data-episode"),
            _token: $('[name="_token"]').val(),
        },
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
                if (data.status != "success") {
                    noti(data.status, data.message);
                } else {
                    var playerInstance = jwplayer("player");
                    playerInstance
                        .setup({
                            autostart: "viewable",
                            mute: false,
                            allowfullscreen: true,
                            playbackRateControls: true,
                            preload: "auto",
                            primary: "html5",
                            responsive: true,
                            width: "100%",
                            aspectratio: "16:9",
                            aboutlink: "https://zalo.me/0986379490",
                            abouttext: "TUNGMMO",
                            "image": '/'+`${data.message.thumbnail}`,
                            cast: {},
                            logo: {
                                // file: "/assets/img/logo.png",
                                link: "https://zalo.me/0986379490",
                                hide: "true",
                                position: "top-left",
                            },
                            captions: {
                                color: "#ffffff",
                                fontSize: 15,
                                fontfamily: "Arial",
                                edgeStyle: "raised",
                            },
                            skin: {
                                name: "TUNGMMO",
                            },
                            file: `/${data.message.media}`,
                        })
                        .on("time", function (e) {
                            // $(this).currentTime(10);
                        });
                }
            }
        },
    });
});
