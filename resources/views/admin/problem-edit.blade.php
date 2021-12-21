@extends('layouts.nav-footer')

@section('title')
ویرایش سوال
@endsection

@section('content')

    <section>
        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-10 col-md-8 col-lg-6">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <p class="card-title fw-bold fs-5 border-bottom p-2">ویرایش سوال</p>

                            @include('layouts.message')

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form method="POST" action="{{ route('admin.problem.update', $problem->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <!-- Problem Id -->
                                <div class="my-3">
                                    <label for="id" class="form-label ps-1">شناسه سوالات</label>
                                    <input type="text" class="form-control" id="id" name="id" value="{{$problem->id}}" required>
                                </div>

                                <!-- Problem Title -->
                                <div class="my-3">
                                    <label for="title" class="form-label ps-1">عنوان سوالات</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$problem->title}}" required>
                                </div>

                                <!-- Problem Category -->
                                <div class="my-3">
                                    <label for="category_id" class="form-label ps-1">دسته‌بندی سوالات</label>
                                    <select class="form-select text-start" aria-label="Default select example" id="category_id" name="category_id"  required>
                                        <option value="{{$problem->category_id}}" selected>{{ $problem->category->name }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <!-- Language Id -->
                                <div class="my-3">
                                    <label for="language_id" class="form-label ps-1">زبان سوالات</label>
                                    <select class="form-select text-start" aria-label="Default select example" id="language_id" name="language_id"  dir="ltr" required>
                                        <option value="{{$problem->language_id}}" selected>{{ $problem->language->name }}</option>
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}">{{ $language->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <!-- User Id -->
                                <div>
                                    <label for="user_id" class="form-label ps-1">طراح</label>
                                    <select class="form-select" aria-label="Default select example" id="user_id" name="user_id" required>
                                        <option value="{{$problem->user_id}}" selected>{{ $problem->user->username }}</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{ $user->username }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                
                                <!-- Problems Number -->
                                <div class="my-3">
                                    <label for="number" class="form-label ps-1">تعداد سوالات</label>
                                    <input type="text" class="form-control" id="number" name="number" value="{{$problem->number}}" required>
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description" class="form-label ps-1">توضیح درباره سوالات</label>
                                    <textarea type="text" class="form-control" id="description" name="description" required>{{$problem->description}}</textarea>
                                </div>

                                <!-- Upload Files -->
                                <div class="my-5 text-center">
                                    <input type="file" name="file_path" id="file" class="inputfile" />
                                    <label for="file" class="bi bi-cloud-arrow-up-fill fs-1"><p class="fs-6">بارگذاری فایل</p></label>
                                </div>

                                <!-- Send Button -->
                                <div class="d-flex justify-content-end align-items-center">
                                    <a href="{{ route('category.add') }}" class="btn btn-outline-primary ps-2 me-2">افزودن دسته‌بندی جدید</a>
                                    <a href="{{ route('language.add') }}" class="btn btn-outline-primary ps-2 me-2">افزودن زبان جدید</a>
                                    <button type="submit" class="btn btn-primary px-4 ">
                                        {{ __('ویرایش سوال') }}
                                    </button>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection