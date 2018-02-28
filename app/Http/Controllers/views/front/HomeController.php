<?php

namespace App\Http\Controllers\views\front;

use PDF;
use App\Models\Order;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home ()
    {
        $reports = Report::where('status', 1)->get();
        return view('front.home.index', compact('reports'));
    }

    public function pdfs ($name) {
        $order = Order::orderBy('id')->first();
        $pdf = PDF::loadView('pdfs.' . $name, compact('order'));
        return $pdf->stream();
    }
}
