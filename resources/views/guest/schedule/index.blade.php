@extends('guest.layouts.guest')

@section('title','Jadwal')

@section('content')

{{-- ================= HERO ================= --}}

<section
    class="relative overflow-hidden bg-gradient-to-br from-emerald-700 via-green-600 to-lime-500 pt-36 pb-40"
>

    {{-- Background Decoration --}}

    <div class="absolute inset-0">

        <div class="absolute -left-20 -top-20 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>

        <div class="absolute right-0 top-20 h-96 w-96 rounded-full bg-lime-300/10 blur-3xl"></div>

        <div class="absolute bottom-0 left-1/3 h-80 w-80 rounded-full bg-emerald-300/10 blur-3xl"></div>

    </div>

    {{-- Floating Emoji --}}

    <div class="absolute inset-0 opacity-10">

        <div class="absolute left-12 top-20 text-8xl">📅</div>

        <div class="absolute right-16 top-24 text-7xl">🌱</div>

        <div class="absolute bottom-12 left-1/4 text-8xl">♻️</div>

        <div class="absolute bottom-10 right-20 text-7xl">🌍</div>

    </div>

    <div
        class="relative mx-auto max-w-7xl px-6 text-center"
        data-aos="fade-up"
    >

        <span
            class="inline-flex items-center gap-2 rounded-full bg-white/20 px-6 py-3 text-sm font-semibold text-white backdrop-blur"
        >

            <i class="fa-solid fa-calendar-days"></i>

            Agenda Bank Sampah

        </span>

        <h1
            class="mt-8 text-5xl font-extrabold leading-tight text-white lg:text-6xl"
        >

            Jadwal Kegiatan
            <br>

            KKN Talagasari 2026

        </h1>

        <p
            class="mx-auto mt-8 max-w-3xl text-lg leading-8 text-green-100 lg:text-xl"
        >

            Temukan seluruh agenda kegiatan,
            sosialisasi,
            pengangkutan sampah,
            pelatihan,
            dan kegiatan lingkungan yang akan dilaksanakan.

        </p>

    </div>

</section>

{{-- ================= FILTER ================= --}}

<section
    class="relative z-20 -mt-24 pb-16"
>

    <div
        class="mx-auto max-w-7xl px-6"
    >

        <form
            method="GET"
            class="rounded-[32px] border border-slate-100 bg-white p-8 shadow-2xl"
        >

            <div
                class="grid gap-5 lg:grid-cols-12"
            >

                <div
                    class="lg:col-span-9"
                >

                    <label
                        class="mb-2 block text-sm font-semibold text-slate-600"
                    >

                        Status Jadwal

                    </label>

                    <select
                        name="status"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 transition focus:border-green-500 focus:ring-green-500"
                    >

                        <option value="">

                            Semua Status

                        </option>

                        <option
                            value="Aktif"
                            @selected(request('status')=='Aktif')
                        >

                            Aktif

                        </option>

                        <option
                            value="Selesai"
                            @selected(request('status')=='Selesai')
                        >

                            Selesai

                        </option>

                    </select>

                </div>

                <div
                    class="flex items-end lg:col-span-3"
                >

                    <button
                        class="w-full rounded-2xl bg-gradient-to-r from-green-600 to-emerald-500 p-4 text-lg font-bold text-white shadow-lg transition hover:scale-[1.02] hover:shadow-xl"
                    >

                        <i class="fa-solid fa-filter mr-2"></i>

                        Filter

                    </button>

                </div>

            </div>

        </form>

    </div>

</section>

{{-- ================= LIST JADWAL ================= --}}

<section
    class="pb-24"
