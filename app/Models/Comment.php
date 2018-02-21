<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = ['id'];

    public function commentable() {
        return $this->morphTo();
    }

    public function user () {
        return $this->belongsTo(User::class, 'user_id')->select('firstname', 'lastname', 'id');
    }
}
