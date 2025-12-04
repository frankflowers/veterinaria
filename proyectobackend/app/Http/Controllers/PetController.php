<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('owner')->paginate(10);
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        $owners = User::whereHas('roles', function($q) {
            $q->where('name', 'cliente');
        })->get();
        return view('pets.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'medical_history' => 'nullable|string',
            'owner_id' => 'required|exists:users,id'
        ]);

        Pet::create($validated);

        return redirect()->route('pets.index')->with('success', 'Mascota registrada exitosamente');
    }

    public function show(Pet $pet)
    {
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        $owners = User::whereHas('roles', function($q) {
            $q->where('name', 'cliente');
        })->get();
        return view('pets.edit', compact('pet', 'owners'));
    }

    public function update(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'medical_history' => 'nullable|string',
            'owner_id' => 'required|exists:users,id',
            'active' => 'boolean'
        ]);

        // Verificar si hay cambios
        $hasChanges = false;
        
        if ($pet->name != $validated['name'] || 
            $pet->species != $validated['species'] || 
            $pet->breed != $validated['breed'] ||
            $pet->birth_date != $validated['birth_date'] ||
            $pet->medical_history != $validated['medical_history'] ||
            $pet->owner_id != $validated['owner_id'] ||
            $pet->active != $request->has('active')) {
            $hasChanges = true;
        }

        if (!$hasChanges) {
            return redirect()->route('pets.index')->with('warning', 'No se realizaron cambios');
        }

        $validated['active'] = $request->has('active');
        $pet->update($validated);

        return redirect()->route('pets.index')->with('success', 'Mascota actualizada correctamente');
    }

    public function destroy(Pet $pet)
    {
        $pet->update(['active' => false]);
        return redirect()->route('pets.index')->with('success', 'Mascota desactivada correctamente');
    }
}