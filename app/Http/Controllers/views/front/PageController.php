<?php

namespace App\Http\Controllers\views\front;


use App\Models\Page;
use App\Mail\Contacted;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function contact ()
    {
        return view('front.pages.contact');
    }


    public function contactForm(Request $request)
    {
        Mail::send(new Contacted($request));
        return redirect()->back()->with('message', 'Thank you for contacting us. We will get back to you soon.');
    }


    public function terms ()
    {
        $page = Page::where('slug', 'terms')->first();

        if (!$page) {
            abort(404);
        }

        return view('front.pages.terms', compact('page'));
    }
}
