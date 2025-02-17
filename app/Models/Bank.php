<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable =
    [
        'name',
        'titular',
        'codigo',
        'amount',
        'Account',
        'user_id',
        'currency_id',
        'extra',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}