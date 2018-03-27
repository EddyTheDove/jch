<?php

namespace App\Http\Controllers\api\v1;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function show ($name)
    {
        try
        {
            $coupon = Coupon::where('name', $name)->first();
            
            if (!$coupon) {
                return response()->json('NOT FOUND', self::HTTP_NOTFOUND);
            }

            return response()->json($coupon);
        }
        catch(Exception $e) {
            return response()->json($e->getMessage(), self::HTTP_ERROR);
        }
    }
}
