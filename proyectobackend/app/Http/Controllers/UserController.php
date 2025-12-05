<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->roles()->attach($validated['role_id']);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }
public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role_id' => 'required|exists:roles,id'
    ]);

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'active' => $request->boolean('active') // Esto es mejor, convierte automáticamente
    ]);

    $user->roles()->sync([$validated['role_id']]);

    return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
}

    public function destroy(User $user)
    {
        $user->update(['active' => false]);
        return redirect()->route('users.index')->with('success', 'Usuario desactivado correctamente');
    }

public function forceDelete($id)
{
    $user = User::findOrFail($id);
    
    if ($user->active) {
        return redirect()->route('users.index')->with('error', 'Solo se pueden eliminar usuarios inactivos');
    }
    
    $user->delete();
    return redirect()->route('users.index')->with('success', 'Usuario eliminado permanentemente');
}
}
