@extends('layouts.nav-footer')

@section('title')
ویرایش پاسخ سوال
@endsection

@section('content')

<section>
        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-10 col-md-8 col-lg-6">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <p class="card-title fw-bold fs-5 border-bottom p-2">ویرایش پاسخ</p>

                            @include('layouts.message')

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form method="POST" action="{{ route('problem.reply.update', $reply->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <!-- Reply Message -->
                                <div class="mt-3">
                                    <label for="message" class="form-label ps-1">متن پاسخ</label>
                                    <textarea type="text" class="form-control" id="message" name="message" required>{{$reply->message}}</textarea>
                                </div>

                                <!-- Upload Files -->
                                <div class="my-5 text-center">
                                    <input type="file" name="file_path" id="file" class="inputfile" />
                                    <label for="file" class="bi bi-cloud-arrow-up-fill fs-1"><p class="fs-6">بارگذاری فایل</p></label>
                                </div>


                                <!-- Send Button -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary px-4 ">
                                        {{ __('ویرایش پاسخ') }}
                                    </button>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection