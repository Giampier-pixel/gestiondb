@extends('layouts.admin')
@section('contenido')
<div class="flex flex-col items-stretch">
<h2 class="text-3xl font-bold uppercase text-gray-800 text-center mb-4">
    {{ $evento->nombre }}
</h2>
<div class="py-3 my-4 w-full flex">
    @if ($evento->certificado_base!=null)
    <a href="{{ route('admin-certificados', ['evento_id' => $evento->id]) }}" class="text-lg font-bold p-3 bg-blue-500 text-white">
        Certificados
    </a>
    @endif
    <div class="grow"></div>
    <a href="{{ route('add-certificado-base', ['evento_id' => $evento->id]) }}" class="text-lg font-bold p-3 bg-amber-500 text-white ">
        Certificado base
    </a>


</div>
<h3 class="text-lg uppercase font-bold p-3 bg-gray-200">
    Organizadores
</h3>
<div class="text-justify">
    <a class="inline-block p-3 bg-blue-500 text-white rounded-md" href="{{ route('add-organizador', ['evento_id' => $evento->id]) }}">
    Agregar
</a>
</div>
<ul class="flex flex-col items-stretch">
    @foreach ($organizadores as $organizador)
        <li class="p-3">
            <p class="text-xl uppercase text-gray-900">
            {{ $organizador->paternal_surname }} {{ $organizador->maternal_surname }} {{ $organizador->name }}
            </p>
        </li>
        
    @endforeach
</ul>

<h3 class="text-lg uppercase font-bold p-3 bg-gray-200">
    Ponentes
</h3>
<div class="text-justify">
<a class="inline-block p-3 bg-blue-500 text-white rounded-md" href="{{ route('add-ponente', ['evento_id' => $evento->id]) }}">
    Agregar
</a>
</div>

<ul class="flex flex-col items-stretch">
    @foreach ($ponentes as $ponente)
        <li class="p-3">
            <p class="text-xl uppercase text-gray-900">
            {{ $ponente->paternal_surname }} {{ $ponente->maternal_surname }} {{ $ponente->name }}
            </p>
            <p>
                {{ $ponente->pivot->ponencia }}
            </p>

        </li>
        
    @endforeach
</ul>

<h3 class="text-lg uppercase font-bold p-3 bg-gray-200">
    Asistentes
</h3>
<ul class="flex flex-col items-stretch">
    @foreach ($asistentes as $asistente)
        <li class="p-3">
            <p class="text-xl uppercase text-gray-900">
            {{ $asistente->paternal_surname }} {{ $asistente->maternal_surname }} {{ $asistente->name }}
            </p>
        </li>
        
    @endforeach
</ul>

<h3 class="text-lg uppercase font-bold p-3 bg-gray-200">
    Pre inscritos
</h3>
<ul class="flex flex-col items-stretch">
    @foreach ($pre_registrados as $pre_registrado)
        <li>
            {{ $pre_registrado->paternal_surname }} {{ $pre_registrado->maternal_surname }} {{ $pre_registrado->name }}
        </li>
        
    @endforeach
</ul>
</div>
@endsection