@extends('layouts.admin')
@section('contenido')
<a href="{{route('dashboard')}}">
    Atrás
</a>
<form action="{{ route('add-evento') }}" method="POST">
    @csrf
    <legend>
        Crear evento
    </legend>
    
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <label for="name">
            Nombre:
            <input required type="text" name="name" id="name" placeholder="Nombre del evento" value="{{ old('name') }}">
        </label>
    </div>
    <div>
        <label for="fecha">
            Fecha:
            <input required type="date" name="fecha" id="fecha" placeholder="Fecha del evento" value="{{ old('fecha') }}">
        </label>
    </div>
    <div>
        <label for="address">
            Dirección:
            <input type="text" name="address" id="address" placeholder="Dirección del evento" value="{{ old('address') }}">
        </label>
    </div>
    <div>
        <label for="url">
            URL:
            <input type="url" name="url" id="url" placeholder="URL del evento" value="{{ old('url') }}">
        </label>
    </div>
    <button type="submit">
        Crear
    </button>
</form>
@endsection