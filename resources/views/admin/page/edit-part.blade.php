@extends('admin.app')
@section('content')
<div class="ps-3 pt-3 pe-3 pb-3 pe-3">
    <div class="card card-body border-0 p-4">
        <div class="d-block d-sm-flex align-items-center justify-content-between">
            <a href="/admin/part/{{$part->idFilm}}" class="d-flex align-items-center">
                <div class="d-flex align-items-center"><i class="fa-regular fa-chevron-left fs-17"></i></div>
                <div class="fw-500 ms-2 fs-16">Quay lại</div>
            </a>
        </div>
        <div class="mt-3">
            <form method="POST" action="/api/admin/{{$part->idFilm}}/{{$part->idPart}}/edit-part" next>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fs-13">Tên phần</label>
                    <input type="text" name="name" value="{{ $part->name}}" class="form-control fs-13" id="name">
                </div>
                <button type="submit" style="height: 2.3rem;" class="btn mt-3 w-100 fs-13 btn-primary">Cập nhập thông tin</button>
            </form>
        </div>


    </div>
</div>
@endsection