<!DOCTYPE html>
<html lang="vi" mode="light">
<head>
    @include('admin.layout.head')
    @yield('head')
</head>

<body>
    @include('admin.layout.navbar')    
    @include('admin.layout.sidebar')
    <div class="content">
	  @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    @include('admin.layout.script')
    @yield('script')
</body>
</html>