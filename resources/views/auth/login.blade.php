<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to the first site" />
    <meta name="keywords" content="HTML, CSS, PHP, developer" />
    <title>ورود</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}">
</head>

<body class="bg-light">

    <section class="container">
        <div class="row justify-content-center my-5">
            <div class="col-10 col-md-8 col-lg-6">
                <div class="card shadow mt-5">
                    <div class="card-body">
                        <p class="card-title fw-bold fs-3 text-dark-blue text-center border-bottom pb-2">ورود</p>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email Address -->
                            <div class="my-3">
                                <label for="email" class="form-label ps-1">ایمیل</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" :value="old('email')" autofocus required>
                            </div>
                            <!-- Password -->
                            <div>
                                <label for="password" class="form-label ps-1">پسورد</label>
                                <input type="password" class="form-control" id="password" name="password" autocomplete="current-password" required>
                            </div>
                            <!-- Remember Me -->
                            <div class="mt-1 ps-1">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" class="form-check-label" type="checkbox"  name="remember">
                                    <span>{{ __('مرا به خاطر بسپار') }}</span>
                                </label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="d-flex flex-column">
                                    @if (Route::has('password.request'))
                                    <a class="ps-1" href="{{ route('password.request') }}">
                                        {{ __('رمز عبور خود را فراموش کردید؟') }}
                                    </a>
                                    @endif

                                    <a class="ps-1" href="{{ route('register') }}">
                                        {{ __('حساب ندارید؟') }}
                                    </a>
                                </div>
                                
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('ورود') }}
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