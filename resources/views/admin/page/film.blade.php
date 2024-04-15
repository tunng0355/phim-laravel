@extends('admin.app')
@section('content')
<div class="ps-3 pt-3 pe-3 pb-3 pe-3">
    <div class="card card-body border-0 p-4">
        <div class="d-block d-sm-flex align-items-center justify-content-between">
            <div class="fw-500 fs-17">Playlists</div>
            <div class="search_nav mt-3 mt-sm-0 d-flex position-relative">
                <input type="text" oninput="searchItem()" id="search" class="form-control w-mobile-100"
                    placeholder="Search keyword..." />
                <button class="border-0 bg-none">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </button>
            </div>

        </div>
        <div class="d-flex mt-4 justify-content-end">
            <button class="border-0 btn btn-primary w-sm-auto w-100 fs-13 fw-500" data-bs-toggle="modal"
                data-bs-target="#create_playlist">
                <i class="fa-regular fa-plus"></i>
                <span class="ms-1">Create Playlist</span>
            </button>
        </div>
        @if(empty($count))
        <div class="h-100 d-flex mt-1 align-items-center justify-content-center" style="min-height: 29em">
            No playlist yet
        </div>
        @else
        <div class="row row-cols-1 mt-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-4 g-lg-3"
            id="list">
            @foreach($list as $film)
            <div class="col">
                <div class="d-flex flex-column">
                    <a href="/admin/part/{{ $film->idFilm }}">
                        <div class="position-relative">
                            <img src="https://lumiere-a.akamaihd.net/v1/images/p_onward_19732_09862641.jpeg"
                                class="rounded card-img-top" alt="...">
                            <span class="code-id bg-dark">Mã Phim:#{{ $film->idFilm }}</span>
                        </div>
                        <span class="mt-2 fw-500 fs-15">Phim: {{ $film->name }}</span>
                        <p class="mt-1 mb-2 text-gray fs-12 note-film">
                            {{ $film->note }}
                        </p>
                    </a>
                    <p class="mt-0 p-0 fs-13 text-gray">
                        <a class="btn w-100 btn-dark fs-13 mb-1 text-white"
                            href="/admin/{{$film->idFilm}}/edit-album">Chỉnh sửa</a>
                        <a class="btn w-100 btn-danger fs-13 mt-1 text-white"
                            href="/api/admin/{{$film->idFilm}}/delete-album">Xóa</a>
                    </p>
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
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="create_playlist" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-17" id="create_playlistLabel">Tạo danh sách phát</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('api.admin.create_album')}}" next>
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fs-13">Tên phim</label>
                        <input type="text" name="name" class="form-control fs-13" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="poster" class="form-label fs-13">Url Poster</label>
                        <input type="text" name="poster" class="form-control fs-13" id="poster">
                    </div>
                    <div class="mb-3">
                        <label for="path" class="form-label fs-13">Đường dẫn</label>
                        <input type="text" name="path" class="form-control fs-13" id="path">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label fs-13">Thể loại (tag1,tag2,tag3)</label>
                        <input type="text" name="category" class="form-control fs-13" id="category">
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label fs-13">Nội dung ngắn</label>
                        <textarea class="form-control" name="note" id="note" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label fs-13">Cốt truyện</label>
                        <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                    </div>
                    <button type="submit" style="height: 2.3rem;" class="btn mt-3 w-100 fs-13 btn-primary">Tạo danh sách
                        phát</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    function searchItem() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('search');
        filter = input.value.toUpperCase();
        div = document.querySelectorAll("#list > .col");

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < div.length; i++) {
            a = div[i].getElementsByTagName("a")[0];
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
@endsection