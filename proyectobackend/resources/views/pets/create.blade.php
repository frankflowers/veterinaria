<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Nueva Mascota
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('pets.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de la mascota</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Especie</label>
                                <select name="species" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="perro">Perro</option>
                                    <option value="gato">Gato</option>
                                    <option value="ave">Ave</option>
                                    <option value="conejo">Conejo</option>
                                    <option value="otro">Otro</option>
                                </select>
                                @error('species')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Raza (opcional)</label>
                                <input type="text" name="breed" value="{{ old('breed') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Fecha de nacimiento (opcional)</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Dueño</label>
                            <select name="owner_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="">Seleccionar dueño...</option>
                                @foreach($owners as $owner)
                                    <option value="{{ $owner->id }}">{{ $owner->name }} ({{ $owner->email }})</option>
                                @endforeach
                            </select>
                            @error('owner_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Historial médico (opcional)</label>
                            <textarea name="medical_history" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ old('medical_history') }}</textarea>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Registrar Mascota
                            </button>
                            <a href="{{ route('pets.index') }}" class="text-gray-600 hover:text-gray-900">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>