<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Cita
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                <form method="POST" action="{{ route('appointments.update', $appointment) }}" id="edit-appointment-form">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Mascota</label>
                            <select name="pet_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}" {{ $appointment->pet_id == $pet->id ? 'selected' : '' }}>
                                        {{ $pet->name }} - {{ ucfirst($pet->species) }} (Dueño: {{ $pet->owner->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pet_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Veterinario</label>
                            <select name="veterinarian_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                                @foreach($veterinarians as $vet)
                                    <option value="{{ $vet->id }}" {{ $appointment->veterinarian_id == $vet->id ? 'selected' : '' }}>
                                        {{ $vet->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('veterinarian_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Fecha y Hora de la Cita</label>
                            <input type="datetime-local" name="appointment_date" value="{{ old('appointment_date', $appointment->appointment_date->format('Y-m-d\TH:i')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                            @error('appointment_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Motivo de la consulta</label>
                            <input type="text" name="reason" value="{{ old('reason', $appointment->reason) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                            @error('reason')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Estado</label>
                            <select name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="pendiente" {{ $appointment->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="completada" {{ $appointment->status == 'completada' ? 'selected' : '' }}>Completada</option>
                                <option value="cancelada" {{ $appointment->status == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Diagnóstico (opcional)</label>
                            <textarea name="diagnosis" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" placeholder="Registra el diagnóstico después de la consulta">{{ old('diagnosis', $appointment->diagnosis) }}</textarea>
                            @error('diagnosis')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tratamiento (opcional)</label>
                            <textarea name="treatment" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" placeholder="Registra el tratamiento prescrito">{{ old('treatment', $appointment->treatment) }}</textarea>
                            @error('treatment')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Actualizar Cita
                            </button>
                            <a href="{{ route('appointments.index') }}" class="text-gray-600 hover:text-gray-900">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('edit-appointment-form');
    
    // Guardar valores originales
    const originalValues = {
        pet_id: document.querySelector('select[name="pet_id"]').value,
        veterinarian_id: document.querySelector('select[name="veterinarian_id"]').value,
        appointment_date: document.querySelector('input[name="appointment_date"]').value,
        reason: document.querySelector('input[name="reason"]').value,
        status: document.querySelector('select[name="status"]').value,
        diagnosis: document.querySelector('textarea[name="diagnosis"]').value,
        treatment: document.querySelector('textarea[name="treatment"]').value
    };

    form.addEventListener('submit', function(e) {
        const currentValues = {
            pet_id: document.querySelector('select[name="pet_id"]').value,
            veterinarian_id: document.querySelector('select[name="veterinarian_id"]').value,
            appointment_date: document.querySelector('input[name="appointment_date"]').value,
            reason: document.querySelector('input[name="reason"]').value,
            status: document.querySelector('select[name="status"]').value,
            diagnosis: document.querySelector('textarea[name="diagnosis"]').value,
            treatment: document.querySelector('textarea[name="treatment"]').value
        };

        // Verificar si hay cambios
        const hasChanges = JSON.stringify(originalValues) !== JSON.stringify(currentValues);

        if (!hasChanges) {
            e.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'Sin cambios',
                text: 'Debes modificar al menos un campo para actualizar',
                confirmButtonColor: '#3B82F6'
            });
        }
    });
});
</script>
</x-app-layout>