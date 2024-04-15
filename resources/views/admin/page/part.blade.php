@extends('admin.app')
@section('content')
<div class="ps-3 pt-3 pe-3 pb-3 pe-3">
    <div class="card card-body border-0 p-4">
        <div class="d-block d-sm-flex align-items-center justify-content-between">
            <a href="/admin/danh-sach-phat" class="d-flex align-items-center">
                <div class="d-flex align-items-center"><i class="fa-regular fa-chevron-left fs-17"></i></div>
                <div class="fw-500 ms-2 fs-16">Quay lại</div>
            </a>
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
                data-bs-target="#create_part">
                <i class="fa-regular fa-plus"></i>
                <span class="ms-1">Thêm phần</span>
            </button>
        </div>
        @if(empty($count))
        <div class="h-100 d-flex align-items-center justify-content-center" style="min-height: 29em">
            No part yet
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên phim</th>
                        <th scope="col">Tên phần</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $part)
                    <tr>
                        <th scope="row">{{$part->idPart}}</th>
                        <td>{{$film->name}}</td>
                        <td>{{$part->name}}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="/admin/part/{{$part->idFilm}}/{{$part->idPart}}/edit-part" class="btn w-100 text-white btn-dark fs-13">Chỉnh sửa</a>
                                <a href="/api/admin/{{$part->idFilm}}/{{$part->idPart}}/delete-part" class="btn w-100 btn-danger text-white fs-13 ms-2">Xóa</a>
                            </div>
                        </td>
                    </tr>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
<div class="modal fade" id="create_part" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-17" id="create_partLabel">Thêm phần</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/api/admin/{{$film->idFilm}}/create-part" next>
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fs-13">Tên phần</label>
                        <input type="text" name="name" class="form-control fs-13" id="name">
                    </div>
                    <button type="submit" style="height: 2.3rem;" class="btn mt-3 w-100 fs-13 btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection