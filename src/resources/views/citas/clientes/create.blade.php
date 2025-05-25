<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nueva cita') }}
            </h2>
            <a href="{{ route('citas.clientes.index') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('citas.clientes.store') }}" method="POST">
                        @csrf
                        <!-- Introducimos campo oculto para que envíe datos de id del cliente que pide la cita -->
                            <input type="hidden" name="cliente_id" id="cliente_id" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ Auth::id() }}" required>
                            @error('cliente_id')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        <div class="mb-4">
                            <label for="coche_id" class="block text-sm font-medium text-gray-700">Selecciona tu coche</label>
                            <select id="coche_id" name="coche_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Elige un coche --</option>
                                @foreach ($coches as $coche)
                                    <option value="{{ $coche->id }}">
                                        {{ $coche->marca }} {{ $coche->modelo }} - {{ $coche->matricula }} 
                                    </option>
                                @endforeach
                            </select>
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