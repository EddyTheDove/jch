<?php

namespace App\Http\Controllers\views\front;

use DB;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function save (Request $request)
    {
        if ($request->session()->exists('report')) {
            $request->session()->forget('report');
        }

        $report = $request->except(['_token']);
        $request->session()->put('report', $report);

        return response()->json('OK');
    }




    public function show($slug)
    {
        $reports = Report::get();
        $report = Report::where('slug', $slug)->first();
        $countries = DB::table('countries')->select('name', 'phone')->get();

        return view('front.reports.show', compact('report', 'reports', 'countries'));
    }
}
