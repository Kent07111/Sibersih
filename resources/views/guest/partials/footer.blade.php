<footer
    id="kontak"
    class="bg-slate-900 text-slate-300"
>

    <div
        class="mx-auto grid max-w-7xl gap-12 px-6 py-16 lg:grid-cols-4"
    >

        {{-- Logo --}}
        <div>

            <div
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

                    <h2
                        class="text-2xl font-bold text-white"
                    >

                        SIBERSIH

                    </h2>

                    <p
                        class="text-sm text-slate-400"
                    >

                        {{ $setting->name }}

                    </p>

                </div>

            </div>

            <p
                class="mt-6 leading-8"
            >

                {!! nl2br(e($setting->tentang)) !!}

            </p>

        </div>

        {{-- Menu --}}
        <div>

            <h3
                class="mb-5 text-lg font-bold text-white"
            >

                Menu

            </h3>

            <ul class="space-y-3">

                <li>

                    <a href="#home" class="hover:text-green-400">

                        Home

                    </a>

                </li>

                <li>

                    <a href="#tentang" class="hover:text-green-400">

                        Tentang

                    </a>

                </li>

                <li>

                    <a href="#edukasi" class="hover:text-green-400">

                        Edukasi

                    </a>

                </li>

                <li>

                    <a href="#kegiatan" class="hover:text-green-400">

                        Kegiatan

                    </a>

                </li>

                <li>

                    <a href="#gallery" class="hover:text-green-400">

                        Galeri

                    </a>

                </li>

                <li>

                    <a href="#jadwal" class="hover:text-green-400">

                        Jadwal

                    </a>

                </li>

            </ul>

        </div>

        {{-- Kontak --}}
        <div>

            <h3
                class="mb-5 text-lg font-bold text-white"
            >

                Kontak

            </h3>

            <div class="space-y-4">

                <p>

                    {{ $setting->alamat }}

                </p>

                <p>

                    ☎️ {{ $setting->telepon }}

                </p>

                <p>

                    ✉️ {{ $setting->email }}

                </p>

            </div>

        </div>

        {{-- Sosial --}}
        <div>

            <h3
                class="mb-5 text-lg font-bold text-white"
            >

                Ikuti Kami

            </h3>

            <div
                class="flex gap-4"
            >

                <a
                    href="#"
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-800 transition hover:bg-green-600"
                >

                    <i class="fab fa-facebook-f"></i>

                </a>

                <a
                    href="#"
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-800 transition hover:bg-pink-600"
                >

                    <i class="fab fa-instagram"></i>

                </a>

                <a
                    href="#"
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-800 transition hover:bg-red-600"
                >

                    <i class="fab fa-youtube"></i>

                </a>

            </div>

        </div>

    </div>

    <div
        class="border-t border-slate-700"
    >

        <div
            class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-6 py-6 text-sm lg:flex-row"
        >

            <p>

                © {{ date('Y') }}

                KKN Talagasari UBP2026.

                All Rights Reserved.

            </p>

            <p>

                Developed by Kkn Talagasari 2026 Universitas Buana Perjuangan Karawang

            </p>

        </div>

    </div>

</footer>
