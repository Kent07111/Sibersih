<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>

        @yield('title','SIBERSIH')

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

<body
    class="bg-slate-50 text-slate-700"
>

    @include('guest.partials.navbar')

    <main>

        @yield('content')

    </main>

    @include('guest.partials.footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>

        AOS.init({

            duration:800,

            once:true

        });

    </script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox/fancybox.umd.js"></script>

<script>

Fancybox.bind("[data-fancybox='gallery']",{

    Toolbar:{

        display:[
            "zoom",
            "fullscreen",
            "slideshow",
            "thumbs",
            "close"
        ]

    }

});

</script>
@if(session('success'))

<script>

document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({

        icon: 'success',

        title: 'Berhasil',

        text: '{{ session('success') }}',

        confirmButtonColor: '#16a34a',

        confirmButtonText: 'OK'

    });

});

</script>

@endif
    @stack('scripts')

</body>

</html>
