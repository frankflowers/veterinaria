<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buscar los roles
        $adminRole = Role::where('name', 'admin')->first();
        $vetRole = Role::where('name', 'veterinario')->first();
        $clientRole = Role::where('name', 'cliente')->first();

        // Crear admin (si no existe ya)
        $admin = User::firstOrCreate(
            ['email' => 'admin@vet.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123'),
                'active' => true
            ]
        );
        if (!$admin->roles->contains($adminRole->id)) {
            $admin->roles()->attach($adminRole->id);
        }

        // Crear veterinarios
        $vet1 = User::create([
            'name' => 'Dr. Carlos Méndez',
            'email' => 'carlos@vet.com',
            'password' => Hash::make('password123'),
            'active' => true
        ]);
        $vet1->roles()->attach($vetRole->id);

        $vet2 = User::create([
            'name' => 'Dra. María González',
            'email' => 'maria@vet.com',
            'password' => Hash::make('password123'),
            'active' => true
        ]);
        $vet2->roles()->attach($vetRole->id);

        // Crear clientes
        $client1 = User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@cliente.com',
            'password' => Hash::make('password123'),
            'active' => true
        ]);
        $client1->roles()->attach($clientRole->id);

        $client2 = User::create([
            'name' => 'Francisco Jair',
            'email' => 'Franciscojair@cliente.com',
            'password' => Hash::make('password123'),
            'active' => true
        ]);
        $client2->roles()->attach($clientRole->id);

        $client3 = User::create([
            'name' => 'Luis Rodríguez',
            'email' => 'luis@cliente.com',
            'password' => Hash::make('password123'),
            'active' => true
        ]);
        $client3->roles()->attach($clientRole->id);
    }
}
