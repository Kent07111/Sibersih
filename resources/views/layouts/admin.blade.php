<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Talagasari2026')</title>
{{-- Leaflet CSS --}}
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
    @stack('css')
</head>

<body
    x-data="{ sidebarOpen: false }"
    class="bg-slate-100 font-sans antialiased"
>

    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Main Content --}}
        <div class="flex flex-1 flex-col overflow-hidden">

            {{-- Navbar --}}
            @include('partials.navbar')

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto">

                <div class="mx-auto max-w-7xl p-4 md:p-6 lg:p-8">

                    @yield('content')

                </div>

            </main>

        </div>

    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>

</html>
