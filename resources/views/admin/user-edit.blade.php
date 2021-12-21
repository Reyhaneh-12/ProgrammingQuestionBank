@extends('layouts.nav-footer')

@section('title')
ویرایش اطلاعات کاربر
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-10 col-md-8 col-lg-6">
            <div class="card shadow mt-5">
                <div class="card-body p-5">
                    <p class="card-title fw-bold fs-3 text-dark-blue text-center border-bottom pb-2">ویرایش اطلاعات کاربر</p>
                    
                    @include('layouts.message')

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                        @method('PUT')
                        @csrf

                        <!-- Id User -->
                        <div class="mt-3">
                            <label for="id" class="form-label ps-1">شناسه کاربر</label>
                            <input type="text" class="form-control" id="id" name="id" value="{{$user->id}}" required>
                        </div>
                        <!-- UserName -->
                        <div class="my-1">
                            <label for="username" class="form-label ps-1">نام کاربری</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" required>
                        </div>
                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="form-label ps-1">رمز فعلی <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="current_password" name="current_password" autofocus required>
                        </div>
                        <!-- New Password -->
                        <div class="my-1">
                            <label for="new_password" class="form-label ps-1">رمز جدید</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" autocomplete="new-password">
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