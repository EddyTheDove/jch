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
                                            <li><strong>{{ $car->year . ' ' . $car->make . ' ' . $car->model }}</strong> </li>
                                            <li><strong>VIN/Chassis:</strong> {{ $car->japanese_vin }}</li>
                                            <li><strong>Year of export:</strong> {{ $car->export_year ?? 'N/A' }}</li>
                                            <li><strong>Original Colour:</strong> {{ $car->colour ?? 'N/A' }}</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h5 class="bold">Personal Details Summary</h5>
                                    <div class="pb-20">
                                        <ul class="list-unstyled">
                                            <li><strong>{{ $user->firstname . ' ' . $user->lastname }}</strong> </li>
                                            <li><strong>Email:</strong> {{ $user->email }}</li>
                                            <li><strong>Mobile:</strong> {{ $user->mobile }}</li>
                                            <li><strong>Location:</strong> {{ $user->suburb . ', ' .$user->country }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h5 class="bold">Card Payment</h5>
                            <div class="row">
                                <div class="col-sm-12 col-md-9">
                                    <form class="_form" method="post" action="/checkout" id="payment-form">
                                        <div class="form-row">
                                            <div id="card-element"></div>
                                            <div id="card-errors" role="alert"></div>
                                        </div>

                                        <div class="fs-15 mt-10">
                                            <a href="https://stripe.com" target="_blank">
                                                <i class="ion-locked"></i>
                                                Secure payments with Stripe
                                            </a>
                                        </div>

                                        <div class="mt-20">
                                            By confirming and paying, you agree to our <a href="/terms" target="_blank">Terms and conditions</a>
                                        </div>

                                        <button type="submit" class="btn btn-lg btn-primary mt-20">
                                            CONFIRM & PAY ${{ $report->amount }} AUD
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End of left side  --}}


                    <div class="col-sm-3">
                        <div class="_block _block-radius _block-grey elevated">
                            <div class="_block-title">
                                ORDER SUMMARY
                            </div>

                            <div class="pl-20 pb-20">
                                <h5>{{ $report->name }}</h5>
                                <h5 class="fw-500">Total: ${{ $report->amount }} AUD</h5>
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
    {{-- @include('front.payment.payment-js') --}}
@endsection
