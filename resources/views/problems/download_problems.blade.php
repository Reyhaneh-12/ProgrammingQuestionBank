@extends('layouts.nav-footer')

@section('title')
دانلود سوالات
@endsection

@section('content')

    <section class="container">
        <div class="row justify-content-center my-5">
            <div class="col-10 col-md-8 col-lg-6">
                <div class="card shadow mt-5">
                    <div class="card-body">
                        <p class="card-title fw-bold fs-3 text-dark-blue text-center border-bottom pb-2">دانلود سوالات</p>
                    
                        @include('layouts.message')

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        
                        <form method="POST" action="{{ route('download.selected.problems') }}">
                            @csrf
                                <!-- Category Id -->
                                <div class="mt-3">
                                    <label for="category_id" class="form-label ps-1">دسته‌بندی سوالات</label>
                                    <select class="form-select" aria-label="Default select example" id="category_id" name="category_id" required>
                                        <option selected value="0">همه دسته‌بندی‌ها</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" class="text-start">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Language Id -->
                                <div class="mt-3">
                                    <label for="language_id" class="form-label ps-1">زبان سوالات</label>
                                    <select class="form-select" aria-label="Default select example" id="language_id" name="language_id" required>
                                        <option selected value="0">همه زبان‌ها</option>
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}" dir="ltr" class="text-start">{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('دانلود') }}
                                </button>
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection