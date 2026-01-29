@extends('layouts.admin')
@section('contenido')
<div class="w-full h-full flex justify-center items-center bg-gray-200">
    <form method="POST" action="{{ route('login.post') }}" class="p-5 border-gray-300 shadow-md shadow-gray-400 rounded-xl bg-white w-8/12 max-w-lg">
        @csrf
        <div class="p-3 w-full flex flex-col items-stretch">
            <label for="email" class="text-lg test-gray-700 font-bold">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="p-1 m-2 text-lg border border-gray-500">
            @error('email')
                <p class="font-bold text-lg text-red-500"style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="p-3 w-full flex flex-col items-stretch">
            <label for="password"class="text-lg test-gray-700 font-bold">Contraseña:</label>
            <input type="password" id="password" name="password" class="p-1 m-2 text-lg border border-gray-500">
            @error('password')
                <p class="font-bold text-lg text-red-500" style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="text-center">
         <button class="p-4 text-xl uppercase text-white bg-blue-500 hover:bg-amber-500 rounded-lg cursor-pointer" type="submit">Iniciar Sesión</button>
        </div>

    </form>    
</div>
    
    @error('error')

        <p style="color: red;">{{ $message }}</p>
    @enderror
@endsection