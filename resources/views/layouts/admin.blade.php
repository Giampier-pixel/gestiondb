<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración de certificados</title>
    @vite('resources/css/app.css')
</head>
<body class="w-full h-lvh flex flex-col items-stretch">
    <header class="bg-amber-400 shadow">
        <h1 class="text-2xl font-bold w-full text-center uppercase">Administración de certificados</h1>
        <p class="m-1 font-bold text-md text-center">FIS-UNCP</p>
        @auth
            <form action="{{route('logout')}}" method="POST" style="display: inline;">
                @csrf
                <div class="w-full text-center">
                <button class="p-3 font-bold text-red-500 cursor-pointer text-xl md:absolute md:top-0 md:right-0" type="submit">
                    Salir
                </button>
                </div>

            </form>
        @endauth
    </header>
    <div class="w-full py-3 grow">
        @yield('contenido')
    </div>
</body>
</html>