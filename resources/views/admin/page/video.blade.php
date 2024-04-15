@extends('admin.app')
@section('content')
<div class="ps-3 pt-3 pe-3 pb-3 pe-3">
    <div class="card card-body border-0 p-4" >
        <div class="d-block d-sm-flex align-items-center justify-content-between">
            <div class="fw-500 fs-17">My Videos</div>
            <div class="search_nav mt-3 mt-sm-0 d-flex position-relative">
                <input type="text" class="form-control" oninput="searchItem()" id="search" placeholder="Search keyword..." />
                <button class="border-0 bg-none">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
        @if(empty($count))
        <div class="h-100 d-flex mt-1 align-items-center justify-content-center" style="min-height: 29em">
            No videos yet
        </div>
        @else
        <div class="row row-cols-1 mt-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-2 row-cols-xxl-3 g-5 g-lg-5"
            id="list">
            @foreach($list as $video)
            <div class="col mt-3">
                <div class="d-flex flex-lg-row flex-column">
                    <div class="position-relative">
                        <img src="/{{ $video->thumbnail }}"
                                class="rounded card-img-top img_video" alt="...">
                        <span class="code-id bg-dark">Mã Phim:#{{ $video->idFilm }}</span>
                    </div>
                    <div class="ms-lg-3 mt-lg-0 mt-2">
                        <div class="fw-500 name">{{ App\Models\Film::Where('idFilm','=',$video->idFilm)->first()->name }} 
                            <span class="badge text-bg-blue">{{$video->episode}}</span>
                            <span class="badge text-bg-orange">{{App\Models\Part::Where('idPart','=',$video->idPart)->first()->name}}</span>
                        </div>
                        <p class="mt-4 mb-0">
                            <p class="mt-0 p-0 fs-13 text-gray">
                                <a class="btn w-100 btn-dark fs-13 mb-1 text-white"
                                    href="/admin/{{$video->idVideo}}/edit-video">Chỉnh sửa</a>
                                <a class="btn w-100 btn-danger fs-13 mt-1 text-white"
                                    href="/api/admin/{{$video->idVideo}}/delete-video">Xóa</a>
                            </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
  
        @if($count > 5)
        <div class="d-flex mt-4 justify-content-end">
            @if($ispage != 1)
            <a class="border-0 text-white btn btn-dark m-1 fs-13 fw-500" href="?currentpage={{$ispage - 1}}">
                <i class="fa-regular fa-chevron-left"></i>
            </a>
            @else
            <button class="border-0 text-white btn btn-dark m-1 fs-13 fw-500" disabled>
                <i class="fa-regular fa-chevron-left"></i>
            </button>
            @endif
            @for($x = 1; $x <= $page; $x++) <a
                class="border-0 text-white btn {{ ($ispage == $x) ? 'btn-primary' : 'btn-dark' }} m-1 fs-13 fw-500"
                href="?currentpage={{$x}}">
                {{$x}}
                </a>
                @endfor
                @if($page > $ispage)
                <a class="border-0 text-white btn btn-dark m-1 fs-13 fw-500" href="?currentpage={{$ispage + 1}}">
                    <i class="fa-regular fa-chevron-right"></i>
                </a>
                @else
                <button class="border-0 text-white btn btn-dark m-1 fs-13 fw-500" disabled>
                    <i class="fa-regular fa-chevron-right"></i>
                </button>
                @endif
        </div>
        @endif
        <div class="d-flex justify-content-end mt-3">
            <a href="{{route('admin.upload')}}" class="text-white border-0 btn btn-primary fs-13 fw-500">
                <i class="fa-solid fa-upload"></i>
                <span class="ms-1">Thêm video</span>
            </a>
        </div>
    </div>
</div>
<style>
    .img_video{
        width:17rem
    }
    

@media (max-width: 992px){
    .img_video{
        width: 100%
    }
}
    </style>
<script>
    function searchItem() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('search');
        filter = input.value.toUpperCase();
        div = document.querySelectorAll("#list > .col");

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < div.length; i++) {
            a = div[i].querySelectorAll(".name")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                div[i].style.display = "";
            } else {
                div[i].style.display = "none";
            }
        }
    }
</script>
@endsection