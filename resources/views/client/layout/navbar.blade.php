<div class="navbar w-100 fixed-top">
    <div class="ps-3 pe-3 ps-sm-4 ps-md-5 ps-lg-5 ps-xl-5 ps-xxl-5 pe-sm-4 pe-md-5 pe-lg-5 pe-xl-5 pe-xxl-5  w-100 d-flex align-items-center justify-content-between">
        <div class="brand">
            <!-- <div class="menu">
                <i class="fa-light fa-bars" role="button"></i>
            </div> -->
            <div class="ms-3">
               <a href="/" class="fs-17">
                 ProDeel
               </a> 
            </div>
        </div>
        <div class="user-header">
            <form method="get" action="/search" class="search_nav d-none d-xl-flex d-lg-flex d-md-flex d-xxl-flex">
                <input type="text" class="form-control" name="q" placeholder="Search keyword..." />
                <button class="border-0 bg-none">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </button>
            </form>
            <div class="ms-3 ms-md-5 ms-lg-5 ms-xl-5 ms-xxl-5 noti-item" role="button">
                <i class="fa-light fa-bell position-relative">
                    <span class="position-absolute translate-middle border border-light rounded-circle"></span>
                </i>
            </div>
            <div class="ms-3 mode-item">
                <button class="r-mode active" mode="sun" role="button">
                    <i class="fa-light fa-sun-bright"></i>
                </button>
                <button class="r-mode ms-1" mode="moon" role="button">
                    <i class="fa-light fa-moon"></i>
                </button>
                <button class="bg-mode ms-1" data="sun"></button>
            </div>
            <div class="ms-3 user-item">
                <div class="avatar-user" role="button">
                    <img width="30" height="30" class="rounded-circle"
                        src="https://i0.wp.com/thatnhucuocsong.com.vn/wp-content/uploads/2022/03/avatar-nu-nguoi-that-1.jpg?ssl\u003d1" />
                    <span
                        class="position-absolute notify-account translate-middle p-1 rounded-circle">
                    </span>
                </div>
                <div class="dropdown-user" style="display:none">
                    @if(!Auth::check())
                   <a href="/login" class="dropdown-link">Đăng nhập</a>
                   <a href="/register" class="dropdown-link">Đăng ký</a>
                   @else
                   @if(Auth::user()->level == 'admin')
                   <a href="/admin" class="dropdown-link text-danger">
                    Creator Center</a>
                   @endif
                   <a href="/logout" class="dropdown-link">Đăng xuất</a>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>