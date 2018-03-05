<div class="cell example example3">
    <form class="_form" method="post" action="/checkout">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-6">
                <div id="example3-card-number" class="field empty form-control input-lg"></div>
                <div class="error" role="alert">
                    <span class="message"></span>
                </div>
            </div>

            <div class="col-sm-2">
                <div id="example3-card-expiry" class="field empty form-control input-lg"></div>
            </div>

            <div class="col-sm-2">
                <div id="example3-card-cvc" class="field empty form-control input-lg"></div>
            </div>

            {{-- <div class="col-sm-2">
                <input id="example3-zip"
                    data-tid="elements_examples.form.postal_code_placeholder"
                    class="form-control input-lg"
                    placeholder="ZIP">
            </div> --}}
        </div>

        <div class="fs-15 mt-10">
            <a href="https://stripe.com" target="_blank">
                <i class="ion-locked"></i>
                Secure payments with Stripe
            </a>
        </div>

        <div class="mt-20">
            By confirming and paying, you agree to our <a href="/terms">Terms and conditions</a>
        </div>


        <div class="text-center mt-20">
            <button type="submit" class="btn btn-lg btn-primary">CONFIRM & PAY ${{ $report->amount }} AUD</button>
        </div>
    </form>
</div>
