@extends('admin.app')
@section('content')
<div class="mt-3 h-100 ps-4 pe-4">
    @if(empty($count))
    <div class="w-100 h-100 d-flex  align-items-center justify-content-between">
        <h2 class="w-100 text-center text-gray">Không tìm thấy video nào</h2>
    </div>
    @else
    <div class="row row-cols-2 row-cols-sm-4 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 row-cols-xxl-5 g-4 g-lg-6">
      @foreach($film as $films)
      <div class="col">
        <a href="/phim/{{$films->path}}" class="d-flex flex-column">
          <img src="{{$films->poster}}" class="rounded card-img-top" alt="...">
          <span class="mt-2 fw-500 fs-15 text-gray">{{$films->name}}</span>
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

@endsection