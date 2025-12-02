<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['pet.owner', 'veterinarian'])
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $pets = Pet::where('active', true)->with('owner')->get();
        $veterinarians = User::whereHas('roles', function($q) {
            $q->where('name', 'veterinario');
        })->get();
        
        return view('appointments.create', compact('pets', 'veterinarians'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'veterinarian_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:now',
            'reason' => 'required|string|max:255'
        ]);

        Appointment::create($validated);

        return redirect()->route('appointments.index')
            ->with('success', 'Cita agendada exitosamente');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['pet.owner', 'veterinarian']);
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $pets = Pet::where('active', true)->with('owner')->get();
        $veterinarians = User::whereHas('roles', function($q) {
            $q->where('name', 'veterinario');
        })->get();
        
        return view('appointments.edit', compact('appointment', 'pets', 'veterinarians'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'veterinarian_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'reason' => 'required|string|max:255',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'status' => 'required|in:pendiente,completada,cancelada'
        ]);

        $appointment->update($validated);

        return redirect()->route('appointments.index')
            ->with('success', 'Cita actualizada exitosamente');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelada']);
        return redirect()->route('appointments.index')
            ->with('success', 'Cita cancelada');
    }
}