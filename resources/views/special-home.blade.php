@extends('layouts.nav-footer')

@section('title')
صفحه اصلی
@endsection

@section('content')

<!-- Header Section -->
<section class="mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mt-5 mt-md-0 text-center">
                <h3 class="fw-bold border-bottom pb-2">به وب سایت ما خوش آمدید :)</h3>
                <p class="p-3">
                    دسترسی به بیش از 200 نمونه سوال در زبان‌های برنامه نویسی متفاوت
                </p>
                <a href="#problem-section" class="btn btn-outline-primary">مشاهده سوالات</a>
            </div>
            <div class="col-md-6">
                <img class="img-fluid" src="{{ url('img/img1.png') }}" alt="No Picture">
            </div>
        </div>
    </div>
</section>

<div style="height: 150px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
        <path d="M-10.44,103.13 C149.99,150.00 259.31,30.09 509.31,80.42 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #f8f9fa;"></path>
    </svg>
</div>

<!-- Problem Section -->
<section id="problem-section" class="bg-light">
    <div class="container">
        <div class="row border-bottom align-items-baseline">
            <div class="col-6 pe-3">
                <h3>سوالات</h3>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('problem.add') }}"><i class="bi bi-plus-circle icon-orginal fs-2"></i></a> 
            </div>
        </div>

        <div class="row g-4 py-4">
            @foreach($problems as $problem)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <p class="card-title text-center fw-bolder fs-5 border-bottom pb-2">{{$problem->title}}</p>
                        <p class="card-text">دسته‌بندی: <a href="{{ route('category.problems', $problem->category_id ) }}" class="fs-6 text-dark">{{$problem->category->name}}</a></p>
                        <p class="card-text">زبان برنامه نویسی: <a href="{{ route('language.problems', $problem->language_id ) }}" class="fs-6 text-dark" dir="ltr">{{$problem->language->name}}</a></p>
                        <p class="card-text">طراح: <a href="{{ route('designer.problems', $problem->user_id ) }}" class="fs-6 text-dark">{{$problem->user->username}}</a></p>
                        <p class="card-text">تعداد سوالات: <span class="fs-6">{{$problem->number}}</span></p>
                        <p class="card-text">جزئیات: <small class="text-muted">{{$problem->description}}</small></p>
                    </div>
                    <a href="{{ route('problem.details', $problem->id) }}" class="btn btn-custom btn-custom-card-edit">مشاهده جزئیات و دانلود</a>
                </div>
            </div>
            @endforeach

            <!-- FOR FILTER ON PROBLEMS -->

        </div>

        <div class="row text-end">
            <div class="col">
                <a href="{{ route('problems.all') }}" class="btn btn-outline-primary mt-4">همه سوالات</a>
            </div>
        </div>
    </div>
</section>

<div style="height: 100px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
        <path d="M-21.16,55.75 C152.09,185.03 295.43,-3.45 500.84,78.45 L500.00,0.00 L0.00,0.00 Z" style="stroke: none; fill: #F8F9FA;"></path>
    </svg>
</div>

<!-- Programming Environment Section -->
<section id="environment">
    <div class="container">
        <div class="row text-center">
            <h4 class="fw-bold pb-3 border-bottom">معرفی چند نمونه از محیط های برنامه نویسی محبوب</h4>
        </div>

        <div class="row align-items-center g-3 mt-2">
            <div class="col-md-4">
                <div class="card shadow text-center h-100">
                    <img src="{{ url('img/Visual-Studio.png') }}" class="card-img-top" alt="Visual Studio">
                    <div class="card-body">
                        <p class="card-title fw-bold mb-4">Visual Studio</p>
                        <p class="card-text text-muted">قیمت: رایگان</p>
                        <p class="card-text text-muted">بسترهای مورد استفاده: ویندوز، لینوکس، macOS</p>
                        <p class="card-text text-muted">Visual Studio یکی از بهترین محیط‌های برنامه‌نویسی در جهان است که قادر به ایجاد برنامه‌های موبایل، برنامه‌های وب و یا حتی بازی‌های ویدیویی است این ابزار از 36 زبان برنامه‌نویسی مختلف مانند C++، C#، JavaScript و ... پشتیبانی می‌کند.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow text-center bg-dark-blue h-100">
                    <img src="{{ url('img/Android-Studio.png') }}" class="card-img-top" alt="Android Studio">
                    <div class="card-body">
                        <p class="card-title fw-bold mb-4">Android Studio</p>
                        <p class="card-text">قیمت: رایگان</p>
                        <p class="card-text ">بسترهای مورد استفاده: ویندوز، لینوکس، macOS</p>
                        <p class="card-text ">Android Studio یکی از بهترین انتخاب‌ها برای برنامه نویسان و توسعه دهندگان پلتفرم اندروید است. زیرا قابلیت‌های مختلفی از جمله خطایابی هوشمند، طراحی رابط کاربری اپلیکیشن، شبیه سازی نرم افزار‌های اندروید و… را در اختیار برنامه نویسان قرار می‌دهد.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow text-center h-100">
                    <img src="{{ url('img/PyCharm.png') }}" class="card-img-top" alt="PyCharm">
                    <div class="card-body">
                        <p class="card-title fw-bold mb-4">PyCharm</p>
                        <p class="card-text text-muted">قیمت: رایگان</p>
                        <p class="card-text text-muted">بسترهای مورد استفاده: ویندوز، لینوکس، macOS</p>
                        <p class="card-text text-muted">PyCharm یکی از محبوب‌ترین محیط‌های توسعه کدنویسی برای زبان Python است. این ابزار از بیشتر فناوری‌های وب از جمله Flask، Django و همچنین از تکنولوژی زبان‌های برنامه نویسی Python, javascript, TypeScript, HTML/CSS به صورت کامل پشتیبانی می‌کند.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<div style="height: 150px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
        <path d="M-10.44,103.13 C149.99,150.00 259.31,30.09 509.31,80.42 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #1a2b4e;"></path>
    </svg>
