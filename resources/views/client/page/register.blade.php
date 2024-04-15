@extends('client.app')
@section('content')
<div class="mt-5">
    <div class="row">
        <div class="col-xl-4  ps-lg-5 pe-lg-5 offset-xl-4 col-lg-6 offset-lg-3 col-md-6 offset-md-3">
            <div class="card pb-2 ps-3 pe-3 pt-2 border-0">
                <div class="card-body">
                    <h5 class="card-title text-gray">Đăng nhập</h5>
                    <div>
                        <form action="/register" method="POST" >
                            @csrf
                            <div class="form-group text-gray">
                                <label for="" class="fs-13">Họ và Tên:</label>
                                <input type="text" required="required" name="name" class="form-control"style="height:2.5rem">
                            </div>
                            <div class="form-group mt-3 text-gray">
                                <label for=""class="fs-13">Tên đăng nhập:</label>
                                <input type="text" required="required" name="username"  class="form-control"style="height:2.5rem">
                            </div>
                            <div class="form-group mt-3 text-gray">
                                <label for=""class="fs-13">Mật khẩu:</label>
                                <input type="password" required="required" name="password" class="form-control"style="height:2.5rem">
                            </div>
                            <div class="form-group mt-3 text-gray">
                                <label for=""class="fs-13">Nhập lại mật khẩu:</label>
                                <input type="password" required="required" name="re-password" class="form-control"style="height:2.5rem">
                            </div>
                            <button class="fs-13 fw-500 mt-3 btn btn-primary w-100 text-uppercase" style="height:2.5rem" type="submit">Đăng nhập</button> 
                            <span class="d-block text-secondary text-center fs-12 py-2 divider"></span> 
                            <a href="/login" class="text-gray text-center fw-500 d-block fs-14">
                                Bạn đã có tài khoản? <span class="text-primary">Đăng nhập ngay</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    function noti(status, message, delay = 71500) {if (status == "error") {var statuss = "danger";var icon = '<i class="pe-1 fal fa-exclamation-circle"></i>';} else {var statuss = "success";var icon = '<i class="pe-1 fal fa-check-circle"></i>';}var date = new Date().getTime();if (typeof $(".toast-container").html() === "undefined") {$("body").append('<div class="toast-container mt-2 mt-sm-0 position-fixed toast-center p-3 top-0 end-0"></div>');$(".toast-container").append(`<div role="alert" aria-live="assertive" toasts-id="${date}" data-bs-delay="${delay}" aria-atomic="true" class="toast fade show"><div class="toast-header bg-${statuss}"><h5 class="me-auto m-0 fs-14">${icon} Thông báo</h5> <span data-bs-dismiss="toast" aria-label="Close" class="text-white cursor-pointer"><i class="fa fa-times fw-normal"></i></span></div><div class="toast-body"><span>${message}</span></div></div></div>`);var load = setInterval(() => {clearInterval(load);$(`[toasts-id="${date}"]`).remove();}, delay);} else { $(".toast-container").append(`<div role="alert" aria-live="assertive" toasts-id="${date}" data-bs-delay="${delay}" aria-atomic="true" class="toast fade show"><div class="toast-header bg-${statuss}"><h5 class="me-auto m-0 fs-14">${icon} Thông báo</h5> <span data-bs-dismiss="toast" aria-label="Close" class="text-white cursor-pointer"><i class="fa fa-times fw-normal"></i></span></div><div class="toast-body"><span>${message}</span></div></div></div>`);var load = setInterval(() => {clearInterval(load);$(`[toasts-id="${date}"]`).remove();if ($(".toast-container").html() == "") {$(".toast-container").remove();}}, delay);}}
</script>

@if(Session::has("error"))
<script>noti("error",'{{Session::get("error")}}')</script>
@elseif(Session::has("success"))
<script>noti("success",'{{Session::get("success")}}')</script>
@endif

@endsection
@endsection