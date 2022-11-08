<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakeAppointment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime:Y-m-d g:i a',
    ];
}
