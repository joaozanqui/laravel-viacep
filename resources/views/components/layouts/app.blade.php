<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>
        Teste
    </title>

    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>

    @yield('navbar')

    @yield('content')

    @stack('scripts')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>
