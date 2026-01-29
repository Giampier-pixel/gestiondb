@extends('layouts.admin')
@section('contenido')
<div class="flex flex-col items-stretch">
<h1 class="text-3xl uppercase text-gray-800 text-shadow-xs font-bold mb-4 text-center">
    Bienvenido administrador
</h1>
<div class="m-3 text-right">
    <a href="{{ route('add-evento') }}" class="p-3 bg-blue-500 text-white text-lg rounded-2xl">
        Agregar evento
    </a>
</div>
<ul class="flex flex-col items-stretch px-4">
    @foreach ($eventos as $evento)
        <li class="my-2 border-b border-b-gray-500">
            <a href="{{ route('evento', ['evento_id' => $evento->id]) }}" class="block w-full text-2xl font-bold text-blue-500 ">
            {{ $evento->nombre }}
            </a>
        </li>
    @endforeach
</ul>
</div>

@endsection