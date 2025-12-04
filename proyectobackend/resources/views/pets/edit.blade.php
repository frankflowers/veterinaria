<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Mascota: {{ $pet->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
             <form method="POST" action="{{ route('pets.update', $pet) }}" id="edit-pet-form">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de la mascota</label>
                            <input type="text" name="name" value="{{ old('name', $pet->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Especie</label>
                                <select name="species" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                                    <option value="perro" {{ $pet->species == 'perro' ? 'selected' : '' }}>Perro</option>
                                    <option value="gato" {{ $pet->species == 'gato' ? 'selected' : '' }}>Gato</option>
                                    <option value="ave" {{ $pet->species == 'ave' ? 'selected' : '' }}>Ave</option>
                                    <option value="conejo" {{ $pet->species == 'conejo' ? 'selected' : '' }}>Conejo</option>
                                    <option value="otro" {{ $pet->species == 'otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Raza (opcional)</label>
                                <input type="text" name="breed" value="{{ old('breed', $pet->breed) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Fecha de nacimiento</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $pet->birth_date?->format('Y-m-d')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Dueño</label>
                            <select name="owner_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                                @foreach($owners as $owner)
                                    <option value="{{ $owner->id }}" {{ $pet->owner_id == $owner->id ? 'selected' : '' }}>
                                        {{ $owner->name }} ({{ $owner->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Historial médico</label>
                            <textarea name="medical_history" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ old('medical_history', $pet->medical_history) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="active" {{ $pet->active ? 'checked' : '' }} class="mr-2">
                                <span class="text-sm text-gray-700">Mascota activa</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Actualizar
                            </button>
                            <a href="{{ route('pets.index') }}" class="text-gray-600 hover:text-gray-900">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('edit-pet-form');
    
    // Guardar valores originales
    const originalValues = {
        name: document.querySelector('input[name="name"]').value,
        species: document.querySelector('select[name="species"]').value,
        breed: document.querySelector('input[name="breed"]').value,
        birth_date: document.querySelector('input[name="birth_date"]').value,
        owner_id: document.querySelector('select[name="owner_id"]').value,
        medical_history: document.querySelector('textarea[name="medical_history"]').value,
        active: document.querySelector('input[name="active"]')?.checked || false
    };

    form.addEventListener('submit', function(e) {
        const currentValues = {
            name: document.querySelector('input[name="name"]').value,
            species: document.querySelector('select[name="species"]').value,
            breed: document.querySelector('input[name="breed"]').value,
            birth_date: document.querySelector('input[name="birth_date"]').value,
            owner_id: document.querySelector('select[name="owner_id"]').value,
            medical_history: document.querySelector('textarea[name="medical_history"]').value,
            active: document.querySelector('input[name="active"]')?.checked || false
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