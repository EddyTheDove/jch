<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>Japanese Car History</title>
    <meta name="robots" content="index,follow">
    <meta name="author" content="XMD Motors">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Japanese car history">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/app.css') }}">

    <script>
        var _countries = <?php echo json_encode($countries) ?>;
        var _reports = <?php echo json_encode($reports) ?>;
        var _rates = <?php echo json_encode($rates) ?>;
    </script>
</head>
<body>
    <div id="app">
        @include('front.includes.header')
        @include('front.includes.nav')
        @include('front.home.slider')
        @include('front.home.reports')
        @include('front.includes.footer')
    </div>
</body>

<script src="{{ asset('/assets/js/slider.min.js') }}"></script>
<script src="{{ asset('/assets/js/app.js') }}"></script>
@include('front.home.js')
</html>
