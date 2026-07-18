@extends('guest.layouts.guest')

@section('title','Galeri')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<section
    class="relative overflow-hidden bg-gradient-to-r from-purple-700 via-indigo-600 to-blue-600 pt-36 pb-40"
>

    <div class="absolute inset-0 opacity-10">

        <div class="absolute left-10 top-16 text-8xl">
            📷
        </div>

        <div class="absolute right-16 top-20 text-7xl">
            🎥
        </div>

        <div class="absolute bottom-10 left-1/3 text-8xl">
            ♻️
        </div>

        <div class="absolute bottom-16 right-24 text-7xl">
            🌎
        </div>

    </div>

    <div
        class="relative mx-auto max-w-5xl px-6 text-center"
        data-aos="fade-up"
    >

        <span
            class="inline-flex items-center rounded-full bg-white/20 px-5 py-2 text-sm font-semibold text-white backdrop-blur"
        >

            📸 Dokumentasi

        </span>

        <h1
            class="mt-8 text-5xl font-extrabold text-white lg:text-6xl"
        >

            Galeri & Video Kegiatan KKN Talagasari 2026

        </h1>

        <p
            class="mx-auto mt-8 max-w-3xl text-xl leading-9 text-blue-100"
        >

            Dokumentasi kegiatan,
            edukasi,
            bank sampah,
            gotong royong,
            dan berbagai aktivitas peduli lingkungan.

        </p>

    </div>

</section>

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
                class="grid gap-5 lg:grid-cols-12"
            >

                <div
                    class="lg:col-span-9"
                >

                    <select
                        name="kategori"
                        class="w-full rounded-2xl border p-5"
                    >

                        <option value="">
                            Semua Kategori
                        </option>

                        @foreach($kategori as $item)

                            <option
                                value="{{ $item }}"
                                @selected(request('kategori')==$item)
                            >

                                {{ $item }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div
                    class="lg:col-span-3"
                >

                    <button
                        class="w-full rounded-2xl bg-purple-600 p-5 text-lg font-bold text-white hover:bg-purple-700"
                    >

                        Filter

                    </button>

                </div>

            </div>

        </form>

    </div>

</section>

<section
    class="pb-24"
>

<div
    class="mx-auto max-w-7xl px-6"
    x-data="{ tab:'gallery' }"
>

<div
    class="mb-10"
>

    <h2
        class="text-4xl font-bold text-slate-800"
    >

        Dokumentasi

    </h2>

    <p
        class="mt-3 text-slate-500"
    >

        {{ $images->count() }} Foto • {{ $videos->count() }} Video

    </p>

</div>

<div
    class="mb-10 flex justify-center"
>

    <div
        class="inline-flex rounded-2xl bg-slate-100 p-1"
    >

        <button
            @click="tab='gallery'"
            :class="tab=='gallery'
                ? 'bg-purple-600 text-white'
                : 'text-slate-700'"
            class="rounded-xl px-6 py-3 font-semibold transition"
        >

            📷 Galeri

        </button>

        <button
            @click="tab='video'"
            :class="tab=='video'
                ? 'bg-purple-600 text-white'
                : 'text-slate-700'"
            class="rounded-xl px-6 py-3 font-semibold transition"
        >

            🎥 Video

        </button>

    </div>

</div>
{{-- ================= GALERI ================= --}}

<div
    x-show="tab=='gallery'"
    x-transition
>

    <div
        class="grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4"
    >

        @forelse($images as $image)

            <a
                href="{{ asset('storage/'.$image->gambar) }}"
                data-fancybox="gallery"
                data-caption="{{ $image->activity->judul }}"
                class="group relative overflow-hidden rounded-3xl shadow-lg"
                data-aos="zoom-in"
            >

                {{-- Foto --}}

                <img
                    src="{{ asset('storage/'.$image->gambar) }}"
                    alt="{{ $image->activity->judul }}"
                    class="h-72 w-full object-cover transition duration-500 group-hover:scale-110"
                >

                {{-- Overlay --}}

                <div
                    class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/30 to-transparent p-5 opacity-0 transition duration-300 group-hover:opacity-100"
                >

                    <span
                        class="mb-3 inline-block w-fit rounded-full bg-purple-600 px-3 py-1 text-xs font-semibold text-white"
                    >

                        {{ $image->activity->kategori }}

                    </span>

                    <h3
                        class="line-clamp-2 text-lg font-bold text-white"
                    >

                        {{ $image->activity->judul }}

                    </h3>

                    <p
                        class="mt-2 line-clamp-2 text-sm text-slate-200"
                    >

                        {{ Str::limit(strip_tags($image->activity->isi),80) }}

                    </p>

                    <div
                        class="mt-4 flex items-center justify-between text-xs text-slate-300"
                    >

                        <span>

                            📍 {{ $image->activity->lokasi }}

                        </span>

                        <span>

                            {{ \Carbon\Carbon::parse($image->activity->tanggal)->translatedFormat('d M Y') }}

                        </span>

                    </div>

                </div>

            </a>

        @empty

            <div
                class="col-span-full flex min-h-[350px] items-center justify-center rounded-3xl bg-white shadow-lg"
            >

                <div
                    class="text-center"
                >

                    <div
                        class="text-8xl"
                    >

                        📷

                    </div>

                    <h3
                        class="mt-6 text-3xl font-bold"
                    >

                        Belum Ada Foto

                    </h3>

                    <p
                        class="mt-3 text-slate-500"
                    >

                        Dokumentasi foto akan segera ditambahkan.

                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>
{{-- ================= VIDEO ================= --}}

<div
    x-show="tab=='video'"
    x-transition
>

    <div
        class="grid gap-8 md:grid-cols-2 lg:grid-cols-3"
    >

        @forelse($videos as $video)

            <div
                class="overflow-hidden rounded-3xl bg-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl"
                data-aos="zoom-in"
            >

                {{-- Video --}}

                <video
                    controls
                    preload="metadata"
                    class="h-72 w-full object-cover bg-black"
                >

                    <source
                        src="{{ asset('storage/'.$video->video) }}"
                        type="video/mp4"
                    >

                    Browser Anda tidak mendukung video.

                </video>

                {{-- Content --}}

                <div
                    class="space-y-4 p-6"
                >

                    <span
                        class="inline-flex rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700"
                    >

                        {{ $video->activity->kategori }}

                    </span>

                    <h3
                        class="line-clamp-2 text-xl font-bold text-slate-800"
                    >

                        {{ $video->activity->judul }}

                    </h3>

                    <p
                        class="line-clamp-3 text-sm leading-7 text-slate-500"
                    >

                        {{ Str::limit(strip_tags($video->activity->isi),120) }}

                    </p>

                    <div
                        class="flex items-center justify-between border-t pt-4 text-sm text-slate-500"
                    >

                        <span>

                            📍 {{ $video->activity->lokasi }}

                        </span>

                        <span>

                            {{ \Carbon\Carbon::parse($video->activity->tanggal)->translatedFormat('d M Y') }}

                        </span>

                    </div>

                </div>

            </div>

        @empty

            <div
                class="col-span-full flex min-h-[350px] items-center justify-center rounded-3xl bg-white shadow-lg"
            >

                <div class="text-center">

                    <div class="text-8xl">

                        🎥

                    </div>

                    <h3
                        class="mt-6 text-3xl font-bold"
                    >

                        Belum Ada Video

                    </h3>

                    <p
                        class="mt-3 text-slate-500"
                    >

                        Video kegiatan akan segera ditambahkan.

                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>

</div>

</section>

@endsection
