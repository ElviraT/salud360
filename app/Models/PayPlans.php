<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayPlans extends Model
{
    protected $fillable = [
        'plan_id',
        'user_id',
        'transaction_id',
        'payment_methods_id',
        'date',
        'amount',
        'reference',
        'status'
    ];
}