<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    use HasFactory;
    protected $table = 'model_has_roles';

    public function user()
    {
        return $this->hasMany(User::class, 'model_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
