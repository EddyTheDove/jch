<?php

namespace App\Http\Controllers\views\admin;

use App\Models\Order;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $orders = Order::orderBy('id', 'desc')
            ->with('report')
            ->when($request->status, function($q) use ($request) {
                return $q->whereStatus($request->status);
            })
            ->when($request->keywords, function($q) use ($request) {
                return $q->where('number', $request->keywords)
                ->orWhere('firstname', 'like', '%'.$request->keywords.'%')
                ->orWhere('lastname', 'like', '%'.$request->keywords.'%')
                ->orWhere('mobile', $request->keywords);
            })
            ->paginate(50);

            return view('admin.orders.index', compact('orders'));
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
    }



    public function edit ($number)
    {
        $order = Order::whereNumber($number)
        ->with('car')
        ->first();

        if (!$order) {
            abort(404);
        }

        $reports = Report::get();
        $car = $order->car;

        return view('admin.orders.edit', compact('order', 'reports', 'car'));
    }





    public function update (Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            abort(404);
        }

        $order->firstname       = $request->firstname;
        $order->lastname        = $request->lastname;
        $order->mobile          = $request->mobile;
        $order->email           = $request->email;
        $order->address         = $request->address;
        $order->suburb          = $request->suburb;
        $order->state           = $request->state;
        $order->postcode        = $request->postcode;
        $order->report_id       = $request->report_id;
        $order->ppsr            = $request->ppsr;
        $order->save();

        // Update car
        $car = $order->car;
        $car->year              = $request->year;
        $car->make              = $request->make;
        $car->model             = $request->model;
        $car->original_vin      = $request->original_vin;
        $car->australian_vin    = $request->australian_vin;
        $car->original_colour   = $request->original_colour;
        $car->export_year       = $request->export_year;
        $car->save();

        return redirect()->back()->with('message', 'Order successfully updated');
    }
}
