<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') &mdash; {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:100,300,400,500,600,700|alatsi:400&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css'])
    @yield('viteResource')
</head>

<body class="text-gray-900 antialiased">
    @yield('content')
</body>

</html>
