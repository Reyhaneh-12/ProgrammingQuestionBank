<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to the first site" />
    <meta name="keywords" content="HTML, CSS, PHP, developer" />
    <title>بازیابی رمز عبور</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}">
</head>

<body class="bg-light">

    <section class="container">
        <div class="row justify-content-center my-5">
            <div class="col-10 col-md-8 col-lg-6">
                <div class="card shadow mt-5">
                    <div class="card-body mx-2">
                        <p class="card-title fw-bold fs-6 text-dark-blue p-2">رمز عبور خود را فراموش کردید؟</p>
                        <p class="card-text text-muted fs-7 px-1">
                            مشکلی نیست. فقط به ما اجازه دهید آدرس ایمیل تان را بشناسیم که یک لینک راه‌اندازی مجدد گذرواژه را به شما ایمیل کنیم به شما این امکان را دهد یک رمز جدید انتخاب کنید.
                        </p>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <!-- Email Address -->
                            <div class="my-4">
                                <label for="email" class="form-label p-1">ایمیل</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" :value="old('email')" autofocus required>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ارسال ایمیل') }}
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