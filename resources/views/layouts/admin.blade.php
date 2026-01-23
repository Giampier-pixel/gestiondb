<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración de certificados</title>
</head>
<body>
    <header>
        <h1>Administración de certificados</h1>
        <p>FIS-UNCP</p>
        @auth
            <form action="{{route('logout')}}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: blue; text-decoration: underline; cursor: pointer;">
                    Salir
                </button>
            </form>
        @endauth
    </header>
    <div>
        @yield('contenido')
    </div>
</body>
</html>