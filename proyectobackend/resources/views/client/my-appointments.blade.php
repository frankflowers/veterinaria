<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📅 Mis Citas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($appointments->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">No tienes citas registradas</p>
                            <p class="text-gray-400 text-sm mt-2">Contacta con la clínica para agendar una cita</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($appointments as $appointment)
                            <div class="border rounded-lg p-6 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">
                                            Cita para {{ $appointment->pet->name }}
                                        </h3>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <strong>Fecha:</strong> {{ $appointment->appointment_date->format('d/m/Y') }} a las {{ $appointment->appointment_date->format('H:i') }}
                                        </p>
                                    </div>
                                    @php
                                        $statusColors = [
                                            'pendiente' => 'bg-yellow-100 text-yellow-800',
                                            'completada' => 'bg-green-100 text-green-800',
                                            'cancelada' => 'bg-red-100 text-red-800'
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$appointment->status] }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <p class="text-gray-600"><strong>Veterinario:</strong> {{ $appointment->veterinarian->name }}</p>
                                        <p class="text-gray-600 mt-2"><strong>Motivo:</strong> {{ $appointment->reason }}</p>
                                    </div>
                                    
                                    @if($appointment->diagnosis || $appointment->treatment)
                                    <div class="space-y-2">
                                        @if($appointment->diagnosis)
                                        <div class="p-3 bg-blue-50 rounded">
                                            <p class="font-semibold text-blue-900">Diagnóstico:</p>
                                            <p class="text-blue-800 text-sm mt-1">{{ $appointment->diagnosis }}</p>
                                        </div>
                                        @endif
                                        
                                        @if($appointment->treatment)
                                        <div class="p-3 bg-green-50 rounded">
                                            <p class="font-semibold text-green-900">Tratamiento:</p>
                                            <p class="text-green-800 text-sm mt-1">{{ $appointment->treatment }}</p>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6">
                            {{ $appointments->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>