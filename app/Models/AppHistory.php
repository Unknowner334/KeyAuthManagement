<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppHistory extends Model
{
    protected $table = 'app_history';

    protected $fillable = [
        'app_id',
        'type',
        'user',
        'created_at',
        'updated_at',
    ];


    protected $hidden = [
        'id',
    ];
}
