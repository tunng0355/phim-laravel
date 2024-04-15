<!DOCTYPE html>
<html lang="vi" mode="light">
<head>
    @include('client.layout.head')
    @yield('head')
</head>

<body>
    @include('client.layout.navbar')    
    @include('client.layout.sidebar')
    <div class="ps-3 pe-3 h-100 ps-sm-4 ps-md-5 ps-lg-5 ps-xl-5 ps-xxl-5 pe-sm-4 pe-md-5 pe-lg-5 pe-xl-5 pe-xxl-5 content">
	  @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    @include('client.layout.script')
    @yield('script')
</body>
</html>