<nav
    x-data="{ open:false }"
    id="navbar"
    class="fixed top-0 left-0 z-50 w-full bg-white shadow-md"
>
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

        {{-- Logo --}}
        <a
            href="#"
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

                <h1 class="text-xl font-bold text-slate-800">

                    {{ $setting->nama_desa }}

                </h1>

                <p class="text-xs text-slate-500">

                    Bank Sampah

                </p>

            </div>

        </a>

        {{-- Desktop Menu --}}
        <div class="hidden items-center gap-8 lg:flex">

            <a href="#" class="menu-link">
                Dashboard
            </a>

            <a href="#" class="menu-link">
                Profil
            </a>

            <a href="#" class="menu-link">
                Wallet
            </a>

            <a href="/user/my-deposits/create" class="menu-link">
                Setor Sampah
            </a>

            <a href="#" class="menu-link">
                Reward
            </a>

            <a href="/user/my-deposits" class="menu-link">
                Riwayat
            </a>

            <form
                action="#"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="rounded-xl bg-red-500 px-5 py-2 font-semibold text-white hover:bg-red-600"
                >
                    Logout
                </button>

            </form>

        </div>

        {{-- Mobile Button --}}
        <button
            @click="open=!open"
            class="text-3xl text-slate-700 lg:hidden"
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
                Setor Sampah
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
                Riwayat
            </a>

            <form
                action="#"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="mobile-menu w-full text-left text-red-600"
                >
                    Logout
                </button>

            </form>

        </div>

    </div>

</nav>

<style>

.menu-link{

    color:#334155;
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

</style>
