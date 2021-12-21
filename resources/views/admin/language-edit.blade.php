@extends('layouts.nav-footer')

@section('title')
ویرایش اطلاعات زبان
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-10 col-md-8 col-lg-6">
            <div class="card shadow mt-5">
                <div class="card-body p-5">
                    <p class="card-title fw-bold fs-3 text-dark-blue text-center border-bottom pb-2">ویرایش اطلاعات زبان</p>
                    
                    @include('layouts.message')
                    
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('admin.language.update', $language->id ) }}">
                        @method('PUT')
                        @csrf

                        <!-- Id Language -->
                        <div class="mt-3">
                            <label for="id" class="form-label ps-1">شناسه زبان</label>
                            <input type="text" class="form-control" id="id" name="id" value="{{$language->id}}" required>
                        </div>
                        <!-- Name Language -->
                        <div class="my-2">
                            <label for="name" class="form-label ps-1">نام زبان</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$language->name}}" required>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ویرایش') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection