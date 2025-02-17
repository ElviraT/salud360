<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'name',
        'simbol',
        'is_principal'
    ];

    public function bank()
    {
        return $this->hasMany(Bank::class);
    }
}