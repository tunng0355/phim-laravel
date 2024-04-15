@extends('client.app')
@section('content')
<div class="mt-3 h-100">
  @if(empty($count))
  <div class="w-100 h-100 d-flex  align-items-center justify-content-between">
      <h2 class="w-100 text-center">Không tìm thấy video nào</h2>
  </div>
  @else
  <div class="row row-cols-2 row-cols-sm-4 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 row-cols-xxl-5 g-4 g-lg-6">
    @foreach($film as $films)
    <div class="col">
      <a href="/phim/{{$films->path}}" class="d-flex flex-column">
        <img src="{{$films->poster}}" class="rounded card-img-top" alt="...">
        <span class="mt-2 fw-500 fs-15">{{$films->name}}</span>
        <p class="mt-1 mb-2 text-gray fs-12 note-film">
          {{$films->note}}        
        </p>
        <p class="mt-0 p-0 fs-13 text-gray">
          <span class="badge text-bg-secondary">{{$films->views}}  Lượt xem</span> 
          · 
          @foreach(explode(",",$films->category) as $category)
          <span class="badge text-bg-orange">{{$category}}</span>
          @endforeach

        </p>
      </a>
    </div>
    @endforeach
  </div>
  @endif
</div>
@section('script')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@if(Session::has("error"))
<script>function noti(status, message, delay = 71500) {if (status == "error") {var statuss = "danger";var icon = '<i class="pe-1 fal fa-exclamation-circle"></i>';} else {var statuss = "success";var icon = '<i class="pe-1 fal fa-check-circle"></i>';}var date = new Date().getTime();if (typeof $(".toast-container").html() === "undefined") {$("body").append('<div class="toast-container mt-2 mt-sm-0 position-fixed toast-center p-3 top-0 end-0"></div>');$(".toast-container").append(`<div role="alert" aria-live="assertive" toasts-id="${date}" data-bs-delay="${delay}" aria-atomic="true" class="toast fade show"><div class="toast-header bg-${statuss}"><h5 class="me-auto m-0 fs-14">${icon} Thông báo</h5> <span data-bs-dismiss="toast" aria-label="Close" class="text-white cursor-pointer"><i class="fa fa-times fw-normal"></i></span></div><div class="toast-body"><span>${message}</span></div></div></div>`);var load = setInterval(() => {clearInterval(load);$(`[toasts-id="${date}"]`).remove();}, delay);} else { $(".toast-container").append(`<div role="alert" aria-live="assertive" toasts-id="${date}" data-bs-delay="${delay}" aria-atomic="true" class="toast fade show"><div class="toast-header bg-${statuss}"><h5 class="me-auto m-0 fs-14">${icon} Thông báo</h5> <span data-bs-dismiss="toast" aria-label="Close" class="text-white cursor-pointer"><i class="fa fa-times fw-normal"></i></span></div><div class="toast-body"><span>${message}</span></div></div></div>`);var load = setInterval(() => {clearInterval(load);$(`[toasts-id="${date}"]`).remove();if ($(".toast-container").html() == "") {$(".toast-container").remove();}}, delay);}} noti("error",'{{Session::get("error")}}')</script>
@endif
@endsection
@endsection