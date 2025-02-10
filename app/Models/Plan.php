<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function benefits()
    {
        return $this->belongsToMany(Benefits::class, 'plan_benefits');
    }
}