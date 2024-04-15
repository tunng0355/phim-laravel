@extends('admin.app')
@section('content')
<div class="ps-3 pt-3 pe-3 pb-3 pe-3">
    <div class="card card-body border-0 p-4">
        <div class="d-block d-sm-flex align-items-center justify-content-between">
            <a href="{{route('admin.video')}}" class="d-flex align-items-center">
                <div class="d-flex align-items-center"><i class="fa-regular fa-chevron-left fs-17"></i></div>
                <div class="fw-500 ms-2 fs-16">Quay lại</div>
            </a>
        </div>

        <div class="mt-3">            
            <form method="POST" action="{{route('api.admin.add_video')}}" enctype="multipart/form-data" next>
                @csrf
                <div class="mb-3">
                    <label for="episode" class="form-label fs-13">Tập phim</label>
                    <input type="text" name="episode" class="form-control fs-13" id="episode">
                </div>
                <div class="mb-3">
                    <label for="idFilm" class="form-label fs-13">Mã phim</label>
                    <input type="text" name="idFilm" class="form-control fs-13" oninput="loadPart()" id="idFilm">
                </div>
                <div class="mb-3">
                    <label for="idPart" class="form-label fs-13">phần phim</label>
                    <select class="form-control" aria-label="Default select example" name="idPart" id="part">
                    </select>
                </div>
                <div class="mb-3">
                    <label for="thumbnail" class="form-label fs-13">Thumbnail</label>
                    <br/>
                    <input type="file" name="thumbnail" class="form-control fs-13" id="thumbnail">
                </div>
                <div class="mb-3">
                    <label for="media" class="form-label fs-13">media</label>
                    <br/>
                    <input class="form-control" type="file" name="media" >             
                </div>
                <button type="submit" style="height: 2.3rem;" class="btn mt-3 w-100 fs-13 btn-primary">Thêm
                    video</button>
            </form>
        </div>

    </div>
</div>

@section('script')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const loadPart = async () => {
        const idFilm = $("#idFilm").val();
        customConfig = {
            headers: {
                'Content-Type': 'application/json'
            }
        };
        const result = await axios.get(`/api/admin/${idFilm}/list-part`);

        $('select#part').html(result.data);
    }
</script>
@endsection
@endsection