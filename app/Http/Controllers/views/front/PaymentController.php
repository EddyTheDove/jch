<?php

namespace App\Http\Controllers\views\front;

use PDF;
use App\Models\Car;
use App\Models\Order;
use App\Models\Report;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;


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

        // charge client's credit car
        $charge = $stripe->charges()->create([
            'currency' => 'aud',
            'amount'   => $report->fullAmount(),
            'source'   => $request->stripeToken,
            'description' => $report->name,
            'metadata' => [
                'firstname' => $user->firstname,
                'lastname'  => $user->firstname,
                'email'     => $user->email,
                'mobile'    => $user->mobile
            ]
        ]);

        // save client's car
        $car = $this->saveCar($car);

        // Place new order for the client
        $order = $this->placeOrder($report, $user, $car, $charge);

        // Generate invoice
        $filename = public_path('/storage/pdfs/' . $order->number . '.pdf');
        $pdf = PDF::loadView('pdfs.invoice', compact('order'))
        ->save($filename);

        // Send email to the client
        Mail::to($order->email)->send(new OrderPlaced($order))
        ->attach($filename);

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
    private function placeOrder ($report, $user, $car, $charge)
    {
        $number = 1001101;
        $lastOrder = Order::orderBy('id', 'desc')->first();

        if ($lastOrder) {
            $number = $lastOrder->number += rand(1, 9);
        }

        return Order::create([
            'number'        => $number,
            'report_id'     => $report->id,
            'cart_id'       => $car->id,
            'amount'        => $report->amount,
            'firstname'     => $user->firstname,
            'lastname'      => $user->lastname,
            'email'         => $user->email,
            'mobile'        => $user->mobile,
            'address'       => $user->address ?: '',
            'suburb'        => $user->suburb ?: '',
            'state'         => $user->state ?: '',
            'postcode'      => $user->postcode ?: '',
            'stripe_charge_id' => $charge['id'],
            'status'        => 'placed',
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
}
