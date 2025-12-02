<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'name',
        'species',
        'breed',
        'birth_date',
        'medical_history',
        'owner_id',
        'active'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'active' => 'boolean'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}