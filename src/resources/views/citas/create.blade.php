<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nueva cita') }}
            </h2>
            <a href="{{ route('citas.index') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('citas.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="cliente_id" class="block text-gray-700">{{ __('ID de cliente') }}</label>
                            <input type="number" name="cliente_id" id="cliente_id" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('cliente_id') }}" required>
                            @error('cliente_id')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="marca" class="block text-gray-700">{{ __('Marca') }}</label>
                            <input type="text" name="marca" id="marca" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('marca') }}" required>
                            @error('marca')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="modelo" class="block text-gray-700">{{ __('Modelo') }}</label>
                            <input type="text" name="modelo" id="modelo" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('modelo') }}" required>
                            @error('modelo')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="matricula" class="block text-gray-700">{{ __('Matricula') }}</label>
                            <input type="text" name="matricula" id="matricula" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('matricula') }}" required>
                            @error('matricula')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="fecha" class="block text-gray-700">{{ __('Fecha') }}</label>
                            <input type="date" name="fecha" id="fecha" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('fecha') }}" required>
                            @error('fecha')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="hora" class="block text-gray-700">{{ __('Hora') }}</label>
                        <!-- Hay que formatear hora en el value al recogerla de BD (viene en formato HH:MM:SS) -->
                            <input type="time" name="hora" id="hora" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('hora') }}" required>
                            @error('hora')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="duracion_estimada" class="block text-gray-700">{{ __('Duración') }}</label>
                            <input type="number" name="duracion_estimada" id="duracion_estimada" class="w-full border-gray-300 rounded-md shadow-sm" min="1" value="{{ old('duracion') }}" required>
                            @error('duracion')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-outline-primary px-4 py-2 rounded-md">
                            {{ __('Crear') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>