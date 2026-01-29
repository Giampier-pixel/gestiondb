@extends('layouts.admin')
@section('contenido')
<div class="flex flex-col items-stretch">
<h2 class="text-3xl font-bold uppercase text-gray-800 text-center mb-4">
    {{ $evento->nombre }}
</h2>
<h3 class="text-lg uppercase font-bold p-3 bg-gray-200">
    Organizadores
</h3>
<div class="text-justify">
    <a class="inline-block p-3 bg-blue-500 text-white rounded-md" href="{{ route('generar-organizadores', ['evento_id' => $evento->id]) }}">
    Generar certificados
</a>
</div>
<ul class="flex flex-col items-stretch">
    @foreach ($organizadores as $organizador)
        <li class="p-4 flex flex-nowrap">
            <div class="flex flex-col items-stretch grow">
            <p class="text-xl uppercase text-gray-900">
            {{ $organizador->paternal_surname }} {{ $organizador->maternal_surname }} {{ $organizador->name }}
            </p>
            </div>
            <div class="flex items-center justify-center">
            @if ($organizador->pivot->certificado_creado)
                @foreach ($certificados as $certificado)
                    @if ($certificado->tipo_id == 4 && $certificado->user_id == $organizador->id)
                        <a href="{{route('documento',['certificado_id'=>$certificado->id])}}"
                        class="text-xl text-green-600 font-semibold p-2" target="_blank">
                        Ver certificados    
                    @endif
                @endforeach
            @else
            <span class="bg-red-500 text-white px-2 py-1 rounded">No creado</span>
            @endif
            </div>

        </li>
    @endforeach
</ul>
<h3 class="text-lg uppercase font-bold p-3 bg-gray-200">
    Ponentes
</h3>
<div class="text-justify">
<a class="inline-block p-3 bg-blue-500 text-white rounded-md" href="{{ route('generar-ponentes', ['evento_id' => $evento->id]) }}">
    Generar certificados
</a>
</div>
<ul class="flex flex-col items-stretch">
    @foreach ($ponentes as $ponente)
        <li class="p-4 flex flex-nowrap">
            <div class="flex flex-col items-stretch grow">
            <p class="text-xl uppercase text-gray-900">
            {{ $ponente->paternal_surname }} {{ $ponente->maternal_surname }} {{ $ponente->name }}
            </p>
            <p class="px-7 text-md uppercase text-gray-700">
                {{ $ponente->pivot->ponencia }}
            </p>
            </div>
            <div class="flex items-center justify-center">
                @if ($ponente->pivot->certificado_creado)
                @foreach ($certificados as $certificado)
                    @if ($certificado->tipo_id == 3 && $certificado->user_id == $ponente->id)
                        <a href="{{route('documento',['certificado_id'=>$certificado->id])}}"
                        class="text-xl text-green-600 font-semibold p-2" target="_blank">
                        Ver certificados    
                    @endif
                @endforeach
                @else
                    <span class="bg-red-500 text-white px-2 py-1 rounded">No creado</span>
                @endif
            </div>


        </li>
    @endforeach
</ul>
</div>
@endsection