</div>

<!-- Favorite Language Problem Section -->
<section id="favorite" class="bg-dark-blue">
    <div class="container ">
        <div class="row text-center">
            <h4 class="fw-bold border-bottom pb-3">دسترسی سریع به سوالات چند زبان پرطرفدار</h4>
        </div>
        <div class="row py-5 justify-content-center">
            <div class="col-10 col-md-8">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ url('img/C-PlusPlus.png') }}" class="d-block w-100" alt="C Plus Plus">
                            <div class="carousel-caption pb-4 d-md-block">
                                <a href="{{ route('language.problems', 3 ) }}" class="fs-2 text-white">مشاهده سوالات</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ url('img/Python.png') }}" class="d-block w-100" alt="Python">
                            <div class="carousel-caption pb-4 d-md-block">
                                <a href="{{ route('language.problems', 4 ) }}" class="fs-2 text-white">مشاهده سوالات</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ url('img/C-Sharp.png') }}" class="d-block w-100" alt="C Sharp">
                            <div class="carousel-caption pb-4 d-md-block">
                                <a href="{{ route('language.problems', 1 ) }}" class="fs-2 text-white">مشاهده سوالات</a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>

<div style="height: 100px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
        <path d="M-21.16,55.75 C284.14,116.94 286.39,86.34 548.24,61.67 L500.00,0.00 L0.00,0.00 Z" style="stroke: none; fill: #1a2b4e;"></path>
    </svg>
</div>

<!-- Comment Section -->
<section>
    <div class="container">
        <div class="row text-center">
            <h4 class="fw-bold mb-5">نظرات کاربران</h4>
        </div>
        <div class="row p-4">
            <div class="col">
            @foreach($comments as $comment)
                <div class="mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h6 class="card-title border-bottom p-1 fw-bold">{{$comment->user->username}}</h6>
                            <p class="card-text">{{$comment->message}}</p>
                            @Auth
                                @if(Auth::user()->role_id==1)
                                <div class="text-end pe-3">
                                    <a href="{{ route('comment.reply', $comment->id ) }}" class="card-link"><i class="bi bi-reply fs-5"></i> پاسخ</a>
                                </div>
                                @endif
                            @endAuth
                        </div>
                    </div>
                    
                    @if($comment->reply!=NULL)
                    <div class="card shadow ms-5 my-1">
                        <div class="card-body">
                            <h6 class="card-title border-bottom p-1 fw-bold">پاسخ:</h6>
                            <p class="card-text">{{$comment->reply}}</p>
                            @Auth
                                @if(Auth::user()->role_id==1)
                                <div class="text-end pe-3">
                                    <a href="{{ route('reply.edit', $comment->id ) }}" class="card-link"><i class="bi bi-pencil-square fs-5"></i> ویرایش پاسخ</a>
                                </div>
                                @endif
                            @endAuth
                        </div>
                    </div>
                    @endif

                </div>
            @endforeach
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-5">

                @include('layouts.message')

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form action="{{ route('comment.save') }}" method="POST">
                    @csrf
                    <div class="my-5">
                        <label for="message" class="form-label">متن پیام</label>
                        <textarea type="text" name="message" class="form-control" id="message"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">ارسال پیام</button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 offset-md-2">
                <img class="img-fluid" src="{{ url('img/img2.png') }}" alt="" off>
            </div>
        </div>
    </div>
</section>

@endsection