<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->role === 'taller')
                        <p>¡Hola, {{auth()->user()->name}}! Estás conectado con funciones de taller.</p> 
                        ¡Bienvenido al panel del taller! Aquí puedes gestionar los vehículos, usuarios y citas de los clientes.
                    @else
                        <p>¡Hola, {{auth()->user()->name}}! Aquí puedes consultar tus citas y solicitar una nueva.</p> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
