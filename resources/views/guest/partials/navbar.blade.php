<nav
    x-data="{ open:false }"
    id="navbar"
    class="fixed top-0 left-0 z-50 w-full transition-all duration-300
    {{ request()->routeIs('guest.home') ? '' : 'navbar-scroll' }}"
>

    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

        {{-- Logo --}}
        <a
            href="{{ route('guest.home') }}"
            class="flex items-center gap-3"
        >

            @if($setting && $setting->logo)

                <img
                    src="{{ asset('storage/'.$setting->logo) }}"
                    class="h-12 w-12 object-contain"
                >

            @else

    <img
        src="{{ asset('logo.png') }}"
        class="h-12 w-12 object-contain"
    >

@endif

            <div>

                <h1
                    class="text-xl font-bold text-white navbar-text"
                >

                    {{ $setting->nama_desa ?? 'Tidak ada data' }}

                </h1>

                <p
                    class="text-xs text-white/80 navbar-text"
                >

                    {{ $setting->name }}

                </p>

            </div>

        </a>

        {{-- Desktop Menu --}}
        <div
            class="hidden items-center gap-8 lg:flex"
        >

            <a href="/" class="menu-link">Home</a>

            <a href="/edukasi" class="menu-link">Edukasi</a>

            <a href="/kegiatan" class="menu-link">Kegiatan</a>

            <a href="/galeri" class="menu-link">Galeri</a>

            <a href="/jadwal" class="menu-link">Jadwal</a>

            <a href="/lapor" class="menu-link">Lapor</a>

            <a href="#lapor" class="menu-link">Bank Sampah</a>
            <a
                href="{{ route('login') }}"
                class="rounded-xl bg-green-600 px-5 py-2 font-semibold text-white hover:bg-green-700"
            >

                Masuk Admin

            </a>

        </div>

        {{-- Mobile Button --}}
        <button
            @click="open=!open"
            class="text-3xl text-white lg:hidden"
        >

            ☰

        </button>

    </div>

    {{-- Mobile Menu --}}
    <div
        x-show="open"
        x-transition
        class="bg-white shadow-lg lg:hidden"
    >

        <div
            class="space-y-1 p-5"
        >

            <a class="mobile-menu" href="#home">Home</a>

            <a class="mobile-menu" href="/edukasi">Edukasi</a>

            <a class="mobile-menu" href="/kegiatan">Kegiatan</a>

            <a class="mobile-menu" href="/gallery">Galeri</a>

            <a class="mobile-menu" href="/jadwal">Jadwal</a>

            <a class="mobile-menu" href="/lapor">Lapor</a>


            <a
                href="{{ route('login') }}"
                class="mt-4 block rounded-xl bg-green-600 py-3 text-center font-semibold text-white"
            >

                Masuk Admin

            </a>

        </div>

    </div>

</nav>

<style>

.menu-link{

    color:white;

    font-weight:600;

    transition:.3s;

}

.menu-link:hover{

    color:#22c55e;

}

.mobile-menu{

    display:block;

    padding:12px;

    border-radius:10px;

}

.mobile-menu:hover{

    background:#f1f5f9;

}

.navbar-scroll{

    background:white;

    box-shadow:0 5px 25px rgba(0,0,0,.08);

}

.navbar-scroll .menu-link{

    color:#334155;

}

.navbar-scroll .navbar-text{

    color:#1e293b !important;

}

</style>

@push('scripts')
<script>

const navbar = document.getElementById('navbar');

@if(request()->routeIs('guest.home'))

window.addEventListener('scroll', function () {

    if (window.scrollY > 80) {

        navbar.classList.add('navbar-scroll');

    } else {

        navbar.classList.remove('navbar-scroll');

    }

});

@else

navbar.classList.add('navbar-scroll');

@endif

document.querySelectorAll('a[href^="#"]').forEach(anchor => {

    anchor.addEventListener('click', function (e) {

        const target = document.querySelector(this.getAttribute('href'));

        if (!target) return;

        e.preventDefault();

        target.scrollIntoView({

            behavior: 'smooth'

        });

    });

});

</script>
@endpush
