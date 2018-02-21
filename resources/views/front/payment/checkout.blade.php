@extends('front.templates.default')

@section('head')
    <title>Checkout | Japanese Car History</title>
@endsection

@section('body')
    <div class="full-page">
        <section class="checkout-page">
            <div class="container mb-40">
                <h3>Checkout</h3>

                <div class="row mt-20">
                    <div class="col-sm-9">

                        <div class="checkout-summary">

                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="bold">Car Details Summary</h5>
                                    <div class="pb-20">
                                        <ul class="list-unstyled">
                                            <li><strong>2014 Nissan Elgrand</strong> </li>
                                            <li><strong>VIN/Chassis:</strong> BNR32305366</li>
                                            <li><strong>Year of export:</strong> 2017</li>
                                            <li><strong>Original Colour:</strong> N/A</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h5 class="bold">Personal Details Summary</h5>
                                    <div class="pb-20">
                                        <ul class="list-unstyled">
                                            <li><strong>John Doe</strong> </li>
                                            <li><strong>Email:</strong> johndoe@email.com</li>
                                            <li><strong>Mobile:</strong> 0422334455</li>
                                            <li><strong>Address:</strong> 22 Jump St, Sydney, NSW, 2000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h5 class="bold">Card Payment</h5>
                            @include('front.payment.form')

                        </div>
                    </div>
                    {{-- End of left side  --}}


                    <div class="col-sm-3">
                        <div class="_block _block-radius _block-grey elevated">
                            <div class="_block-title">
                                ORDER SUMMARY
                            </div>

                            <div class="pl-20 pb-20">
                                <h5>Intermediate Report</h5>
                                <h5 class="fw-600">Total: $110.00</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    @include('front.payment.elements-js')
    @include('front.payment.payment-js')
@endsection
