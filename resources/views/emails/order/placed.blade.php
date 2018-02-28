@extends('emails.body')

@section('head')
    <title>Car History Request Received</title>
@endsection



@section('heading')
    Car History Request Received
@endsection


@section('content')
    <p>
        Hi {{ $order->firstname }}, <br>
    </p>

    <p>
        We received your request for a car history check. We will proceed as soon
        as we can, and email you the report within the next 2 working days.
    </p>

    <p>A payment invoice has been attached to this email.</p>
    <p>Thank you for your business</p>
@endsection
