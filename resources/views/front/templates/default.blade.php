<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="index,follow">
    <meta name="author" content="XMD Motors">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Japanese car history">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/app.css') }}">
    <script>
        var _rates = <?php echo json_encode($rates) ?>;
    </script>
    @yield('head')
</head>
<body>
    <div id="app">
        @include('front.includes.header')
        @include('front.includes.nav')
        @yield('body')
        @include('front.includes.footer')
    </div>
</body>

<script src="{{ asset('/assets/js/app.js') }}"></script>
@yield('js')
</html>
