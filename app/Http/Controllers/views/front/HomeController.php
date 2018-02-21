<?php

namespace App\Http\Controllers\views\front;

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
}
