@extends('layouts.admin')
@section('contenido')
<h1>
    Bienvenido administrador
</h1>
<hr>
<u>
    @foreach ($eventos as $evento)
        <li>
            <a href="{{ route('evento', ['evento_id' => $evento->id]) }}">
            {{ $evento->nombre }}
            </a>
        </li>
    @endforeach
</ul>
@endsection