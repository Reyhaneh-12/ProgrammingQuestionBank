<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to the first site" />
    <meta name="keywords" content="HTML, CSS, PHP, developer" />
    <title>ثبت نام</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}">
</head>

<body class="bg-light">

    <section class="container">
        <div class="row justify-content-center my-5">
            <div class="col-10 col-md-8 col-lg-6">
                <div class="card shadow mt-5">
                    <div class="card-body p-5">
                        <p class="card-title fw-bold fs-3 text-dark-blue text-center border-bottom pb-2">ثبت نام</p>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- UserName -->
                            <div class="mt-3">
                                <label for="username" class="form-label ps-1">نام کاربری</label>
                                <input type="text" class="form-control" id="username" name="username" :value="old('username')" autofocus required>
                            </div>
                            <!-- Id Role -->
                            <div class="my-1">
                                <label for="email" class="form-label ps-1">ایمیل</label>
                                <input type="email" class="form-control" id="email" name="email" :value="old('email')" required>
                            </div>
                            <div>
                                <label for="role_id" class="form-label ps-1">نقش</label>
                                <select class="form-select" aria-label="Default select example" id="role_id" name="role_id" min="2" max="3" required>
                                    <option selected disabled>لطفا نقش خود را انتخاب کنید.</option>
                                    <option value="2">کاربر ویژه</option>
                                    <option value="3">کاربر عادی</option>
                                </select>
                            </div>
                            <!-- Password -->
                            <div class="my-1">
                                <label for="password" class="form-label ps-1">رمز</label>
                                <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
                            </div>
                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="form-label ps-1">تکرار رمز</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>



                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a class="ps-1" href="{{ route('login') }}">
                                    {{ __('آیا از قبل حساب دارید؟') }}
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('ثبت نام') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>