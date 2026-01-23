@extends('layouts.admin')
@section('contenido')
<h2>
    Nombre del evento
</h2>
<hr>
<h3>
    Organizadores
</h3>
<ul>
    @foreach ($organizadores as $organizador)
        <li>
            {{ $organizador->paternal_surname }} {{ $organizador->maternal_surname }} {{ $organizador->name }}
        </li>
        
    @endforeach
</ul>
<hr>
<h3>
    Ponentes
</h3>
<ul>
    @foreach ($ponentes as $ponente)
        <li>
            {{ $ponente->paternal_surname }} {{ $ponente->maternal_surname }} {{ $ponente->name }}
        </li>
        
    @endforeach
</ul>
<hr>
<h3>
    Asistentes
</h3>
<ul>
    @foreach ($asistentes as $asistente)
        <li>
            {{ $asistente->paternal_surname }} {{ $asistente->maternal_surname }} {{ $asistente->name }}
        </li>
        
    @endforeach
</ul>
<hr>
<h3>
    Pre inscritos
</h3>
<ul>
    @foreach ($pre_registrados as $pre_registrado)
        <li>
            {{ $pre_registrado->paternal_surname }} {{ $pre_registrado->maternal_surname }} {{ $pre_registrado->name }}
        </li>
        
    @endforeach
</ul>
@endsection