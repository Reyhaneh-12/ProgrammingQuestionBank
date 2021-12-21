@extends('layouts.nav-footer')

@section('title')
جزئیات سوال
@endsection

@section('content')

    <section class=" my-5">
        <div class="container">
            <div class="row text-center align-items-baseline">
                <div class="col pt-2">
                    <h4>{{$problem->title}}</h4>
                    <hr class="bottom-line">
                </div>
            </div>


            <div class="row mt-3">
                <div class="d-flex justify-content-between text-muted">
                    <small class="card-text">دسته‌بندی: <a href="{{ route('category.problems', $problem->category_id ) }}" class="fs-6 text-muted">{{$problem->category->name}}</a></small>
                    <small>زبان برنامه نویسی: <a href="{{ route('language.problems', $problem->language_id ) }}" class="fs-6 text-muted" dir="ltr">{{$problem->language->name}}</a></small>
                    <small>طراح: <a href="{{ route('designer.problems', $problem->user_id ) }}" class="fs-6 text-muted">{{$problem->user->username}}</a></small>
                    <small>تعداد سوالات: {{$problem->number}}</small>
                    <small class="d-none d-md-block">جزئیات: <small class="text-muted">{{$problem->description}}</small></small>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-end mb-5">
                <a href="{{ route('problem.show', $problem->id) }}" class="btn btn btn-custom">مشاهده و دانلود سوال</a>
            </div>
            

            <!-- for print replies -->
            @if($replies->count()!=0)
            <div class="row">
                <div class="row">
                    <div class="col pt-4 text-dark-blue mb-3">
                        <h4>پاسخ‌های ارسال شده برای این سوال</h4>
                    </div>
                </div>
                <div class="row">
                @foreach($replies as $reply)
                    <div class="mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <h6 class="card-title border-bottom p-1 fw-bold">{{$reply->user->username}}</h6>
                                <p class="card-text">{{$reply->message}}</p>
                                @if(!empty($reply->file_path))
                                <div class="text-end">
                                    <a href="{{ route('reply.show', $reply->id) }}" class="btn btn btn-outline-custom">مشاهده فایل پاسخ</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            <!-- for reply -->
            <div class="row align-items-center mt-4">
                <div class="col-md-5">

                    @include('layouts.message')

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <p class="fw-bold">لطفا پاسخ خود را با ما به اشتراک بگذارید : )</p>
                    <small class="text-muted">در صورت صحیح بودن پاسخ و تایید، در این صفحه نمایش داده می‌شود.</small>
                    <form action="{{ route('problem.reply.save', $problem->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Reply Text -->
                        <div class="my-4">
                            <label for="message" class="form-label">متن پیام</label>
                            <textarea type="text" name="message" class="form-control" id="message" required></textarea>
                        </div>

                        <!-- Upload File -->
                        <div class="my-4 text-center">
                            <input type="file" name="file_path" id="file" class="inputfile" />
                            <label for="file" class="bi bi-cloud-arrow-up-fill fs-1"><p class="fs-6">بارگذاری فایل پاسخ</p></label>
                        </div>

                        <!-- Reply Send -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">ارسال پاسخ</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 offset-md-2">
                    <img class="img-fluid" src="{{ url('img/img3.png') }}" alt="Not Found" off>
                </div>
            </div>

        </div>
    </section>


@endsection