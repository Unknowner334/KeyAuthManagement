<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeyHistory extends Model
{
    protected $table = 'key_history';

    protected $fillable = [
        'key_id',
        'key',
        'device',
        'ip_address',
        'app_id',
        'status',
        'created_at',
        'updated_at',
    ];


    protected $hidden = [
        'id',
    ];
}
