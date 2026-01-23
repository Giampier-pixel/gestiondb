@extends('layouts.admin')
@section('contenido')
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password">
            @error('password')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>
    
    @error('error')
        <p style="color: red;">{{ $message }}</p>
    @enderror
@endsection