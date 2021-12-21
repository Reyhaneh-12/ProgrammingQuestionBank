@extends('layouts.nav-footer')

@section('title')
سوالات طراح
@endsection

@section('content')

    <section class=" my-5">
        <div class="container">
            <div class="row border-bottom text-center align-items-baseline">
                <div class="col">
                    <h4>سوالات طراح <span>{{$user->username}}</span></h4>
                </div>
            </div>


            @if($problems->count()==0)

            <div class="row my-5 text-center justify-content-center align-items-center">
                <div class="col-sm-10 col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <p class="card-text">کاربر <span>{{$user->username}}</span> تا به حال سوالی طرح نکرده است!</p>
                        </div>
                    </div>
                </div>
            </div>

            @else

            <div class="row g-4 mt-2">
                @foreach($problems as $problem)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <p class="card-title text-center fw-bolder fs-5 border-bottom pb-2">{{$problem->title}}</p>
                            <p class="card-text">دسته‌بندی: <a href="{{ route('category.problems', $problem->category_id ) }}" class="fs-6 text-dark">{{$problem->category->name}}</a></p>
                            <p class="card-text">زبان برنامه نویسی: <a href="{{ route('language.problems', $problem->language_id ) }}" class="fs-6 text-dark" dir="ltr">{{$problem->language->name}}</a></p>
                            <p class="card-text">تعداد سوالات: <span class="fs-6">{{$problem->number}}</span></p>
                            <p class="card-text">جزئیات: <small class="text-muted">{{$problem->description}}</small></p>
                        </div>
                        <a href="{{ route('problem.details', $problem->id) }}" class="btn btn-custom btn-custom-card-edit">مشاهده جزئیات و دانلود</a>
                    </div>
                </div>
                @endforeach
            </div>

            @endif

           

        </div>
    </section>


@endsection