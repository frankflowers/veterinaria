<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function myPets()
    {
        $pets = Auth::user()->pets()->where('active', true)->paginate(10);
        return view('client.my-pets', compact('pets'));
    }

    public function myAppointments()
    {
        $user = Auth::user();
        
        // Obtener todas las citas de las mascotas del cliente
        $appointments = \App\Models\Appointment::whereHas('pet', function($query) use ($user) {
            $query->where('owner_id', $user->id);
        })
        ->with(['pet', 'veterinarian'])
        ->orderBy('appointment_date', 'desc')
        ->paginate(10);
        
        return view('client.my-appointments', compact('appointments'));
    }
}