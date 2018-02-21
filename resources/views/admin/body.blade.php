<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
    <meta charset="utf-8">
    <meta name="robots" content="noindex,nofollow">
    <meta name="name" content="JCH CMS">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/admin.css') }}">
    @include('admin.includes.favicons')
    @yield('head')
</head>
<body>
    <div id="wrapper">
        <div id="app">
            @include('admin/includes/sidebar')

            <div id="page-content-wrapper">
                @yield('body')
            </div>
        </div>
    </div>


    <script src="{{ asset('/backend/js/admin.js') }}"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(function(){
        $('.table tr[data-href]').each(function(){
            $(this).css('cursor','pointer').hover(
                function(){
                    $(this).addClass('active');
                },
                function(){
                    $(this).removeClass('active');
                }).click( function(){
                    document.location = $(this).attr('data-href');
                }
            );
        });
    });
    </script>
    @yield('js')
</body>
</html>
