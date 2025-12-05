<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pagina principal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">¡Bienvenido, {{ Auth::user()->name }}!</h3>
                    
                    @if(Auth::user()->hasRole('admin'))
                        <p class="mb-4">Como administrador, tienes acceso completo al sistema.</p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="{{ route('users.index') }}" class="block p-6 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                                <h4 class="font-bold text-lg text-blue-900">👥 Usuarios</h4>
                                <p class="text-blue-700 text-sm">Gestionar usuarios del sistema</p>
                            </a>
                            <a href="{{ route('pets.index') }}" class="block p-6 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition">
                                <h4 class="font-bold text-lg text-green-900">🐾 Mascotas</h4>
                                <p class="text-green-700 text-sm">Gestionar mascotas registradas</p>
                            </a>
                            <a href="{{ route('appointments.index') }}" class="block p-6 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition">
                                <h4 class="font-bold text-lg text-purple-900">📅 Citas</h4>
                                <p class="text-purple-700 text-sm">Gestionar citas veterinarias</p>
                            </a>
                        </div>
                    @elseif(Auth::user()->hasRole('veterinario'))
                        <p class="mb-4">Como veterinario, puedes gestionar mascotas y citas.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('pets.index') }}" class="block p-6 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition">
                                <h4 class="font-bold text-lg text-green-900">🐾 Mascotas</h4>
                                <p class="text-green-700 text-sm">Ver y gestionar mascotas</p>
                            </a>
                            <a href="{{ route('appointments.index') }}" class="block p-6 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition">
                                <h4 class="font-bold text-lg text-purple-900">📅 Citas</h4>
                                <p class="text-purple-700 text-sm">Gestionar consultas y citas</p>
                            </a>
                        </div>
                    @elseif(Auth::user()->hasRole('cliente'))
                        <p class="mb-4">Bienvenido a tu portal de cliente. Aquí puedes ver la información de tus mascotas y citas.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('client.my-pets') }}" class="block p-6 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                                <h4 class="font-bold text-lg text-blue-900">🐾 Mis Mascotas</h4>
                                <p class="text-blue-700 text-sm">Ver información de tus mascotas</p>
                            </a>
                            <a href="{{ route('client.my-appointments') }}" class="block p-6 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition">
                                <h4 class="font-bold text-lg text-indigo-900">📅 Mis Citas</h4>
                                <p class="text-indigo-700 text-sm">Ver historial de citas</p>
                            </a>
                        </div>
                    @else
                        <p class="text-gray-600">No tienes un rol asignado. Contacta al administrador.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>