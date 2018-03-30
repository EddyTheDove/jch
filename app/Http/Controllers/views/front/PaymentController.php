<?php

namespace App\Http\Controllers\views\front;

use PDF;
use Carbon\Carbon;
use App\Models\Car;
use App\Models\Order;
use App\Models\Report;
use App\Models\Coupon;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use App\Jobs\SendInvoiceEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Exception\CardErrorException;


class PaymentController extends Controller
{
    /**
     * Show payment form
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function checkout (Request $request)
    {
        $saved = $request->session()->get('report');
        $report = Report::find($saved['report']['id']);

        if (!$report) {
            abort(404, 'Your session expired');
        }

        $car = (object) $saved['car'];
        $user = (object) $saved['user'];

        return view('front.payment.checkout', compact('car', 'user', 'report'));
    }





    public function thankyou ()
    {
        return view('front.payment.thankyou');
    }




    /**
     * Process payment
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function pay (Request $request)
    {
        $secret = config('services.stripe.secret');
        $version = config('services.stripe.version');
        $stripe = Stripe::make($secret, $version);

        $saved = $request->session()->get('report');
        if (!$saved) {
            return redirect()->back()->withErrors(['session' => 'Your session expired']);
        }

        $car = (object) $saved['car'];
        $user = (object) $saved['user'];
        $report = Report::find($saved['report']['id']);


        // Apply coupons
        $coupon = null;
        $amount = $report->fullAmount();
        if ($request->coupon) {
            $coupon = Coupon::where('name', $request->coupon)->first();
            if ($coupon) {
                if (!$coupon->status) {
                    return redirect()->back()->withErrors(['coupon' => 'The coupon is invalid']);
                } else if ($coupon->isExpired()) {
                    return redirect()->back()->withErrors(['coupon' => 'The coupon has expired']);
                } else if ($coupon->isUsed()) {
                    return redirect()->back()->withErrors(['coupon' => 'The coupon has been used to its maximum capacity']);
                }
                $amount = $this->applyCoupon($coupon, $report);
            }
        }


        // charge client's credit car
        try {
            $charge = $stripe->charges()->create([
                'currency' => 'aud',
                'amount'   => $amount,
                'source'   => $request->stripeToken,
                'description' => $report->name,
                'metadata' => [
                    'firstname' => $user->firstname,
                    'lastname'  => $user->firstname,
                    'email'     => $user->email,
                    'mobile'    => $user->mobile
                ]
            ]);
        } catch (CardErrorException $e) {
            return redirect()->back()->withErrors([ 'stripe' => $e->getMessage() ]);
        }

        // save client's car
        $savedCar = $this->saveCar($car);

        // Place new order for the client
        $order = $this->placeOrder($report, $user, $savedCar, $charge, $car, $amount, $coupon);

        // Generate invoice
        $filename = public_path('/storage/pdfs/' . $order->number . '.pdf');
        $pdf = PDF::loadView('pdfs.invoice', compact('order'))
        ->save($filename);

        // Send email to the client

        Mail::to($order->email)->send(new OrderPlaced($order));
        // SendInvoiceEmail::dispatch($order, $filename)->onQueue('default');
        // dispatch(new SendInvoiceEmail($order, $filename));

        // Redirect to thank you page
        return redirect()->route('thankyou')->with('message', 'Payment successfull. Your order has been placed');
    }




    /**
     * [placeOrder description]
     * @param  [type] $report [description]
     * @param  [type] $user   [description]
     * @param  [type] $car    [description]
     * @param  [type] $charge [description]
     * @return [type]         [description]
     */
    private function placeOrder ($report, $user, $savedCar, $charge, $car, $amount, $coupon = null)
    {
        $number = 1001101;
        $lastOrder = Order::orderBy('id', 'desc')->first();

        if ($lastOrder) {
            $number = $lastOrder->number += rand(1, 9);
        }

        return Order::create([
            'number'        => $number,
            'report_id'     => $report->id,
            'cart_id'       => $savedCar->id,
            'amount'        => $amount,
            'firstname'     => $user->firstname,
            'lastname'      => $user->lastname,
            'email'         => $user->email,
            'mobile'        => $user->mobile,
            'ppsr'          => $car->ppsr,
            'country'       => $user->country ?: '',
            'suburb'        => $user->suburb ?: '',
            'stripe_charge_id' => $charge['id'],
            'status'        => 'placed',
            'coupon_id'     => $coupon ? $coupon->id : null
        ]);
    }



    /**
     * Save car
     * @param  [type] $car [description]
     * @return [type]      [description]
     */
    private function saveCar ($car)
    {
        return Car::create([
            'original_vin'      => $car->japanese_vin,
            'year'              => $car->year,
            'make'              => $car->make,
            'model'             => $car->model,
            'export_year'       => $car->export_year,
            'australian_vin'    => $car->australian_vin,
            'original_colour'   => $car->colour
        ]);
    }



    private function applyCoupon ($coupon, $report)
    {
        $total = $report->fullAmount();
        if ($coupon->nb_use >= $coupon->max_use) {
            return $total;
        }
        if (Carbon::parse($coupon->expiry)->isPast()) {
            return $total;
        }

        $coupon->nb_use = $coupon->nb_use + 1;
        $coupon->save();

        if ($coupon->type === 'percentage') {
            return $total - ($coupon->value * $total) / 100;
        } else {
            return $total - $coupon->value * 100;
        }

        return $total;
    }
}
