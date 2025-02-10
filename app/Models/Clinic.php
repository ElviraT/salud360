<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable =
    [
        'name',
        'address',
        'phone',
        'email',
        'logo',
        'user_id',
        'description',
        'active',
    ];
}
