<nav class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-slate-200 bg-white px-4 shadow-sm lg:px-8">

    {{-- Left --}}
    <div class="flex items-center gap-4">

        {{-- Mobile Menu --}}
        <button
            @click="sidebarOpen = true"
            class="rounded-lg p-2 text-slate-600 transition hover:bg-slate-100 lg:hidden"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-7 w-7"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16"
                />
            </svg>
        </button>

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                @yield('title', 'Dashboard')
            </h2>

            <p class="text-sm text-slate-500">
                 {{ $setting->name }}
            </p>
        </div>

    </div>

    {{-- Right --}}
    <div class="flex items-center gap-4">

        {{-- Search --}}
        <div class="relative hidden lg:block">

            <input
                type="text"
                placeholder="Cari..."
                class="w-72 rounded-xl border border-slate-300 bg-slate-50 py-2 pl-11 pr-4 focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-200"
            >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="absolute left-3 top-2.5 h-5 w-5 text-slate-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z"
                />
            </svg>

        </div>

        {{-- Notification --}}
        <button
            class="relative rounded-xl p-2 transition hover:bg-slate-100"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-slate-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 17h5l-1.4-1.4A2 2 0 0 1 18 14.2V11a6 6 0 1 0-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 1 1-6 0"
                />
            </svg>

            <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500"></span>
        </button>

        {{-- User --}}
        <div x-data="{ open: false }" class="relative">

            <button
                @click="open = !open"
                class="flex items-center gap-3 rounded-xl border border-slate-200 px-3 py-2 transition hover:bg-slate-50"
            >

                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-600 text-white font-semibold">
                    A
                </div>

                <div class="hidden text-left md:block">

                    <p class="text-sm font-semibold text-slate-800">
                        Administrator
                    </p>

                    <p class="text-xs text-slate-500">
                        Admin
                    </p>

                </div>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-slate-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m19 9-7 7-7-7"
                    />
                </svg>

            </button>

            {{-- Dropdown --}}
            <div
                x-show="open"
                @click.outside="open = false"
                x-transition
                class="absolute right-0 mt-3 w-52 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg"
                style="display:none;"
            >

                <a
                    href="#"
                    class="block px-5 py-3 text-sm transition hover:bg-slate-100"
                >
                    Profil
                </a>

                <a
                    href="#"
                    class="block px-5 py-3 text-sm transition hover:bg-slate-100"
                >
                    Pengaturan
                </a>

                <hr>

                <a
                    href="/logout"
                    class="block px-5 py-3 text-sm text-red-600 transition hover:bg-red-50"
                >
                    Logout
                </a>

            </div>

        </div>

    </div>

</nav>
