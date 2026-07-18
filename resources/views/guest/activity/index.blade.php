@extends('guest.layouts.guest')

@section('title','Kegiatan')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<!-- HERO -->

<section
    class="relative overflow-hidden bg-gradient-to-r from-blue-700 via-cyan-600 to-sky-500 pt-36 pb-40"
>

    <div class="absolute inset-0 opacity-10">

        <div class="absolute left-10 top-16 text-8xl">🌿</div>

        <div class="absolute right-16 top-20 text-7xl">📸</div>

        <div class="absolute bottom-10 left-1/3 text-8xl">🌱</div>

        <div class="absolute bottom-16 right-24 text-7xl">♻️</div>

    </div>

    <div
        class="relative mx-auto max-w-5xl px-6 text-center"
        data-aos="fade-up"
    >

        <span
            class="inline-flex items-center rounded-full bg-white/20 px-5 py-2 text-sm font-semibold text-white backdrop-blur"
        >

            📅 Kegiatan Lingkungan

        </span>

        <h1
            class="mt-8 text-5xl font-extrabold text-white lg:text-6xl"
        >

            Kegiatan KKN Talagasari 2026

        </h1>

        <p
            class="mx-auto mt-8 max-w-3xl text-xl leading-9 text-blue-100"
        >

            Dokumentasi kegiatan,
            gotong royong,
            sosialisasi,
            pelatihan,
            serta berbagai aktivitas
            peduli lingkungan.

        </p>

    </div>

</section>

<!-- SEARCH -->

<section
    class="relative z-20 -mt-24 pb-16"
>

    <div
        class="mx-auto max-w-7xl px-6"
    >

        <form
            method="GET"
            class="rounded-[30px] border border-slate-100 bg-white p-7 shadow-2xl"
        >

            <div
                class="grid grid-cols-1 gap-5 lg:grid-cols-4"
            >

                <div class="lg:col-span-3">

                    <div class="relative">

                        <svg
                            class="absolute left-5 top-1/2 h-6 w-6 -translate-y-1/2 text-slate-400"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >

                            <circle cx="11" cy="11" r="8"/>

                            <path d="m21 21-4.3-4.3"/>

                        </svg>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari kegiatan..."
                            class="w-full rounded-2xl border p-5 pl-14"
                        >

                    </div>

                </div>

                <div>

                    <button
                        class="w-full rounded-2xl bg-blue-600 p-5 font-bold text-white transition hover:bg-blue-700"
                    >

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</section>

<!-- LIST -->

<section
    class="pb-24"
>

    <div
        class="mx-auto max-w-7xl px-6"
    >

        <div class="mb-10">

            <h2 class="text-4xl font-bold text-slate-800">

                Semua Kegiatan

            </h2>

            <p class="mt-3 text-slate-500">

                {{ $activities->total() }} Kegiatan

            </p>

        </div>

        <!-- GRID -->
        <div
            class="grid grid-cols-1 gap-8 lg:grid-cols-2"
        >

@forelse($activities as $activity)
    <article
        data-aos="fade-up"
        class="group flex h-full flex-col overflow-hidden rounded-3xl bg-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl"
    >

        {{-- Thumbnail --}}
        <div class="relative overflow-hidden">

            @if($activity->thumbnail)

                <img
                    src="{{ asset('storage/'.$activity->thumbnail) }}"
                    alt="{{ $activity->judul }}"
                    class="h-72 w-full object-cover transition duration-500 group-hover:scale-110"
                >

            @else

                <div
                    class="flex h-72 items-center justify-center bg-slate-100"
                >

                    <span class="text-7xl">
                        📸
                    </span>

                </div>

            @endif

            {{-- Status --}}
            <div class="absolute left-5 top-5">

                <span
                    class="rounded-full bg-blue-600 px-4 py-2 text-xs font-semibold text-white"
                >

                    {{ $activity->status }}

                </span>

            </div>

            {{-- Tanggal --}}
            <div
                class="absolute right-5 top-5 rounded-2xl bg-white px-4 py-3 text-center shadow-lg"
            >

                <div class="text-2xl font-bold text-blue-600">

                    {{ \Carbon\Carbon::parse($activity->tanggal)->format('d') }}

                </div>

                <div class="text-xs uppercase text-slate-500">

                    {{ \Carbon\Carbon::parse($activity->tanggal)->format('M') }}

                </div>

            </div>

        </div>

        {{-- Content --}}
        <div class="flex flex-1 flex-col p-7">

            <h3
                class="line-clamp-2 text-2xl font-bold text-slate-800"
            >

                {{ $activity->judul }}

            </h3>

            <div
                class="mt-5 space-y-2 text-slate-500"
            >

                <p>
                    📍 {{ $activity->lokasi }}
                </p>

                <p>
                    🕒 {{ \Carbon\Carbon::parse($activity->tanggal)->translatedFormat('d F Y') }}
                </p>

            </div>

            <p
                class="mt-6 flex-1 line-clamp-3 leading-8 text-slate-600"
            >

                {{ Str::limit(strip_tags($activity->deskripsi),150) }}

            </p>

            <div
                class="mt-8 flex items-center justify-between border-t pt-5"
            >

                <div
                    class="flex items-center gap-2 text-sm text-slate-500"
                >

                    📷

                    {{ count(json_decode($activity->dokumentasi ?? '[]')) }}

                    Dokumentasi

                </div>

                <a
                    href="{{ route('guest.activity.show',$activity) }}"
                    class="font-semibold text-blue-600 transition hover:text-blue-700"
                >

                    Lihat Detail →

                </a>

            </div>

        </div>

    </article>
@empty

    <div
        class="col-span-full rounded-3xl bg-white py-24 text-center shadow-lg"
    >

        <div
            class="text-7xl"
        >

            📅

        </div>

        <h3
            class="mt-6 text-3xl font-bold text-slate-800"
        >

            Belum Ada Kegiatan

        </h3>

        <p
            class="mt-3 text-slate-500"
        >

            Kegiatan akan segera ditampilkan.

        </p>

    </div>

@endforelse

        </div>

        <!-- Pagination -->

        @if($activities->hasPages())

            <div
                class="mt-14 flex justify-center"
            >

                {{ $activities->links() }}

            </div>

        @endif

    </div>

</section>
<div class="grid grid-cols-1 gap-8 lg:grid-cols-2">

    @forelse($activities as $activity)

        <article>
            ...
        </article>

    @empty

        ...

    @endforelse

</div>
