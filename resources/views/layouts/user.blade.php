<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>

        @yield('title','Talagasari2026')

    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    {{-- Leaflet --}}
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox/fancybox.css"
/>
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >

    {{-- AOS --}}
    <link
        rel="stylesheet"
        href="https://unpkg.com/aos@2.3.4/dist/aos.css"
    >

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

</head>

<body class="bg-slate-100 text-slate-700">

    @include('user.partials.navbar')

    <main class="pt-24 min-h-screen">

        <div class="mx-auto max-w-7xl px-6 py-8">

            @yield('content')

        </div>

    </main>

    @include('guest.partials.footer')

</body>

</html>
