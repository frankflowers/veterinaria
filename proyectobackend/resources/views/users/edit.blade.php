<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Usuario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('users.update', $user) }}" id="edit-user-form">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Rol</label>
                            <select name="role_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->roles->first()?->id == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="active" value="1" {{ $user->active ? 'checked' : '' }} class="mr-2">
                                <span class="text-sm text-gray-700">Usuario activo</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Actualizar
                            </button>
                            <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-900">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('edit-user-form');
    
    if (!form) return;
    
    // Guardar valores originales
    const originalValues = {
        name: document.querySelector('input[name="name"]').value.trim(),
        email: document.querySelector('input[name="email"]').value.trim(),
        role_id: document.querySelector('select[name="role_id"]').value,
        active: document.querySelector('input[name="active"]').checked
    };

    console.log('Valores originales:', originalValues);

    form.addEventListener('submit', function(e) {
        const currentValues = {
            name: document.querySelector('input[name="name"]').value.trim(),
            email: document.querySelector('input[name="email"]').value.trim(),
            role_id: document.querySelector('select[name="role_id"]').value,
            active: document.querySelector('input[name="active"]').checked
        };

        console.log('Valores actuales:', currentValues);

        // Verificar si hay cambios
        const hasChanges = 
            originalValues.name !== currentValues.name ||
            originalValues.email !== currentValues.email ||
            originalValues.role_id !== currentValues.role_id ||
            originalValues.active !== currentValues.active;

        console.log('¿Hay cambios?', hasChanges);

        if (!hasChanges) {
            e.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'Sin cambios',
                text: 'Debes modificar al menos un campo para actualizar',
                confirmButtonColor: '#3B82F6'
            });
            return false;
        }
    });
});
</script>
</x-app-layout>