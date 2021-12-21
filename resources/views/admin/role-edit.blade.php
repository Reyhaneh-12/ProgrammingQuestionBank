@extends('layouts.nav-footer')

@section('title')
ویرایش اطلاعات نقش
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

                    <form method="POST" action="{{ route('admin.role.update', $role->id ) }}">
                        @method('PUT')
                        @csrf

                        <!-- Name Role -->
                        <div class="my-3">
                            <label for="name" class="form-label ps-1">نام نقش</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}" required>
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