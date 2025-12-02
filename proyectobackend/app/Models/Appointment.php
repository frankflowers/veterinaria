<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'pet_id',
        'veterinarian_id',
        'appointment_date',
        'reason',
        'diagnosis',
        'treatment',
        'status'
    ];

    protected $casts = [
        'appointment_date' => 'datetime'
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function veterinarian()
    {
        return $this->belongsTo(User::class, 'veterinarian_id');
    }
}