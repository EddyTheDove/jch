<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="index,follow">
    <meta name="author" content="XMD Motors">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="japanese car history, car history, japanese car, car history, car history check, car vin, vehicle report, vehicle checker, car reports, auto report, auto checker, identify car by vin, i car check, car history website, check number plate, carfax cars, hpi car check, car number plate check, vin number report, view car history, lookup car history, car history report">
    <meta name="description" content="Japanese odometer and accident history check. A world-wide service to verify the mileage and condition of any imported used Japanese vehicle.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/assets/css/app.css') }}">
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
