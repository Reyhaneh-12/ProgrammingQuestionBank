@extends('layouts.nav-footer')

@section('title')
صفحه اصلی
@endsection

@section('content')

    <section class=" my-5">
        <div class="container">
            <div class="row border-bottom justify-content-center align-items-baseline">
                <div class="col">
                    <h4>لیست طراحان</h4>
                </div>
            </div>


            <div class="row g-4 mt-2">

                    @foreach($users as $user)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <p class="card-title text-center fw-bolder fs-5 border-bottom pb-2">{{$user->username}}</p>
                                <p class="card-text pt-2 pb-0">ایمیل:</p>
                                <p class="card-text text-end pt-0" dir="ltr">{{$user->email}}</p>
                            </div>
                            <a href="{{ route('designer.problems', $user->id ) }}" class="btn btn-custom btn-custom-card-edit">مشاهده سوالات طراح</a>
                        </div>
                    </div>
                    @endforeach

            </div>
            <!-- end row problems -->

        </div>
    </section>

@endsection