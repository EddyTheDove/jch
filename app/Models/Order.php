<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = ['id'];

    public function getAmountAttribute ($value) {
        return sprintf("%.2f", $value);
    }

    public function report () {
        return $this->belongsTo(Report::class);
    }

    public function car () {
        return $this->belongsTo(Car::class, 'cart_id');
    }

    public function fullname () {
        return $this->firstname . ' ' . $this->lastname;
    }
}
