
<!DOCTYPE html>
<html>
<head>
    <title>Japanese Car History - Contact Form</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700');
        body {background-color: #f5f8fa;font-family: 'Maven Pro', Calibri, Arial;padding:0;margin:0;}
        .page {margin:20px auto;max-width:620px;width:100%;background-color:#fff;padding:20px;}
        .heading {font-size:24px;font-weight: 500;text-align: center;width: 100%;}
        .content {margin-top:20px;}
        .link {background-color: #08c;color: white;text-align: center;padding:15px 30px;border-radius:2px;}
        a.link {text-decoration: none;}
        p {line-height: 24px;font-weight: 400;font-size: 16px;}

        footer {margin-top:40px;text-align: center;}
        ul {list-style: none;padding: 0;text-align: left;}
        ul li{font-size:16px;color: #232c32;font-weight: 400;}
    </style>
</head>
<body>

    <div class="page">
        <div class="heading">
            Japanese Car History - Contact Form
        </div>


        <div class="content">
            <ul>
                <li>
                    <strong>First Name: </strong> {{ $data->firstname }}
                </li>

                <li>
                    <strong>Last Name: </strong> {{ $data->lastname }}
                </li>

                <li>
                    <strong>Email: </strong> {{ $data->email }}
                </li>

                <li>
                    <strong>Phone: </strong> {{ $data->phone }}
                </li>
            </ul>

            <h4>Message</h4>
            <p>
                {{ $data->comment }}
            </p>

        </div>
    </div>


</body>
</html>
