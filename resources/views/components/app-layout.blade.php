<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Zakat App') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- Navbar / Header kalau ada --}}
    @auth
        @includeIf('layouts.navigation')
    @endauth

    {{-- 🔑 INI KUNCI --}}
    <main class="py-6">
        {{ $slot }}
    </main>

</body>

</html>
