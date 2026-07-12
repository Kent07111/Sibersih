<aside
    class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col bg-slate-900 text-slate-200 shadow-2xl transition-transform duration-300 lg:relative lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
>
    {{-- Header --}}
    <div class="flex h-20 items-center justify-between border-b border-slate-800 px-6">

        <div>
            <h1 class="text-2xl font-bold text-green-400">
                {{ $setting->nama_desa }}
            </h1>

            <p class="text-xs text-slate-400">
                {{ $setting->name }}
            </p>
        </div>

        {{-- Close Mobile --}}
        <button
            @click="sidebarOpen = false"
            class="rounded-lg p-2 hover:bg-slate-800 lg:hidden"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>

    </div>

    {{-- Menu --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6">

        <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
            General
        </p>

        <a
            href="/dashboard"
            class="mb-2 flex items-center gap-3 rounded-xl bg-green-600 px-4 py-3 font-medium text-white transition hover:bg-green-500"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10.5L12 3l9 7.5v9a1.5 1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 19.5z"/>
            </svg>

            Dashboard
        </a>

        <p class="mb-3 mt-8 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
            Master Data
        </p>

@php
    $menus = [
        [
            'title' => 'Titik Sampah',
            'route' => 'waste-point.index',
        ],
        [
            'title' => 'Edukasi',
            'route' => 'education.index',
        ],
        [
            'title' => 'Kegiatan',
            'route' => 'activity.index',
        ],
        [
            'title' => 'Galeri',
            'route' => 'gallery.index',
        ],
        [
            'title' => 'Agenda',
            'route' => 'schedule.index',
        ],
        // menu lainnya...
    ];
@endphp

@foreach ($menus as $menu)
    <a
        href="{{ route($menu['route']) }}"
        class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 transition hover:bg-slate-800"
    >
        <div class="h-2 w-2 rounded-full bg-green-500"></div>

        {{ $menu['title'] }}
    </a>
@endforeach

        <p class="mb-3 mt-8 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
            Pelayanan
        </p>

        <a
            href="/report"
            class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 transition hover:bg-slate-800"
        >
            <div class="h-2 w-2 rounded-full bg-blue-500"></div>

            Laporan Warga
        </a>

        <a
            href="/setting/qr-center"
            class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 transition hover:bg-slate-800"
        >
            <div class="h-2 w-2 rounded-full bg-yellow-500"></div>

            QR Code
        </a>

        <p class="mb-3 mt-8 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
            Pengaturan
        </p>

        <a
            href="#"
            class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 transition hover:bg-slate-800"
        >
            <div class="h-2 w-2 rounded-full bg-purple-500"></div>

            Pengguna
        </a>

        <a
            href="/settings"
            class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 transition hover:bg-slate-800"
        >
            <div class="h-2 w-2 rounded-full bg-pink-500"></div>

            Website
        </a>

    </nav>

    {{-- Footer --}}
    <div class="border-t border-slate-800 p-4">

        <a
            href="/logout"
            class="flex items-center justify-center rounded-xl bg-red-500 px-4 py-3 font-medium text-white transition hover:bg-red-600"
        >
            Logout
        </a>

    </div>

</aside>
