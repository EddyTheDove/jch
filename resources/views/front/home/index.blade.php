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
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="app">
        @include('front.includes.header')
        @include('front.includes.nav')
        @include('front.home.slider')
        @include('front.home.services')
        @include('front.includes.footer')
    </div>
</body>

<script src="/assets/js/app.js"></script>
<script src="/assets/js/slider.min.js"></script>
@include('front.home.js')
</html>
