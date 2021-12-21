@extends('layouts.nav-footer')

@section('title')
ویرایش پاسخ کامنت
@endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center my-5">
            <div class="col-10 col-md-8 col-lg-6">
                <div class="card shadow mt-5">
                    <div class="card-body">
                        <p class="card-title fw-bold fs-3 text-dark-blue text-center border-bottom pb-2">ویرایش پاسخ کامنت</p>
                    
                        @include('layouts.message')

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        
                        <form method="POST" action="{{ route('reply.update', $comment->id) }}">
                            @csrf

                            <!-- Comment Message -->
                            <div class="mt-3">
                                <label for="message" class="form-label pt-2 ps-1">متن کامنت</label>
                                <textarea class="form-control py-1" id="reply" disabled>{{$comment->message}}</textarea>
                            </div>

                            <!-- Comment Reply -->
                            <div class="my-3">
                                <label for="reply" class="form-label pt-2 ps-1">پاسخ کامنت</label>
                                <textarea class="form-control py-1" id="reply" name="reply" autofocus required>{{$comment->reply}}</textarea>
                            </div>
                            
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('ویرایش پاسخ') }}
                                </button>
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection