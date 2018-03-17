<?php

namespace App\Http\Controllers\views\admin;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $coupons = Coupon::orderBy('id', 'desc')
            ->when($request->status, function($q) use ($request) {
                return $q->whereStatus($request->status);
            })
            ->when($request->keywords, function($q) use ($request) {
                return $q->where('name', 'like', '%'.$request->keywords.'%');
            })
            ->paginate(50);

            return view('admin.coupons.index', compact('coupons'));
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
    }


    public function create()
    {
        return view('admin.coupons.create');
    }


    public function edit ($id)
    {
        $coupon = Coupon::find($id);
        if (!$coupon) abord(404);
        $orders = $coupon->orders;

        return view('admin.coupons.edit', compact('coupon', 'orders'));
    }


    public function store(Request $request)
    {
        // Name should be unique
        if ($request->name) {
            $existingCoupon = Coupon::where('name', $request->name)->first();

            if ($existingCoupon) {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['exists' => 'That coupon already exists']);
            }
        }

        // Save coupon
        $coupon = Coupon::create([
            'name'      => $request->name,
            'status'    => $request->status,
            'type'      => $request->type,
            'value'     => $request->value,
            'max_use'   => $request->max_use,
            'expiry'    => Carbon::parse($request->expiry)
        ]);

        // Redirect to edit
        return redirect()->route('coupons.edit', $coupon->id)
        ->with('message', 'Coupon successfully saved');
    }




    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        if (!$coupon) abord(404);

        if ($request->name !== $coupon->name) {
            $existingCoupon = Coupon::where('name', $request->name)->first();

            if ($existingCoupon) {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['exists' => 'That coupon already exists']);
            }
        }

        $coupon->name       = $request->name;
        $coupon->status     = $request->status;
        $coupon->type       = $request->type;
        $coupon->value      = $request->value;
        $coupon->max_use    = $request->max_use;
        $coupon->expiry     = Carbon::parse($request->expiry);
        $coupon->save();

        return redirect()->back()->with('message', 'Coupon successfully updated');
    }
}
