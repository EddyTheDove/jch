<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    protected $guarded = ['id'];

    public function getAmountAttribute ($value) {
        return sprintf("%.2f", $value / 100);
    }

    public function fullAmount () {
        return $this->amount;
    }
}
