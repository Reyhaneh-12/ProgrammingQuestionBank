@extends('layouts.nav-footer')

@section('title')
پاسخ‌های یک سوال
@endsection

@section('content')

<section>
    <div class="container">

        <div class="row border-bottom py-5">
            @include('layouts.message')
            <div class="col text-start">
                <h3>پاسخ‌های سوال {{$problem->category->name}}</h3>
            </div>
        </div>

        @if($replies->count()==0)
        <div class="row my-5 text-center justify-content-center align-items-center">
            <div class="col-sm-10 col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <p class="card-text">تا به حال پاسخی برای این سوال ارسال نشده است!</p>
                    </div>
                </div>
            </div>
        </div>

        @else

        <div class="row align-items-center py-4">
            <table class="table text-center table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">نام کاربر</th>
                        <th scope="col">متن پاسخ</th>
                        <th scope="col">فایل</th>
                        <th scope="col">وضعیت تایید</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($replies as $reply)
                    <tr>
                        <td>{{$reply->user->username}}</td>
                        <td>{{$reply->message}}</td>
                        <td><a href="{{ route('reply.show', $reply->id) }}"><i class="bi bi-file-earmark-pdf fs-5"></i></td>
                        @if($reply->confirmation_status==0)
                            <td><a href="{{ route('reply.confirmation', $reply->id) }}" class="btn btn-success" onclick="return confirm('پاسخ تایید شود؟');">تایید</a></td>
                        @else
                            <td>تایید شده</td>
                        @endif
                        <td><a href="{{ route('user.reply.destroy', $reply->id) }}" onclick="return confirm('ایتم مورد نظر حذف شود؟');"><i class="bi bi-trash fs-5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        @endif

    </div>
</section>


@endsection