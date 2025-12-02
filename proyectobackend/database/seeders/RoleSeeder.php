<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'admin', 'description' => 'Administrador del sistema']);
        Role::create(['name' => 'veterinario', 'description' => 'Veterinario']);
        Role::create(['name' => 'cliente', 'description' => 'Cliente/Dueño de mascota']);
    }
}