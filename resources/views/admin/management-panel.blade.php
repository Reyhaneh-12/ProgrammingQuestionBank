@extends('layouts.nav-footer')

@section('title')
پنل مدیریتی ادمین
@endsection

@section('content')


<!-- Users Information -->
<section>

    @include('layouts.message')

    <div class="container">
        <div class="row border-bottom mt-5 pt-4">
            <div class="col text-start">
                <h3>لیست کاربران</h3>
            </div>
        </div>

        <div class="row py-4">
            <table class="table text-center table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">شناسه</th>
                        <th scope="col">نام کاربری</th>
                        <th scope="col">نقش کاربر</th>
                        <th scope="col">سوالات طراح</th>
                        <th scope="col">ایمیل</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->role->name}}</td>
                        @if($user->role_id==2)
                            <td><a href="{{ route('designer.problems', $user->id ) }}"><i class="bi bi-link-45deg fs-5"></i></a></td>
                        @else
                            <td> - </td>
                        @endif
                        <td>{{$user->email}}</td>
                        <td><a href="{{ route('admin.user.edit', $user->id ) }}"><i class="bi bi-pencil-square fs-5"></i></a></td>
                        <td><a href="{{ route('admin.user.destroy', $user->id ) }}" onclick="return confirm('ایتم مورد نظر حذف شود؟');"><i class="bi bi-trash fs-5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</section>

<div style="height: 150px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
        <path d="M-0.84,72.55 C152.09,141.63 239.55,32.08 506.49,71.55 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #F8F9FA;"></path>
    </svg>
</div>

<!-- Problems Information -->
<section class="bg-light">
    <div class="container">
        <div class="row border-bottom pt-3 align-items-baseline">
            <div class="col-6 pe-3">
                <h3>لیست سوالات</h3>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('problem.add') }}"><i class="bi bi-plus-circle icon-orginal fs-2"></i></a> 
            </div>
        </div>

        <div class="row align-items-center py-4">
            <table class="table text-center table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">شناسه</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">دسته‌بندی</th>
                        <th scope="col">زبان</th>
                        <th scope="col">تعداد</th>
                        <th scope="col">طراح</th>
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
                        <td>{{$problem->id}}</td>
                        <td>{{$problem->title}}</td>
                        <td>{{$problem->category->name}}</td>
                        <td dir="ltr">{{$problem->language->name}}</td>
                        <td>{{$problem->number}}</td>
                        <td>{{$problem->user->username}}</td>
                        <td class="px-3">{{$problem->description}}</td>
                        <td><a href="{{ route('problem.replies', $problem->id) }}"><i class="bi bi-link-45deg fs-5"></i></td>
                        <td><a href="{{ route('problem.show', $problem->id) }}"><i class="bi bi-file-earmark-pdf fs-5"></i></td>
                        <td><a href="{{ route('admin.problem.edit', $problem->id ) }}"><i class="bi bi-pencil-square fs-5"></i></a></td>
                        <td><a href="{{ route('admin.problem.destroy', $problem->id ) }}" onclick="return confirm('ایتم مورد نظر حذف شود؟');"><i class="bi bi-trash fs-5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</section>

<div style="height: 150px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
        <path d="M-11.57,66.63 C271.16,153.47 263.26,15.30 503.67,78.47 L500.00,0.00 L0.00,0.00 Z" style="stroke: none; fill: #F8F9FA;"></path>
    </svg>
</div>

<!-- Categories Information -->
<section>
    <div class="container">
        <div class="row border-bottom pt-3 align-items-baseline">
            <div class="col-6 pe-3">
                <h3>دسته‌بندی سوالات</h3>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('category.add') }}"><i class="bi bi-plus-circle icon-orginal fs-2"></i></a> 
            </div>
        </div>

        <div class="row py-4">
            <table class="table text-center table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">شناسه</th>
                        <th scope="col">نام دسته‌بندی</th>
                        <th scope="col">ویرایش دسته‌بندی</th>
                        <th scope="col">حذف دسته‌بندی</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td><a href="{{ route('admin.category.edit', $category->id ) }}"><i class="bi bi-pencil-square fs-5"></i></a></td>
                        <td><a href="{{ route('admin.category.destroy', $category->id ) }}" onclick="return confirm('ایتم مورد نظر حذف شود؟');"><i class="bi bi-trash fs-5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<div style="height: 150px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
        <path d="M-10.44,103.13 C149.99,150.00 259.31,30.09 509.31,80.42 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #1a2b4e;"></path>
    </svg>
