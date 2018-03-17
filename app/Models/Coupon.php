<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $guarded = ['id'];
    // protected $dates = ['expiry'];


    public function orders () {
        return $this->hasMany(Order::class, 'coupon_id');
    }

    public function getExpiryAttribute($value) {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
