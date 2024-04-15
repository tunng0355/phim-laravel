@extends('client.app')
@section('content')
<div class="mt-3 h-100">
    <div class="row">
        <div class="col-lg-5 info-container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thông tin cá nhân</h5>
                    <form action="">
                        <div class="form-group">
                            <label for="">Ảnh đại diện:</label>
                            <input type="file" accept="image/*" class="d-none">
                            <div class="avatar-profile">
                                <div class="d-inline-block position-relative">
                                    <div class="update text-center w-auto text-white fs-12 cursor-pointer">
                                        Sửa
                                    </div> <img height="90" alt="" class="rounded ta-lz-load ta-lz-loaded" src="https://cdn.trumacc.vn/uploads/avatar/2023/08/94138ca6c423adef9d49fc18a567fd05.jpg">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Tài khoản:</label>
                            <input type="text" class="form-control">
                            <p class="help-block">* Đổi tên người dùng tối đa <b>1</b> lần.</p>
                        </div>
                        <div class="form-group">
                            <label for="">Email:</label>
                            <input type="email" disabled="disabled" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Họ và tên:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tham gia:</label>
                            <p class="fw-normal fs-14">vài giây trước</p>
                        </div>
                        <button class="ta-submit btn btn-main w-100">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection