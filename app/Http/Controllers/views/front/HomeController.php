<?php

namespace App\Http\Controllers\views\front;

use DB;
use PDF;
use App\Models\Order;
use App\Models\Report;
use App\Helpers\Fixer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home ()
    {
        $reports = Report::where('status', 1)->get();
        $countries = DB::table('countries')->select('name', 'phone')->get();

        return view('front.home.index', compact('reports', 'countries'));
    }

    public function pdfs ($name) {
        $order = Order::orderBy('id')->first();
        $pdf = PDF::loadView('pdfs.' . $name, compact('order'));
        return $pdf->stream();
    }
}