>

    <div
        class="mx-auto max-w-7xl px-6"
    >

        <div
            class="mb-12 flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between"
        >

            <div>

                <h2
                    class="text-4xl font-bold text-slate-800"
                >

                    Agenda Terjadwal

                </h2>

                <p
                    class="mt-2 text-slate-500"
                >

                    Total
                    <span class="font-bold text-green-600">

                        {{ $schedules->total() }}

                    </span>

                    jadwal kegiatan.

                </p>

            </div>

        </div>

        <div
            class="grid gap-8 sm:grid-cols-2 xl:grid-cols-3"
        >

            @forelse($schedules as $schedule)
        <div
            class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:border-green-300 hover:shadow-2xl"
            data-aos="fade-up"
        >

            {{-- Header Card --}}
            <div
                class="relative overflow-hidden bg-gradient-to-r from-green-600 via-emerald-500 to-lime-500 p-6 text-white"
            >

                <div
                    class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-white/10"
                ></div>

                <div
                    class="absolute -bottom-10 -left-10 h-24 w-24 rounded-full bg-white/10"
                ></div>

                <div
                    class="relative flex items-start justify-between gap-3"
                >

                    <div>

                        <span
                            class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-xs font-semibold backdrop-blur"
                        >

                            <i class="fa-solid fa-calendar-day mr-2"></i>

                            {{ $schedule->hari }}

                        </span>

                        <h3
                            class="mt-4 text-2xl font-bold leading-snug"
                        >

                            {{ $schedule->judul }}

                        </h3>

                    </div>

                    <span
                        class="rounded-full px-4 py-2 text-xs font-bold shadow
                        {{ $schedule->status == 'Aktif'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-slate-100 text-slate-700'
                        }}"
                    >

                        {{ $schedule->status }}

                    </span>

                </div>

            </div>

            {{-- Body --}}
            <div
                class="space-y-5 p-6"
            >

                {{-- Tanggal --}}
                <div
                    class="flex items-center gap-4"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100 text-green-600"
                    >

                        <i class="fa-solid fa-calendar"></i>

                    </div>

                    <div>

                        <p
                            class="text-xs uppercase tracking-wide text-slate-400"
                        >

                            Tanggal

                        </p>

                        <p
                            class="font-semibold text-slate-700"
                        >

                            {{ \Carbon\Carbon::parse($schedule->tanggal)->translatedFormat('d F Y') }}

                        </p>

                    </div>

                </div>

                {{-- Jam --}}
                <div
                    class="flex items-center gap-4"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600"
                    >

                        <i class="fa-solid fa-clock"></i>

                    </div>

                    <div>

                        <p
                            class="text-xs uppercase tracking-wide text-slate-400"
                        >

                            Jam

                        </p>

                        <p
                            class="font-semibold text-slate-700"
                        >

                            {{ \Carbon\Carbon::parse($schedule->jam)->format('H:i') }} WIB

                        </p>

                    </div>

                </div>

                {{-- Lokasi --}}
                <div
                    class="flex items-center gap-4"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-600"
                    >

                        <i class="fa-solid fa-location-dot"></i>

                    </div>

                    <div>

                        <p
                            class="text-xs uppercase tracking-wide text-slate-400"
                        >

                            Lokasi

                        </p>

                        <p
                            class="font-semibold text-slate-700"
                        >

                            {{ $schedule->lokasi }}

                        </p>

                    </div>

                </div>

                {{-- Keterangan --}}
                @if($schedule->keterangan)

                <div
                    class="rounded-2xl border border-slate-100 bg-slate-50 p-4"
                >

                    <div
                        class="mb-2 flex items-center gap-2 text-sm font-semibold text-slate-700"
                    >

                        <i class="fa-solid fa-circle-info text-green-600"></i>

                        Keterangan

                    </div>

                    <div
                        class="prose prose-sm max-w-none text-slate-600"
                    >

                        {!! \Illuminate\Support\Str::limit(strip_tags($schedule->keterangan), 180) !!}

                    </div>

                </div>

                @endif

            </div>

        </div>

@empty

<div
    class="col-span-full"
>

    <div
        class="flex min-h-[420px] flex-col items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm"
        data-aos="zoom-in"
    >

        <div
            class="flex h-28 w-28 items-center justify-center rounded-full bg-green-100 text-6xl"
        >
            📅
        </div>

        <h3
            class="mt-8 text-3xl font-bold text-slate-800"
        >

            Belum Ada Jadwal

        </h3>

        <p
            class="mt-4 max-w-lg leading-7 text-slate-500"
        >

            Saat ini belum terdapat agenda kegiatan yang dapat ditampilkan.
            Silakan kunjungi halaman ini kembali untuk melihat informasi jadwal terbaru.

        </p>

    </div>

</div>

@endforelse

</div>

@if($schedules->hasPages())

<div
    class="mt-16 flex justify-center"
>

    <div
        class="rounded-2xl bg-white p-3 shadow-lg"
    >

        {{ $schedules->links() }}

    </div>

</div>

@endif

</div>

</section>

@endsection
