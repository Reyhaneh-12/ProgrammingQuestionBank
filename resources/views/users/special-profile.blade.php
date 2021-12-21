@extends('layouts.nav-footer')

@section('title')
@if( $user->role_id == 1)
پروفایل ادمین
@elseif( $user->role_id == 2)
پروفایل کاربر ویژه
@else
پروفایل کاربر عادی
@endif
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

        @if($problems->count()==0)
        <div class="row my-5 text-center justify-content-center align-items-center">
            <div class="col-sm-10 col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <p class="card-text">شما تا به حال سوالی طرح نکرده‌اید!</p>
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="row border-bottom py-5">
            <div class="col text-start">
                <h3>لیست سوالات طراحی شده توسط شما</h3>
            </div>
        </div>

        <div class="row align-items-center py-4">
            <table class="table text-center table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">عنوان</th>
                        <th scope="col">دسته‌بندی</th>
                        <th scope="col">زبان</th>
                        <th scope="col">تعداد</th>
                        <th scope="col">جزئیات</th>
                        <th scope="col">پاسخ‌ها</th>
                        <th scope="col">فایل</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($problems as $problem)
                    <tr>
                        <td>{{$problem->title}}</td>
                        <td>{{$problem->category->name}}</td>
                        <td dir="ltr">{{$problem->language->name}}</td>
                        <td>{{$problem->number}}</td>
                        <td class="px-3">{{$problem->description}}</td>
                        <td><a href="{{ route('problem.replies', $problem->id) }}"><i class="bi bi-link-45deg fs-5"></i></td>
                        <td><a href="{{ route('problem.show', $problem->id) }}"><i class="bi bi-file-earmark-pdf fs-5"></i></td>
                        <td><a href="{{ route('problem.edit', $problem->id ) }}"><i class="bi bi-pencil-square fs-5"></i></a></td>
                        <td><a href="{{ route('problem.destroy', $problem->id ) }}" onclick="return confirm('ایتم مورد نظر حذف شود؟');"><i class="bi bi-trash fs-5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        @endif

    </div>
</section>


@endsection