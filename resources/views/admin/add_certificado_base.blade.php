@extends('layouts.admin')
@section('contenido')
<a href="{{route('evento', ['evento_id' => $evento_id])}}" class="p-3 bg-purple-500 text-white my-2 inline-block">
    Atrás
</a>
<form action="{{ route('add-certificado-base', ['evento_id' => $evento_id]) }}" method="POST" enctype="multipart/form-data" class="mx-auto w-10/12 min-w-md max-w-lg p-4 border border-gray-200 shadow-md">
    @csrf
    <legend class="text-2xl text-center py-4 font-bold mb-4">
        Certificado base
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

    <div class="flex flex-col items-stretch">
        <label for="base" class="text-lg font-semibold">
            Certificado base:
        </label>
        <input class="p-3 border" type="file" name="base" id="base" accept="image/*">
        @error('base')
        <p class="p-3 text-red-500 text-lg">
            {{ $message }}
        </p>
        @enderror
    </div>
    <div>
        <button class="p-3 bg-green-500 text-white" type="submit">
            Subir
        </button>
    </div>
</form>
@endsection