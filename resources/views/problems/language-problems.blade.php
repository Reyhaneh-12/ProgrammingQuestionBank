@extends('layouts.nav-footer')

@section('title')
سوالات یک زبان
@endsection

@section('content')

    <section class=" my-5">
        <div class="container">
            <div class="row border-bottom align-items-baseline">
                <div class="col p-2">
                    <h4>سوالات زبان برنامه نویسی <span dir=ltr>{{$language->name}}</span></h4>
                </div>
            </div>

            @if($problems->count()==0)

            <div class="row my-5 text-center justify-content-center align-items-center">
                <div class="col-sm-10 col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <p class="card-text">سوالی به این زبان طراحی نشده است.</p>
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
                                <p class="card-text">طراح: <a href="{{ route('designer.problems', $problem->user_id ) }}" class="fs-6 text-dark">{{$problem->user->username}}</a></p>
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