<?php

namespace App\Http\Controllers\views\admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function home()
    {
        $orders = DB::table('orders')->count();
        $pending = DB::table('orders')->where('status', 'placed')->count();
        $delivered = $orders - $pending;

        return view('admin.all.dashboard', compact('orders', 'pending', 'delivered'));
    }




    public function files()
    {
        return view('admin.all.files');
    }
}
