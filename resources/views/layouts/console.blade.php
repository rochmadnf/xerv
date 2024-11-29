<!DOCTYPE html>
<html lang="id" class="uk-theme-slate">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') &Colon; Console &mdash; {{ config('app.name') }} </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:100,300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Franken UI -->
    <link rel="stylesheet" href="https://unpkg.com/franken-ui@1.1.0/dist/css/core.min.css" />
    <script src="https://unpkg.com/franken-ui@1.1.0/dist/js/core.iife.js" type="module"></script>
    <script src="https://unpkg.com/franken-ui@1.1.0/dist/js/icon.iife.js" type="module"></script>

    @vite(['resources/css/app.css'])
    @yield('viteResource')
</head>

<body class="text-gray-900 antialiased">
    <div class="min-h-svh relative isolate flex w-full max-lg:flex-col">
        <x-sidebar.wrapper />
        <main class="flex min-w-0 flex-1 flex-col py-2.5 pb-2.5 pl-64">
            <div class="grow px-10 py-6">
                <div class="mx-auto max-w-6xl">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    @yield('script_page')

</body>

</html>
