@extends('client.app')
@section('content')
<div class="mt-0 mt-lg-3 row w-100 m-0">
    <div class="col-lg-9 col mt-0 mt-2 mt-lg-1">
        <div id="player" data-film="{{$film->idFilm}}" class="text-white text-center ">Xin lỗi tập phim này chưa cập nhập </div>
        <div>
            <div class="mt-2 fs-17 fw-500 d-flex align-items-center justify-content-between">
                <span>{{$film->name}}</span>
                <span class="badge text-bg-blue ms-2">Phần 1 / Tập 1</span>
            </div>
            <div class="d-flex mt-2 mb-2 text-gray fs-13 align-items-center justify-content-between">
                <span>{{$film->views}} Lượt xem</span>
                <div class="d-flex align-items-center">
                    @foreach(explode(",",$film->category) as $category)
                    <span class="badge text-bg-secondary ms-1 me-1">{{$category}}</span>
                    @endforeach
                </div>
            </div>
            <div class="mt-2 fs-14 content-film2">
                <p>{{$film->note }} </p>
            </div>
        </div>
    </div>
    <div class="col-lg ">
        <div class="ps-0 pe-0 h-100 ps-sm-0 ps-md-0 ps-lg-2 ps-xl-2 ps-xxl-2 pe-sm-0 pe-md-0 pe-lg-0 pe-xl-0 pe-xxl-0">
            <div class="fw-500 mt-3 mt-lg-0 fs-15">Danh sách phần</div>
            <div class="d-flex flex-wrap mt-1 g-2 w-100">
                <?php $i =0; ?>
                @foreach($part as $parts)
                <div class="p-1 text-center">
                    <?php if(isset(App\Models\Video::where('idFilm',$film->idFilm)->where('idPart',$parts->idPart)->get()->first()->idVideo)): ?>
                    <a href="/phim/{{$film->path}}/{{$parts->idPart}}/<?php echo App\Models\Video::where('idFilm',$film->idFilm)->where('idPart',$parts->idPart)->get()->first()->idVideo; ?>.html" data-part="{{$parts->idPart}}" class="badge <?php echo ($part2->idPart == $parts->idPart) ? "text-bg-primary" : "text-bg-blue";?> ">{{$parts->name}}</a>
                    <?php endif;?>
                </div>
                @endforeach
            </div>
            <div class="fw-500 fs-15 mt-3">Danh sách tập</div>
            <div class="d-flex flex-wrap g-2 w-100 mt-1">
                <?php $x =0; ?>
                @foreach($video2 as $tap)
                <div class="p-1 text-center">

                    @if ($episode != null)
                    <a href="/phim/{{$film->path}}/{{$part2->idPart}}/{{$tap->idVideo}}.html" data-episode="{{$tap->idVideo}}" class="badge {{($episode==$tap->idVideo) ? 'text-bg-primary' :'text-bg-blue'}}">{{$tap->episode}}
                    </a>
                    @else
                    <a href="/phim/{{$film->path}}/{{$part2->idPart}}/{{$tap->idVideo}}.html" data-episode="{{$tap->idVideo}}" class="badge {{ ($x++==0) ? 'text-bg-primary': 'text-bg-blue'}}">{{$tap->episode}}
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="fw-500 fs-15 mt-3">Cốt truyện</div>
            <div class="content-film fs-12 mt-2">
                {!!$film->content!!} 
            </div>
            <div class="text-center mt-1">
                <button class="btn btn-blue w-100 fs-13 fw-500 border-0" id="more-content">Đọc thêm</button>
                <button class="btn btn-blue w-100 fs-13 fw-500 border-0" id="hidden-content" style="display:none">Ẩn nội
                    dung</button>
            </div>
        </div>
    </div>
</div>
<div class="mt-3 pb-lg-0 pb-5 mt-lg-1 row w-100 m-0">
    <div class="col-lg-9 col mt-0 mt-lg-1">
        <div class="ps-0 pe-0 h-100 ps-sm-0 ps-md-0 ps-lg-0 ps-xl-0 ps-xxl-0 pe-sm-0 pe-md-0 pe-lg-0 pe-xl-0 pe-xxl-0">
            <div class="mt-2 fs-15 fw-500 d-flex align-items-center justify-content-between">
                <span>Bình luận</span>
                <div id="myTab" role="tablist" class="d-flex align-items-center">
                    <button class="tab-comment active" id="comment-up-tab" data-bs-toggle="tab"
                        data-bs-target="#comment-up-pane" type="button" role="tab" aria-controls="comment-up-pane"
                        aria-selected="true">Nổi bật nhất</button>
                    <button class="tab-comment" id="comment-new-tab" data-bs-toggle="tab" data-bs-target="#comment-new-pane"
                        type="button" role="tab" aria-controls="comment-new-pane" aria-selected="false">Gần đây</button>
                </div>
            </div>
            <div class="mt-3">
                <div class="w-100 d-flex flex-row align-items-start">
                    <img src="/assets/img/default_avatar.png" class="d-none d-md-flex d-lg-flex" width="43"
                        height="43" />
                    <form class="ms-2 w-100 position-relative" method="POST" comment>
                        @csrf
                        <textarea class="form-control comment w-100 bg-gray" name="content" placeholder="Điền nội dung"></textarea>
                        <button class="border-0 btn btn-blue fs-13 send-comment">GỬI</button>
                    </form>
                </div>
            </div>
            <div class="tab-content mt-4" id="myTabContent">
                <div class="tab-pane fade show active" id="comment-up-pane" role="tabpanel" aria-labelledby="comment-up-tab"
                    tabindex="0">
                    <div class="d-flex flex-column-reverse comment-up">
                    </div>
                </div>
                <div class="tab-pane fade" id="comment-new-pane" role="tabpanel" aria-labelledby="comment-new-tab"
                    tabindex="0">
                    <div class="d-flex flex-column-reverse comment-new">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @media(max-width:575px) {
        .content {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .content-film.show {
            overflow: hidden;
            height: auto;
        }
    }
</style>
@section('script')
<script src="https://ssl.p.jwpcdn.com/player/v/8.26.2/jwplayer.js" type="text/javascript"></script>
<script type="module" src="/build/assets/film-785a5b47.js"></script>
@endsection
@endsection