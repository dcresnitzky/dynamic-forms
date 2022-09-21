<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dyanmic Form Generator</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('header.styles')

    <!-- Scripts -->
    <script type="text/javascript" src="{{ mix('js/app.js') }}" defer></script>
    @stack('header.scripts')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
    @yield('content')

    @stack('footer.scripts')
</body>
</html>
