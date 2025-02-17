<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transactionable_id',
        'transactionable_type',
        'order_id',
        'amount',
        'bank_id',
        'currency',
        'payment_method',
        'payment_status',
        'transaction_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function transactionable()
    {
        return $this->morphTo();
    }
    // public function plan()
    // {
    //     return $this->belongsTo(Plan::class);
    // }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}