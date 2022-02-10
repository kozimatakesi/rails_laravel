<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'user_id',
        'content_id',
        'notice',
    ];
}
