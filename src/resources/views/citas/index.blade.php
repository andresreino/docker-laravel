<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Citas') }}
            </h2>
            <a href="{{ route('citas.create') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
                {{ __('Nueva cita') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="table-fixed w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 w-1/3">{{ __('Cliente') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/3">{{ __('Coche') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/3">{{ __('Matrícula') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/3">{{ __('Fecha') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/3">{{ __('Hora') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/3">{{ __('Duración') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/6 text-center">{{ __('') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($citas as $cita)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $cita->user->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $cita->marca }} - {{ $cita->modelo }}</td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $cita->matricula }}</td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $cita->fecha }}</td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $cita->hora }}</td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $cita->duracion_estimada }}</td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/6 text-center">
                                            <div class="flex justify-center items-center gap-1">
                                                <a href="{{ route('citas.show', $cita) }}" class="btn btn-sm btn-outline-primary" title="{{ __('Ver') }}">
                                                    <i class="bi bi-eye-fill text-primary p-2 border rounded-circle"></i>
                                                </a>

                                                <a href="{{ route('citas.edit', $cita) }}" class="btn btn-sm btn-outline-success" title="{{ __('Editar') }}">
                                                    <i class="bi bi-pencil-fill text-success p-2 border rounded-circle"></i>
                                                </a>

                                                <form action="{{ route('citas.destroy', $cita) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                            title="{{ __('Eliminar') }}"
                                                            onclick="return confirm('¿Estás seguro?')">
                                                        <i class="bi bi-trash-fill text-danger p-2 border rounded-circle"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>