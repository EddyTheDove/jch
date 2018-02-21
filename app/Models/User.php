<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function name() {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function isAdmin () {
        return $this->role_id == 1;
    }
}
