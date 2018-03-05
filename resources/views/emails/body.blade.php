<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
    <style>
        body {background-color: #f5f8fa;font-family: 'Maven Pro', Calibri, Arial;padding:0;margin:0;}
        .page {margin:20px auto;max-width:620px;width:100%;background-color:#fff;padding:20px;}
        .heading {font-size:24px;font-weight: 500;text-align: center;width: 100%;}
        .content {margin-top:20px;}
        .link {background-color: #08c;color: white;text-align: center;padding:15px 30px;border-radius:2px;}
        a.link {text-decoration: none;}
        p {line-height: 24px;font-weight: 400;}

        footer {margin-top:40px;text-align: center;}
        ul {list-style: none;}
        ul li{font-size:13px;color: #8a9ea6;font-weight: 500;}
    </style>
    @yield('head')
</head>
<body>
    <div class="page">
        <div class="heading">
            @yield('heading')
        </div>


        <div class="content">
            @yield('content')


            <footer>
                <ul>
                    <li>Japanse Car History</li>
                    {{-- <li>77 Parramatta Road Concord 2137</li>
                    <li>1300 963 668</li> --}}
                </ul>
            </footer>

        </div>
    </div>
</body>
</html>
