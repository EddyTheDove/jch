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

    public function isExpired () {
        return Carbon::parse($this->expiry)->isPast();
    }

    public function isUsed () {
        return $this->nb_use >= $this->max_use;
    }

    // public function getExpiryAttribute($value) {
    //     return Carbon::parse($value)->format('d-m-Y');
    // }
}
