@extends('layouts.admin')
@section('contenido')
<div class="flex items-center justify-center">
<form method="post" class="w-lg shadow-xl shadow-gray-300 px-4 border border-gray-100">
    @csrf
    <legend class="text-2xl font-bold text-gray-700 text-center p-4">
        Agregando ponente
    </legend>
    <div  class="flex flex-col">
        <label for="ponente" class="text-lg font-semibold text-gray-800 py-3">
            Ponente
        </label>
        <select class="p-2 text-lg text-gray-900 border border-amber-600" name="ponente" id="ponente">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->paternal_surname }} {{ $user->maternal_surname }} {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('ponente')
        <p class="text-red-500 text-lg">
            {{ $message }}
        </p>
            
        @enderror
    </div>
    <div class="p-2 text-lg text-gray-900 border border-amber-600">
        <label for="ponencia">
            Ponencia:
        </label>
        <input required id="ponencia" name="ponencia" type="text" placeholder="Titulo de la ponencia">
    </div>
    <div class="text-center">
    <button type="submit" class="my-4 p-4 bg-blue-500 text-white-lg font-bold rounded-md text-white shadow-xl hover:bg-blue-700 cursor-pointer">
        Agregar
    </button>
    </div>

</form>
</div>
@endsection