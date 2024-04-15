@extends('admin.app')
@section('content')
<div class="ps-3 pt-3 pe-3 pb-3 pe-3">
    <div class="card card-body border-0 p-4">
        <div class="d-block d-sm-flex align-items-center justify-content-between">
            <a href="/admin/danh-sach-phat" class="d-flex align-items-center">
                <div class="d-flex align-items-center"><i class="fa-regular fa-chevron-left fs-17"></i></div>
                <div class="fw-500 ms-2 fs-16">Quay lại</div>
            </a>
        </div>
        <div class="mt-3">
            <form method="POST" action="/api/admin/{{$film->idFilm}}/edit-album" next>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fs-13">Tên phim</label>
                    <input type="text" name="name" value="{{ $film->name}}" class="form-control fs-13" id="name">
                </div>
                <div class="mb-3">
                    <label for="poster" class="form-label fs-13">Url Poster</label>
                    <input type="text" name="poster" value="{{ $film->poster}}" class="form-control fs-13" id="poster">
                </div>
                <div class="mb-3">
                    <label for="path" class="form-label fs-13">Đường dẫn</label>
                    <input type="text" name="path" value="{{ $film->path}}" class="form-control fs-13" id="path">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label fs-13">Thể loại (tag1,tag2,tag3)</label>
                    <input type="text" name="category" value="{{ $film->category}}" class="form-control fs-13" id="category">
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label fs-13">Nội dung ngắn</label>
                    <textarea class="form-control" name="note" id="note" rows="3">{{ $film->note}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label fs-13">Cốt truyện</label>
                    <textarea class="form-control" name="content" id="content" rows="3">{{ $film->content}}</textarea>
                </div>
                <button type="submit" style="height: 2.3rem;" class="btn mt-3 w-100 fs-13 btn-primary">Cập nhập thông tin</button>
            </form>
        </div>


    </div>
</div>
@endsection