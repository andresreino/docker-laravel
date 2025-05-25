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
                        <!-- Select de clientes -->
                        <div class="mb-4">
                            <label for="cliente_id" class="block text-gray-700">Cliente</label>
                            <select id="cliente_id" name="cliente_id" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('cliente_id') }}" required>
                                <option value="">Selecciona un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select de coches (vacío al inicio) -->
                        <div class="mb-4">
                            <label for="coche_id">Coche</label>
                            <select id="coche_id" name="coche_id" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('coche_id') }}"required>
                                <option value="">Selecciona un coche</option>
                                <!-- Se rellenará con JS -->
                            </select>
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
    <!-- Script para cargar en el segundo select los coches de usuario seleccionado en primer select-->
    <script src="{{ asset('js/cargarCoches.js') }}"></script>
</x-app-layout>