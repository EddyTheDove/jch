<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Japanese Car History Invoice</title>
<style>
/* -------------------------------------
        GLOBAL
------------------------------------- */

@page {
    size: A4 portrait;
}

* {
    margin: 0;
    padding: 0;
    font-family:  "Open Sans", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    line-height: 1.6;
    -webkit-box-sizing: border-box;
}



h4,h3 {font-weight: 300; color: #353847; margin: 0;}

body {
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: none;
    margin: 0 auto;
    font-family: sans-serif;
    font-size: 14px;
    font-weight: 400;
}
.bold { font-weight: bold }
.list-unstyled { list-style: none; color: #636d7e; }
.mt-10 { margin-top: 10px }
.mt-20 { margin-top: 20px }
.mt-40 { margin-top: 40px }
.text-right { text-align: right }
.card { background-color: #efefef; border-radius: 2px }
.accent { background-color: #efefef; font-weight: bold }
table { border:none }
table > thead { border-top: 2px solid #ccc; border-bottom: 2px solid #ccc }
table > thead > tr > th,
table > tbody > tr > td { padding-left: 10px; height: 40px }

.table { display: table; width: 100% }
.table-row { display: table-row }
.table-cell { display: table-cell }
.col2 { width: 50% }
.col3 { width: 33% }
</style>
</head>
<body bgcolor="#fff">
    <section style="margin:20px 40px;">

        <div class="table mt-10">
            <div class="table-row">
                <div class="table-cell"></div>
                <div class="table-cell"></div>
                <div class="table-cell text-right">
                    <h3 class="bold">Invoice No 1001101</h3>
                    <h4 class="bold">28 February 2018</h4>
                </div>
            </div>
        </div>
        {{-- End of date  --}}


        <div class="table mt-40">
            <div class="table-row">
                <div class="table-cell col3">
                    <h3 class="bold">Japanese Car History</h3>
                    <ul class="list-unstyled">
                        <li>T/A XMD Motors Pty Ltd</li>
                        <li>ABN: 80 615 034 734 </li>
                        <li>5/6 Cary Grove,</li>
                        <li>Minto, NSW 2566</li>
                        <li>P: 1300 963 668</li>
                    </ul>
                </div>

                <div class="table-cell col3"></div>

                <div class="table-cell col3" style="background-color:#efefef;padding:10px;">
                    <h3 class="bold">Bill to:</h3>
                    <h4 class="bold">{{ $order->firstname }} {{ $order->lastname }}</h4>
                    <ul class="list-unstyled">
                        <li>{{ $order->address }},</li>
                        <li>{{ $order->suburb }}, {{ $order->state }} {{ $order->postcode }}</li>
                        <li>{{ $order->mobile }}</li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- End of personal infos  --}}

        <div class="mt-40"></div>


        <table width="100%" cellspacing="0" cellpadding="0">
            <thead style="background-color:#efefef;">
                <tr style="height:40px">
                    <th>Item Description</th>
                    <th>Rate</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr style="padding-top:40px;">
                    <td>{{ $order->report->name }}</td>
                    <td>${{ $order->amount }}</td>
                    <td>1</td>
                    <td>${{ $order->amount }}</td>
                </tr>
                <tr class="accent">
                    <td></td>
                    <td></td>
                    <td>Total </td>
                    <td>${{ $order->amount }}</td>
                </tr>
                <tr style="font-weight: bold;">
                    <td></td>
                    <td></td>
                    <td>GST </td>
                    <td>Included</td>
                </tr>
                <tr class="accent" style="font-size:16px;">
                    <td></td>
                    <td></td>
                    <td class="bold">TOTAL PAID</td>
                    <td class="bold fs16">${{ $order->amount }} AUD</td>
                </tr>
            </tbody>
        </table>

    </section>
</body>
