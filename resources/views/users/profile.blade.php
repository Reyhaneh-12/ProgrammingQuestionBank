@extends('layouts.nav-footer')

@section('title')
پروفایل کاربر
@endsection

@section('content')

<section>
    <div class="container">

        <div class="row justify-content-center py-5">
            <div class="col-10 col-md-8 col-lg-6">
                
                @include('layouts.message')

                <div class="card shadow mt-5">
                    <div class="card-body">
                        <p class="card-title fw-bold fs-5 border-bottom py-2 text-center">{{ $user->username }}</p>                        
                        <p class="card-text ps-3 pt-3">نقش کاربر: <span class="fw-bold">{{ $user->role->name }}</span></p>
                        <p class="card-text ps-3">ایمیل کاربر: <span class="fw-bold">{{ $user->email }}</span></p>

                        <div class="text-end m-4">
                            <a href="{{ route('user.edit') }}" class="btn btn-custom" role="button"><i class="bi bi-pen-fill"> ویرایش</i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($replies->count()==0)
        <div class="row my-5 text-center justify-content-center align-items-center">
            <div class="col-sm-10 col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <p class="card-text">شما تا به حال پاسخی نداده‌اید!</p>
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="row border-bottom py-5">
            <div class="col text-start">
                <h3>لیست پاسخ‌هایی که شما ارسال کردید</h3>
            </div>
        </div>

        <div class="row align-items-center py-4">
            <table class="table text-center table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">متن پاسخ</th>
                        <th scope="col">وضعیت تایید</th>
                        <th scope="col">عنوان سوال</th>
                        <th scope="col">فایل</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($replies as $reply)
                    <tr>
                        <td class="pe-3">{{$reply->message}}</td>
                        @if($reply->confirmation_status==0)
                            <td>تایید نشده</td>
                        @else
                            <td>تایید شده</td>
                        @endif
                        <td>{{$reply->problem->title}}</td>
                        <td><a href="{{ route('reply.show', $reply->id) }}"><i class="bi bi-file-earmark-pdf fs-5"></i></td>
                        <td><a href="{{ route('problem.reply.edit', $reply->id) }}"><i class="bi bi-pencil-square fs-5"></i></a></td>
                        <td><a href="{{ route('problem.reply.destroy', $reply->id ) }}" onclick="return confirm('پاسخ مورد نظر حذف شود؟');"><i class="bi bi-trash fs-5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        @endif

    </div>
</section>


@endsection