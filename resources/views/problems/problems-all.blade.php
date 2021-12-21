@extends('layouts.nav-footer')

@section('title')
همه سوالات
@endsection

@section('content')



<!-- Problem Section -->
<section class="my-5">
    <div class="container">
        <div class="row border-bottom align-items-baseline">
            <div class="col-6 pe-3">
                <h3>سوالات</h3>
            </div>
            <div class="col-6 text-end">
                <div class="dropdown me-2">
                    <i class="bi bi-filter-left icon-orginal fs-2" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a href="{{ route('problems.all') }}" class="dropdown-item">همه سوالات</a></li>
                        @foreach($languages as $language)
                        <li dir="ltr"><a href="{{ route('problem.filter', $language->id) }}" class="dropdown-item text-end">{{$language->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
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
        </div>
    
    </div>
</section>



@endsection