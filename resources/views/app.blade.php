<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="{{ asset('/img/favicon/apple-touch-icon.png') }}"/>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/img/favicon/apple-touch-icon-57x57.png') }}"/>
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/img/favicon/apple-touch-icon-72x72.png') }}"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/img/favicon/apple-touch-icon-76x76.png') }}"/>
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/img/favicon/apple-touch-icon-114x114.png') }}"/>
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/img/favicon/apple-touch-icon-120x120.png') }}"/>
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/img/favicon/apple-touch-icon-144x144.png') }}"/>
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/img/favicon/apple-touch-icon-152x152.png') }}"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/img/favicon/apple-touch-icon-180x180.png') }}"/>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js')
    @inertiaHead
</head>
<body class="font-sans antialiased">
@inertia
</body>
</html>
