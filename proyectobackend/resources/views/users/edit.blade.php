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
                    <form method="POST" action="{{ route('users.update', $user) }}">
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
                                <input type="checkbox" name="active" {{ $user->active ? 'checked' : '' }} class="mr-2">
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
</x-app-layout>