<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Benefits extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_benefits');
    }
}