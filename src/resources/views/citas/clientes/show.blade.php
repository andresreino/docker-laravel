<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles de la cita') }}
            </h2>
            <a href="{{ route('citas.clientes.index') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 bg-white rounded-lg shadow-md">
                    <ul class="space-y-6">
                        <li class="flex items-center">
                            <i class="bi bi-person-fill text-blue-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Vehículo:') }}</span>
                            <span class="ms-2 text-gray-900">{{ $cita->marca }} - {{$cita->modelo}}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-person-fill text-blue-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Matrícula:') }}</span>
                            <span class="ms-2 text-gray-900">{{ $cita->matricula }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-envelope-fill text-green-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Fecha:') }}</span>
                            <span class="ms-2 text-gray-900">{{ $cita->fecha }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-person-badge-fill text-purple-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Duración estimada:') }}</span>
                            <span class="ms-2 text-gray-900">{{ $cita->duracion_estimada }}</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>