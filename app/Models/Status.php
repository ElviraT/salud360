<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Status extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'color'
    ];

    public function limits(): HasMany
    {
        return $this->hasMany(Limit::class, 'status');
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'status');
    }

    public function teacher(): HasMany
    {
        return $this->hasMany(Teacher::class, 'idStatus');
    }

    public function representative(): HasMany
    {
        return $this->hasMany(Representative::class, 'id_status');
    }

    public function student(): HasMany
    {
        return $this->hasMany(Alumno::class, 'idStatus');
    }

    public function grade(): HasMany
    {
        return $this->hasMany(Grade::class, 'id_status');
    }

    public function group(): HasMany
    {
        return $this->hasMany(Group::class, 'id_status');
    }

    public function matter(): HasMany
    {
        return $this->hasMany(Matter::class, 'id_status');
    }

    public function modality(): HasMany
    {
        return $this->hasMany(Modality::class, 'id_status');
    }

    public function course(): HasMany
    {
        return $this->hasMany(Course::class, 'status_id');
    }
}
