@extends('layouts.nav-footer')

@section('title')
افزودن دسته‌بندی
@endsection

@section('content')

    <section class="container">
        <div class="row justify-content-center my-5">
            <div class="col-10 col-md-8 col-lg-6">
                <div class="card shadow mt-5">
                    <div class="card-body">
                        <p class="card-title fw-bold fs-3 text-dark-blue text-center border-bottom pb-2">افزودن دسته‌بندی جدید</p>
                    
                        @include('layouts.message')

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        
                        <form method="POST" action="{{ route('category.save') }}">
                            @csrf
                            <!-- Category Name -->
                            <div class="my-3">
                                <label for="name" class="form-label pt-2 ps-1">نام دسته‌بندی</label>
                                <input type="text" class="form-control py-1" id="name" name="name" autofocus required>
                            </div>
                            
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('افزودن دسته‌بندی') }}
                                </button>
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection