<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to the first site" />
    <meta name="keywords" content="HTML, CSS, PHP, developer" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}">

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse order-2 order-md-1" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                            @if(Auth::user()->role_id==1)
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('adminhome') }}">صفحه اصلی</a>
                            </li>
                            @elseif(Auth::user()->role_id==2)
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('specialhome') }}">صفحه اصلی</a>
                            </li>
                            @elseif(Auth::user()->role_id==3)
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('normalhome') }}">صفحه اصلی</a>
                            </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('publichome') }}">صفحه اصلی</a>
                        </li>
                        @endauth
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('designers') }}">طراحان</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('download.problems') }}">دانلود سوالات</a>
                        </li>
                        @auth
                            @if(Auth::user()->role_id!=3)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('problem.add') }}">افزودن سوال</a>
                            </li>
                            @endif
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link" href="#about-us">درباره ما</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact-with-us">ارتباط با ما</a>
                        </li>
                    </ul>
                </div>

                <!-- Edit place dropdown menu -->
                <div class="dropdown order-1 order-md-2 me-2">
                    <i class="bi bi-person-circle icon-orginal fs-2" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @auth
                        <li><a class="dropdown-item" href="{{ route('profile') }}">صفحه شخصی</a></li>
                        @if(Auth::user()->role_id==1)
                        <li><a class="dropdown-item" href="{{ route('admin.index') }}" target="_blank">پنل مدیریتی ادمین</a></li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                                @csrf
                                <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">خروج</a>
                            </form>
                        </li>

                        @else

                        <li><a class="dropdown-item" href="{{ route('register') }}">ثبت نام</a></li>
                        <li><a class="dropdown-item" href="{{ route('login') }}">ورود</a></li>
                        
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')


    <div style="height: 100px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
            <path d="M-28.49,52.78 C248.02,106.08 276.24,98.19 513.26,57.72 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #f8f9fa;"></path>
        </svg>
    </div>

    <footer class="bg-light py-4">
        <div class="container">
            <div class="row g-4">
                <div id="about-us" class="col-xl-5 col-lg-5">
                    <h5 class="fw-bold footer-header pb-3 ps-2">درباره ما</h5>
                    <p class="pt-1">
                        ما در این وب سایت سعی بر آن کردیم که سوالات برنامه نویسی در زبان‌های متفاوت را جمع‌آوری کرده 
                        تا شما بتوانید به راحتی به آن‌ها دسترسی داشته باشید.
                    </p>
                    <p>
                        علاوه بر آن، چند محیط برنامه‌نویسی محبوب برای زبان‌های متفاوت را معرفی کردیم تا بتوانید
                         تجربه بهتری از کد زدن داشته باشید :)
                    </p>
                    
                </div>
                <div class="col-xl-6 col-lg-7 ps-lg-4 offset-xl-1">
                    <div class="row">
                        <div class="col-sm-6 col-lg-6 col-xl-6 mb-4">
                            <h5 class="fw-bold footer-header w-85 pb-3 ps-2">بخش های وبسایت</h5>
                            <ul class="list-unstyled">
                                <li class="my-2"><a class="footer-link" href="#">همه سوالات</a></li>
                                <li><a class="footer-link my-3" href="{{ route('designers') }}">طراحان</a></li>
                                @auth
                                <li class="my-2"><a class="footer-link" href="{{route('profile')}}">صفحه شخصی</a></li>
                                <li><a class="footer-link mt-3" href="#"></a></li>
                                @endauth
                            </ul>
                        </div>
                        <div id="contact-with-us" class="col-sm-6 col-lg-6 col-xl-6 mb-4">
                            <h5 class="fw-bold footer-header w-85 pb-3 ps-2">تماس با ما</h5>
                            <ul class="list-unstyled ps-lg-1 me-md-3 me-sm-2 me-4" dir="ltr">
                                <li class="bi bi-envelope my-2"><a class="footer-link" href="#"> admin@gmail.com</a></li>
                                <li class="bi bi-telegram"><a class="footer-link" href="#"> t.me/admin_1</a></li>
                                <li class="bi bi-telephone my-2"><a class="footer-link" href="#"> 0916*******</a></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>