<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
    <meta charset="utf-8">
    <meta name="robots" content="noindex,nofollow">
    <meta name="name" content="JCH CMS">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/admin.css') }}">
    {{-- @include('admin.includes.favicons') --}}
</head>
<body class="login-page" id="app">
    <h3 class="text-center white mt-60">JCH ADMIN</h3>

    <section class="login-form">
        <h2>Sign In</h2>

        @include('errors.list')

        <form class="_form" action="" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control input-lg text-center"
                placeholder="Email"
                required>
            </div>

            <div class="form-group">
                <input type="password"
                name="password"
                value="{{ old('password') }}"
                class="form-control input-lg text-center"
                placeholder="Password"
                required>
            </div>

            <div class="mt-40">
                <button type="submit" class="btn btn-lg btn-primary btn-block">
                    Sign In
                </button>
            </div>
        </form>

        <div class="mt-20 pb-10 fs-16">
            <a href="#">Forgot Password</a>
        </div>
    </section>


    <script src="/backend/js/app.js"></script>
</body>
</html>
