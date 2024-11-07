<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') &mdash; {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:100,300,400,500,600,700|kode-mono:700&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css'])
    @yield('viteResource')
</head>

<body class="bg-slate-50 text-gray-900 antialiased">
    <x-preview-card />
    <main class="flex min-h-screen w-full flex-col items-center justify-center gap-y-6 bg-bi-slate-300/40">
        @yield('content')
        <footer class="w-full text-center text-sm font-medium text-gray-500">
            &copy; 2024 SI-AKIP BRIDA
        </footer>
    </main>

    @yield('script_page')
</body>

</html>
