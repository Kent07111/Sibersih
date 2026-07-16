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

                <h1 class="navbar-text text-xl font-bold text-white">
                    {{ $setting->nama_desa ?? 'Tidak ada data' }}
                </h1>

                <p class="navbar-text text-xs text-white/80">
                    {{ $setting->name }}
                </p>

            </div>

        </a>

        {{-- Desktop Menu --}}
        <div class="hidden items-center gap-8 lg:flex">

            @guest

                <a href="{{ route('guest.home') }}" class="menu-link">
                    Home
                </a>

                <a href="/edukasi" class="menu-link">
                    Edukasi
                </a>

                <a href="/kegiatan" class="menu-link">
                    Kegiatan
                </a>

                <a href="/galeri" class="menu-link">
                    Galeri
                </a>

                <a href="/jadwal" class="menu-link">
                    Jadwal
                </a>

                <a href="/lapor" class="menu-link">
                    Lapor
                </a>

                <a
                    href="{{ route('login') }}"
                    class="menu-link"
                >
                    Bank Sampah
                </a>

                <a
                    href="{{ route('login') }}"
                    class="rounded-xl bg-green-600 px-5 py-2 font-semibold text-white hover:bg-green-700"
                >
                    Masuk Admin
                </a>

            @else

                @if(Auth::user()->role == 'admin')

                    <a href="{{ route('guest.home') }}" class="menu-link">
                        Home
                    </a>

                    <a href="/edukasi" class="menu-link">
                        Edukasi
                    </a>

                    <a href="/kegiatan" class="menu-link">
                        Kegiatan
                    </a>

                    <a href="/galeri" class="menu-link">
                        Galeri
                    </a>

                    <a href="/jadwal" class="menu-link">
                        Jadwal
                    </a>

                    <a href="/lapor" class="menu-link">
                        Lapor
                    </a>

                    <a
                        href="/dashboard"
                        class="menu-link"
                    >
                        Dashboard Admin
                    </a>

                @else

                    <a
                        href="#"
                        class="menu-link"
                    >
                        Dashboard
                    </a>

                    <a
                        href="#"
                        class="menu-link"
                    >
                        Profil
                    </a>

                    <a
                        href="#"
                        class="menu-link"
                    >
                        Wallet
                    </a>

                    <a
                        href="#"
                        class="menu-link"
                    >
                        Setor
                    </a>

                    <a
                        href="#"
                        class="menu-link"
                    >
                        Reward
                    </a>

                    <a
                        href="#"
                        class="menu-link"
                    >
                        History
                    </a>

                @endif

                <form
                    action="#
                    method="POST"
                >
                    @csrf

                    <button
                        class="font-semibold text-red-500 hover:text-red-600"
                    >
                        Logout
                    </button>

                </form>

            @endguest

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

        <div class="space-y-1 p-5">

            @guest

                <a class="mobile-menu" href="{{ route('guest.home') }}">
                    Home
                </a>

                <a class="mobile-menu" href="/edukasi">
                    Edukasi
                </a>

                <a class="mobile-menu" href="/kegiatan">
                    Kegiatan
                </a>

                <a class="mobile-menu" href="/galeri">
                    Galeri
                </a>

                <a class="mobile-menu" href="/jadwal">
                    Jadwal
                </a>

                <a class="mobile-menu" href="/lapor">
                    Lapor
                </a>

                <a
                    class="mobile-menu"
                    href="{{ route('login') }}"
                >
                    Bank Sampah
                </a>

                <a
                    href="{{ route('login') }}"
                    class="mt-4 block rounded-xl bg-green-600 py-3 text-center font-semibold text-white"
                >
                    Masuk Admin
                </a>

            @else

                @if(Auth::user()->role == 'admin')

                    <a class="mobile-menu" href="/dashboard">
                        Dashboard Admin
                    </a>

                @else

                    <a
                        class="mobile-menu"
                        href="#"
                    >
                        Dashboard
                    </a>

                    <a
                        class="mobile-menu"
                        href="#"
                    >
                        Profil
                    </a>

                    <a
                        class="mobile-menu"
                        href="#"
                    >
                        Wallet
                    </a>

                    <a
                        class="mobile-menu"
                        href="#"
                    >
                        Setor
                    </a>

                    <a
                        class="mobile-menu"
                        href="#"
                    >
                        Reward
                    </a>

                    <a
                        class="mobile-menu"
                        href="#"
                    >
                        History
                    </a>

                @endif

                <form
                    action="#"
                    method="POST"
                >
                    @csrf

                    <button
                        class="mobile-menu w-full text-left text-red-600"
                    >
                        Logout
                    </button>

                </form>

            @endguest

        </div>

    </div>

</nav>
