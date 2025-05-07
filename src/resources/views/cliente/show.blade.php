@extends('layouts.app')

@section('content')

    <h1 class="text-center">Citas del Cliente</h1>

    <div class="list-group">
        @foreach ($citas as $cita)
            <a href="#" class="list-group-item list-group-item-action">
                Cita {{ $cita->id }} - Cliente: {{ $cita->cliente_id }} 
            </a>
        @endforeach
    </div>


@endsection