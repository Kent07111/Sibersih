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

<style>
.article-content{
    line-height:1.8;
    color:#334155;
}

.article-content p{
    margin:1rem 0;
}

.article-content h1{
    font-size:2.25rem;
    font-weight:700;
    margin:1.5rem 0 1rem;
}

.article-content h2{
    font-size:1.8rem;
    font-weight:700;
    margin:1.5rem 0 1rem;
}

.article-content h3{
    font-size:1.5rem;
    font-weight:600;
    margin:1.25rem 0 .75rem;
}

.article-content ul{
    list-style:disc;
    padding-left:2rem;
    margin:1rem 0;
}

.article-content ol{
    list-style:decimal;
    padding-left:2rem;
    margin:1rem 0;
}

.article-content li{
    margin:.5rem 0;
}

.article-content img{
    display:block;
    max-width:100%;
    height:auto;
    margin:1.5rem auto;
    border-radius:16px;
}

.article-content blockquote{
    border-left:4px solid #16a34a;
    padding-left:1rem;
    color:#475569;
    margin:1rem 0;
    font-style:italic;
}

.article-content table{
    width:100%;
    border-collapse:collapse;
    margin:1rem 0;
}

.article-content table th,
.article-content table td{
    border:1px solid #d1d5db;
    padding:.75rem;
}

.article-content a{
    color:#15803d;
    text-decoration:underline;
}

.article-content code{
    background:#f1f5f9;
    padding:.2rem .4rem;
    border-radius:4px;
}

.article-content pre{
    background:#0f172a;
    color:#fff;
    padding:1rem;
    border-radius:12px;
    overflow:auto;
}
</style>
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
