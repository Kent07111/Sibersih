@extends('guest.layouts.guest')

@section('title','Galeri')

@section('content')

<!-- HERO -->

<section
    class="relative overflow-hidden bg-gradient-to-r from-purple-700 via-indigo-600 to-blue-600 pt-36 pb-40"
>

    <div class="absolute inset-0 opacity-10">

        <div class="absolute left-10 top-16 text-8xl">📷</div>

        <div class="absolute right-16 top-20 text-7xl">🌿</div>

        <div class="absolute bottom-10 left-1/3 text-8xl">♻️</div>

        <div class="absolute bottom-16 right-24 text-7xl">🌎</div>

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

            Galeri Kegiatan Kkn Talagasari 2026

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

<!-- FILTER -->

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

<!-- GALLERY -->

<section
    class="pb-24"
>

    <div
        class="mx-auto max-w-7xl px-6"
    >

        <div
            class="mb-10"
        >

            <h2
                class="text-4xl font-bold text-slate-800"
            >

                Semua Dokumentasi

            </h2>

            <p
                class="mt-3 text-slate-500"
            >

                {{ $galleries->total() }} Foto

            </p>

        </div>

        <div
            class="grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4"
        ></div>
@forelse($galleries as $gallery)

    <a
        href="{{ asset('storage/'.$gallery->foto) }}"
        data-fancybox="gallery"
        data-caption="{{ $gallery->judul }}"
        class="group relative overflow-hidden rounded-3xl shadow-lg"
        data-aos="zoom-in"
    >

        {{-- Foto --}}

        <img
            src="{{ asset('storage/'.$gallery->foto) }}"
            alt="{{ $gallery->judul }}"
            class="h-72 w-full object-cover transition duration-500 group-hover:scale-110"
        >

        {{-- Overlay --}}

        <div
            class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/30 to-transparent p-5 opacity-0 transition duration-300 group-hover:opacity-100"
        >

            <span
                class="mb-3 inline-block w-fit rounded-full bg-purple-600 px-3 py-1 text-xs font-semibold text-white"
            >

                {{ $gallery->kategori }}

            </span>

            <h3
                class="line-clamp-2 text-lg font-bold text-white"
            >

                {{ $gallery->judul }}

            </h3>

            @if($gallery->deskripsi)

                <p
                    class="mt-2 line-clamp-2 text-sm text-slate-200"
                >

                    {{ $gallery->deskripsi }}

                </p>

            @endif

        </div>

    </a>

@empty

    <div
        class="col-span-full flex min-h-[350px] items-center justify-center rounded-3xl bg-white shadow-lg"
    >

        <div class="text-center">

            <div class="text-8xl">

                📷

            </div>

            <h3
                class="mt-6 text-3xl font-bold"
            >

                Belum Ada Galeri

            </h3>

            <p
                class="mt-3 text-slate-500"
            >

                Dokumentasi akan segera ditambahkan.

            </p>

        </div>

    </div>

@endforelse

</div>

@if($galleries->hasPages())

    <div
        class="mt-16 flex justify-center"
    >

        {{ $galleries->links() }}

    </div>

@endif

</div>

</section>
