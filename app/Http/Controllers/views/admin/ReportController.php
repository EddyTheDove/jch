<?php

namespace App\Http\Controllers\views\admin;

use App\Models\Report;
use App\Traits\SlugTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    use SlugTrait;

    public function index(Request $request)
    {
        try
        {
            $reports = Report::get();
            return view('admin.reports.index', ['reports' => $reports]);
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
    }






    public function create ()
    {
        return view('admin.reports.create');
    }

    public function edit (Report $report)
    {
        return view('admin.reports.edit', compact('report'));
    }






    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'amount' => 'required',
            'slug'  => 'required'
        ]);

        if($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Name, amount & slug are required']);

        //Check if the slug exists using slug trait
        $slug = $this->getUniqueSlug($request->slug, 'reports');
        $report = Report::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'slug'          => $slug,
            'amount'        => (int) $request->amount * 100
        ]);

        return redirect()->route('reports.edit', $report->id);
    }


    




    public function update(Request $request, Report $report)
    {
        if ($report) {
            $report->name = $request->name;
            $report->amount = (int) $request->amount * 100;
            $report->description = $request->description;

            $report->save();
        }

        return redirect()->back()->with('message', 'Report successfully updated!');
    }
}