</div>

<!-- Replies Information -->
<section class="bg-dark-blue">
    <div class="container">
        <div class="row border-bottom pt-3 align-items-baseline">
            <div class="col-6 pe-3">
                <h3>پاسخ‌های سوالات</h3>
            </div>
        </div>

        <div class="row py-4">
            <table class="table text-center table-light table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">شناسه</th>
                        <th scope="col">نام کاربر</th>
                        <th scope="col">عنوان سوال</th>
                        <th scope="col">متن پاسخ</th>
                        <th scope="col">فایل</th>
                        <th scope="col">وضعیت تایید</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($replies as $reply)
                    <tr>
                        <td>{{$reply->id}}</td>
                        <td>{{$reply->user->username}}</td>
                        <td><a href="{{ route('problem.details', $reply->problem_id) }}">{{$reply->problem->title}}</a></td>
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
    </div>
</section>

<div style="height: 100px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
        <path d="M-21.16,55.75 C284.14,116.94 286.39,86.34 548.24,61.67 L500.00,0.00 L0.00,0.00 Z" style="stroke: none; fill: #1a2b4e;"></path>
    </svg>
</div>

<!-- Comments Information -->
<section>
    <div class="container">
        <div class="row border-bottom mt-5 pt-4">
            <div class="col text-start">
                <h3>کامنت‌های کاربران</h3>
            </div>
        </div>

        <div class="row py-4">
            <table class="table text-center table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">شناسه</th>
                        <th scope="col">نام کاربری</th>
                        <th scope="col">متن پیام</th>
                        <th scope="col">پاسخ</th>
                        <th scope="col">ویرایش پاسخ</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->user->username}}</td>
                        <td>{{$comment->message}}</td>
                        @if($comment->reply!=NULL)
                            <td>{{$comment->reply}}</td>
                        @else
                            <td><a href="{{ route('comment.reply', $comment->id ) }}"><i class="bi bi-reply fs-5"></i></a></td>
                        @endif
                        <td><a href="{{ route('reply.edit', $comment->id ) }}"><i class="bi bi-pencil-square fs-5"></i></a></td>
                        <td><a href="{{ route('comment.destroy', $comment->id ) }}" onclick="return confirm('ایتم مورد نظر حذف شود؟');"><i class="bi bi-trash fs-5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<div style="height: 150px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
        <path d="M-10.44,103.13 C149.99,150.00 259.31,30.09 509.31,80.42 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #F8F9FA;"></path>
    </svg>
</div>

<!-- Languages Information -->
<section class="bg-light">
    <div class="container">
        <div class="row border-bottom pt-3 align-items-baseline">
            <div class="col-6 pe-3">
                <h3>زبان‌های برنامه‌نویسی</h3>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('language.add') }}"><i class="bi bi-plus-circle icon-orginal fs-2"></i></a> 
            </div>
        </div>

        <div class="row py-4">
            <table class="table text-center table-light table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">شناسه</th>
                        <th scope="col">نام زبان</th>
                        <th scope="col">سوالات زبان</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($languages as $language)
                    <tr>
                        <td>{{$language->id}}</td>
                        <td dir="ltr">{{$language->name}}</td>
                        <td><a href="{{ route('language.problems', $language->id ) }}"><i class="bi bi-link-45deg fs-5"></i></a></td>
                        <td><a href="{{ route('admin.language.edit', $language->id ) }}"><i class="bi bi-pencil-square fs-5"></i></a></td>
                        <td><a href="{{ route('admin.language.destroy', $language->id ) }}" onclick="return confirm('ایتم مورد نظر حذف شود؟');"><i class="bi bi-trash fs-5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<div style="height: 100px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
        <path d="M-21.16,55.75 C284.14,116.94 286.39,86.34 548.24,61.67 L500.00,0.00 L0.00,0.00 Z" style="stroke: none; fill: #F8F9FA;"></path>
    </svg>
</div>

<!-- Roles Information -->
<section>
    <div class="container">
        <div class="row border-bottom">
            <div class="col text-start">
                <h3>نقش های کاربران</h3>
            </div>
        </div>

        <div class="row py-4">
            <table class="table text-center table-light table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">شناسه</th>
                        <th scope="col">نام نقش</th>
                        <th scope="col">ویرایش</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td><a href="{{ route('admin.role.edit', $role->id ) }}"><i class="bi bi-pencil-square fs-5"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection