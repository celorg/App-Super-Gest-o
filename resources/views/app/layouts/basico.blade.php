<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>@yield('titulo')</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{asset('css/estilo_basico.css')}}">

    </head>

    <body>
        <header>
            @include('app.layouts._partials.topo')
        </header>
    <main>
        @yield('conteudo')
    </main>
        
    </body>
</html>