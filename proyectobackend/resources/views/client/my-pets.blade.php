<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🐾 Mis Mascotas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($pets->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">No tienes mascotas registradas</p>
                            <p class="text-gray-400 text-sm mt-2">Contacta con la clínica para registrar a tu mascota</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($pets as $pet)
                            <div class="border rounded-lg p-6 hover:shadow-lg transition-shadow">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold text-gray-800">{{ $pet->name }}</h3>
                                    <span class="text-3xl">
                                        @if($pet->species == 'perro') 🐕
                                        @elseif($pet->species == 'gato') 🐈
                                        @elseif($pet->species == 'ave') 🦜
                                        @elseif($pet->species == 'conejo') 🐰
                                        @else 🐾
                                        @endif
                                    </span>
                                </div>
                                
                                <div class="space-y-2 text-sm text-gray-600">
                                    <p><strong>Especie:</strong> {{ ucfirst($pet->species) }}</p>
                                    @if($pet->breed)
                                    <p><strong>Raza:</strong> {{ $pet->breed }}</p>
                                    @endif
                                    @if($pet->birth_date)
                                    <p><strong>Edad:</strong> {{ $pet->birth_date->age }} años</p>
                                    <p><strong>Fecha de nacimiento:</strong> {{ $pet->birth_date->format('d/m/Y') }}</p>
                                    @endif
                                </div>
                                
                                @if($pet->medical_history)
                                <div class="mt-4 p-3 bg-blue-50 rounded text-sm">
                                    <p class="font-semibold text-blue-900 mb-1">Historial Médico:</p>
                                    <p class="text-blue-800">{{ $pet->medical_history }}</p>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6">
                            {{ $pets->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>