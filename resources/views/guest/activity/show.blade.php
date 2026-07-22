@extends('guest.layouts.guest')

@section('title',$activity->judul)

@section('content')

<div
    id="readingProgress"
    class="fixed left-0 top-0 z-[9999] h-1 bg-gradient-to-r from-blue-500 via-cyan-500 to-sky-500 transition-all duration-150"
    style="width:0%"
></div>

{{-- ================= HERO ================= --}}

<section
    class="relative overflow-hidden"
>

    {{-- Background --}}

    @if($activity->thumbnail)

        <img
            src="{{ asset('storage/'.$activity->thumbnail) }}"
            alt="{{ $activity->judul }}"
            class="absolute inset-0 h-full w-full object-cover"
        >

    @endif

    <div
        class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-blue-900/85 to-cyan-700/70"
    ></div>

    <div
        class="relative mx-auto max-w-7xl px-6 pt-32 pb-24"
    >

        {{-- Breadcrumb --}}

        <nav
            class="mb-10 flex flex-wrap items-center gap-2 text-sm text-blue-100"
        >

            <a
                href="{{ route('guest.home') }}"
                class="transition hover:text-white"
            >

                Beranda

            </a>

            <span>/</span>

            <a
                href="{{ route('guest.activity.index') }}"
                class="transition hover:text-white"
            >

                Kegiatan

            </a>

            <span>/</span>

            <span
                class="font-semibold text-white"
            >

                {{ $activity->judul }}

            </span>

        </nav>

        <div
            class="max-w-4xl"
        >

            <span
                class="inline-flex rounded-full bg-blue-500/20 px-5 py-2 text-sm font-semibold text-white backdrop-blur"
            >

                {{ $activity->status }}

            </span>

            <h1
                class="mt-6 text-4xl font-black leading-tight text-white md:text-6xl"
            >

                {{ $activity->judul }}

            </h1>

            <p
                class="mt-8 max-w-3xl text-lg leading-9 text-blue-100"
            >

                {{ \Illuminate\Support\Str::limit(strip_tags($activity->isi),220) }}

            </p>

            <div
                class="mt-10 grid gap-5 sm:grid-cols-3"
            >

                <div
                    class="rounded-2xl bg-white/10 p-5 backdrop-blur"
                >

                    <div class="text-3xl">

                        📅

                    </div>

                    <p class="mt-3 text-sm text-blue-200">

                        Tanggal

                    </p>

                    <h3 class="mt-2 font-bold text-white">

                        {{ \Carbon\Carbon::parse($activity->tanggal)->translatedFormat('d F Y') }}

                    </h3>

                </div>

                <div
                    class="rounded-2xl bg-white/10 p-5 backdrop-blur"
                >

                    <div class="text-3xl">

                        📍

                    </div>

                    <p class="mt-3 text-sm text-blue-200">

                        Lokasi

                    </p>

                    <h3 class="mt-2 font-bold text-white">

                        {{ $activity->lokasi }}

                    </h3>

                </div>

                <div
                    class="rounded-2xl bg-white/10 p-5 backdrop-blur"
                >

                    <div class="text-3xl">

                        📷

                    </div>

                    <p class="mt-3 text-sm text-blue-200">

                        Dokumentasi

                    </p>

                    <h3 class="mt-2 font-bold text-white">

                        {{ $activity->images->count() }} Foto

                    </h3>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- ================= CONTENT ================= --}}

<section
    class="bg-gradient-to-b from-slate-50 via-white to-blue-50 py-20"
>

    <div
        class="mx-auto max-w-7xl px-6"
    >

        {{-- Ringkasan --}}

        <div
            class="mb-10 overflow-hidden rounded-3xl bg-white shadow-xl"
        >

            <div
                class="bg-gradient-to-r from-blue-700 to-cyan-600 px-8 py-6 text-white"
            >

                <h2
                    class="text-2xl font-bold"
                >

                    📌 Ringkasan Kegiatan

                </h2>

                <p
                    class="mt-2 text-blue-100"
                >

                    Informasi singkat mengenai kegiatan.

                </p>

            </div>

            <div
                class="p-8"
            >

                <p
                    class="text-lg leading-9 text-slate-700"
                >

                    {{ \Illuminate\Support\Str::limit(strip_tags($activity->isi),300) }}

                </p>

            </div>

        </div>

        <div
            class="grid gap-10 lg:grid-cols-3"
        >

            <div
                class="space-y-8 lg:col-span-2"
            >
{{-- ================= ARTIKEL ================= --}}

<article
    class="overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-slate-200"
>

    @if($activity->thumbnail)

        <div
            class="relative overflow-hidden"
        >

            <img
                src="{{ asset('storage/'.$activity->thumbnail) }}"
                alt="{{ $activity->judul }}"
                class="h-[260px] w-full object-cover transition duration-700 hover:scale-105 md:h-[500px]"
            >

            <div
                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"
            ></div>

            <div
                class="absolute bottom-0 left-0 w-full p-8"
            >

                <span
                    class="rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white"
                >

                    {{ $activity->kategori }}

                </span>

                <h2
                    class="mt-5 text-3xl font-black text-white md:text-5xl"
                >

                    {{ $activity->judul }}

                </h2>

            </div>

        </div>

    @endif

    <div
        class="border-b border-slate-200 px-8 py-6"
    >

        <div
            class="flex flex-wrap items-center gap-6 text-sm text-slate-500"
        >

            <div class="flex items-center gap-2">

                📅

                {{ \Carbon\Carbon::parse($activity->tanggal)->translatedFormat('d F Y') }}

            </div>

            <div class="flex items-center gap-2">

                📍

                {{ $activity->lokasi }}

            </div>

            <div class="flex items-center gap-2">

                📷

                {{ $activity->images->count() }} Dokumentasi

            </div>

        </div>

    </div>

    <div
        class="p-8 md:p-12"
    >

        <div
            class="article-content prose prose-lg max-w-none
            prose-headings:text-slate-800
            prose-headings:font-bold
            prose-p:text-slate-700
            prose-p:leading-9
            prose-a:text-blue-600
            prose-a:no-underline
            prose-strong:text-slate-900
            prose-img:rounded-3xl
            prose-img:mx-auto
            prose-img:shadow-xl
            prose-blockquote:border-l-4
            prose-blockquote:border-blue-600
            prose-blockquote:bg-blue-50
            prose-blockquote:px-6
            prose-blockquote:py-4
            prose-table:w-full
            prose-table:border
            prose-th:border
            prose-td:border
            prose-th:bg-slate-100
            prose-th:p-3
            prose-td:p-3"
        >

            {!! $activity->isi !!}

        </div>

    </div>

</article>

{{-- ================= HIGHLIGHT ================= --}}

<div
    class="grid gap-6 md:grid-cols-3"
>

    <div
        class="rounded-3xl bg-gradient-to-r from-blue-600 to-cyan-500 p-6 text-white shadow-lg"
    >

        <div
            class="text-4xl"
        >

            📅

        </div>

        <h3
            class="mt-4 text-xl font-bold"
        >

            Tanggal

        </h3>

        <p
            class="mt-2 text-blue-100"
        >

            {{ \Carbon\Carbon::parse($activity->tanggal)->translatedFormat('d F Y') }}

        </p>

    </div>

    <div
        class="rounded-3xl bg-gradient-to-r from-emerald-600 to-green-500 p-6 text-white shadow-lg"
    >

        <div
            class="text-4xl"
        >

            📍

        </div>

        <h3
            class="mt-4 text-xl font-bold"
        >

            Lokasi

        </h3>

        <p
            class="mt-2 text-green-100"
        >

            {{ $activity->lokasi }}

        </p>

    </div>

    <div
        class="rounded-3xl bg-gradient-to-r from-orange-500 to-amber-500 p-6 text-white shadow-lg"
    >

        <div
            class="text-4xl"
        >

            📷

        </div>

        <h3
            class="mt-4 text-xl font-bold"
        >

            Dokumentasi

        </h3>

        <p
            class="mt-2 text-orange-100"
        >

            {{ $activity->images->count() }} Foto

        </p>

    </div>

</div>
{{-- ================= DOKUMENTASI ================= --}}

@if($activity->images->count())

<section
    class="overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-slate-200"
>

    <div
        class="flex flex-col items-start justify-between gap-4 border-b bg-gradient-to-r from-blue-700 to-cyan-600 px-8 py-6 text-white md:flex-row md:items-center"
    >

        <div>

            <h2
                class="text-2xl font-bold"
            >

                📸 Dokumentasi Kegiatan

            </h2>

            <p
                class="mt-2 text-blue-100"
            >

                {{ $activity->images->count() }}
                Dokumentasi Foto

            </p>

        </div>

        <span
            class="rounded-full bg-white/20 px-5 py-2 text-sm backdrop-blur"
        >

            Klik foto untuk memperbesar

        </span>

    </div>

    <div
        class="p-6"
    >

        @php

            $total = $activity->images->count();

        @endphp

        @if($total==1)

            <div
                class="group overflow-hidden rounded-3xl"
            >

                <img
                    src="{{ asset('storage/'.$activity->images->first()->gambar) }}"
                    data-index="0"
                    class="gallery-image h-[550px] w-full cursor-pointer object-cover transition duration-700 group-hover:scale-105"
                >

            </div>

        @else

            <div
                class="grid grid-cols-2 gap-5 md:grid-cols-3 xl:grid-cols-4"
            >

                @foreach($activity->images as $index=>$image)

<div
    class="group relative overflow-hidden rounded-3xl bg-slate-100 shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl"
>

    <img
        src="{{ asset('storage/'.$image->gambar) }}"
        data-index="{{ $index }}"
        class="gallery-image h-56 w-full cursor-pointer object-cover transition duration-700 group-hover:scale-110"
    >

    <div
        class="absolute inset-0 pointer-events-none flex items-center justify-center bg-black/0 transition duration-300 group-hover:bg-black/40"
    >

        <div
            class="rounded-full bg-white p-4 text-2xl opacity-0 transition duration-300 group-hover:opacity-100"
        >

            🔍

        </div>

    </div>

</div>

                @endforeach

            </div>

        @endif

    </div>

</section>

@endif

{{-- ================= LOKASI ================= --}}

<section
    class="overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-slate-200"
>

    <div
        class="bg-slate-900 px-8 py-6 text-white"
    >

        <h2
            class="text-2xl font-bold"
        >

            📍 Lokasi Kegiatan

        </h2>

    </div>

    <div
        class="p-8"
    >

        <div
            class="rounded-3xl border border-slate-200 bg-slate-50 p-10 text-center"
        >

            <div
                class="text-7xl"
            >

                📍

            </div>

            <h3
                class="mt-6 text-3xl font-bold text-slate-800"
            >

                {{ $activity->lokasi }}

            </h3>

            <p
                class="mt-4 text-slate-500"
            >

                Lokasi pelaksanaan kegiatan.

            </p>

        </div>

    </div>

</section>

</div>
{{-- ================= SIDEBAR ================= --}}

<aside
    class="space-y-8"
>

    <div
        class="sticky top-28 space-y-8"
    >

        {{-- Informasi Kegiatan --}}

        <div
            class="overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-slate-200"
        >

            <div
                class="bg-gradient-to-r from-blue-700 to-cyan-600 px-6 py-5 text-white"
            >

                <h2
                    class="text-xl font-bold"
                >

                    📋 Informasi Kegiatan

                </h2>

            </div>

            <div
                class="divide-y divide-slate-100"
            >

                <div
                    class="flex items-center gap-4 p-5"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-2xl"
                    >

                        📅

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Tanggal

                        </p>

                        <h3 class="font-semibold text-slate-800">

                            {{ \Carbon\Carbon::parse($activity->tanggal)->translatedFormat('d F Y') }}

                        </h3>

                    </div>

                </div>

                <div
                    class="flex items-center gap-4 p-5"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-2xl"
                    >

                        📍

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Lokasi

                        </p>

                        <h3 class="font-semibold text-slate-800">

                            {{ $activity->lokasi }}

                        </h3>

                    </div>

                </div>

                <div
                    class="flex items-center gap-4 p-5"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100 text-2xl"
                    >

                        🏷️

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Kategori

                        </p>

                        <h3 class="font-semibold text-slate-800">

                            {{ $activity->kategori }}

                        </h3>

                    </div>

                </div>

                <div
                    class="flex items-center gap-4 p-5"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-yellow-100 text-2xl"
                    >

                        📷

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Dokumentasi

                        </p>

                        <h3 class="font-semibold text-slate-800">

                            {{ $activity->images->count() }} Foto

                        </h3>

                    </div>

                </div>

                <div
                    class="flex items-center gap-4 p-5"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-2xl"
                    >

                        📢

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Status

                        </p>

                        <span
                            class="inline-block rounded-full bg-blue-600 px-3 py-1 text-sm font-semibold text-white"
                        >

                            {{ $activity->status }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- Share --}}

        <div
            class="rounded-3xl bg-white p-6 shadow-xl ring-1 ring-slate-200"
        >

            <h2
                class="mb-5 text-xl font-bold"
            >

                📲 Bagikan

            </h2>

            <div
                class="grid gap-3"
            >

                <a
                    href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}"
                    target="_blank"
                    class="rounded-2xl bg-green-600 py-3 text-center font-semibold text-white transition hover:bg-green-700"
                >

                    WhatsApp

                </a>

                <a
                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                    target="_blank"
                    class="rounded-2xl bg-blue-600 py-3 text-center font-semibold text-white transition hover:bg-blue-700"
                >

                    Facebook

                </a>

                <a
                    href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
                    target="_blank"
                    class="rounded-2xl bg-slate-900 py-3 text-center font-semibold text-white transition hover:bg-black"
                >

                    X (Twitter)

                </a>

            </div>

        </div>

        {{-- Kegiatan Terkait --}}

        <div
            class="rounded-3xl bg-white p-6 shadow-xl ring-1 ring-slate-200"
        >

            <h2
                class="mb-6 text-xl font-bold"
            >

                📚 Kegiatan Terkait

            </h2>

            <div
                class="space-y-4"
            >

                @forelse($related as $item)

                    <a
                        href="{{ route('guest.activity.show',$item) }}"
                        class="group flex gap-3 rounded-2xl p-2 transition hover:bg-slate-100"
                    >

                        @if($item->thumbnail)

                            <img
                                src="{{ asset('storage/'.$item->thumbnail) }}"
                                class="h-20 w-24 rounded-xl object-cover transition group-hover:scale-105"
                            >

                        @else

                            <div
                                class="flex h-20 w-24 items-center justify-center rounded-xl bg-slate-200"
                            >

                                📸

                            </div>

                        @endif

                        <div>

                            <span
                                class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700"
                            >

                                {{ $item->status }}

                            </span>

                            <h3
                                class="mt-3 line-clamp-2 font-bold text-slate-800 group-hover:text-blue-700"
                            >

                                {{ $item->judul }}

                            </h3>

                        </div>

                    </a>

                @empty

                    <div
                        class="rounded-2xl bg-slate-100 p-4 text-center text-slate-500"
                    >

                        Belum ada kegiatan lainnya.

                    </div>

                @endforelse

            </div>

        </div>

        {{-- CTA --}}

        <div
            class="overflow-hidden rounded-3xl bg-gradient-to-br from-blue-700 via-cyan-600 to-sky-500 p-8 text-center text-white shadow-xl"
        >

            <div
                class="text-6xl"
            >

                🌍

            </div>

            <h2
                class="mt-5 text-2xl font-bold"
            >

                Mari Peduli Lingkungan

            </h2>

            <p
                class="mt-4 leading-8 text-blue-100"
            >

                Bersama menjaga lingkungan melalui kegiatan nyata untuk masa depan yang lebih baik.

            </p>

            <a
                href="{{ route('guest.activity.index') }}"
                class="mt-8 inline-block rounded-2xl bg-white px-8 py-4 font-bold text-blue-700 transition hover:scale-105"
            >

                Lihat Semua Kegiatan

            </a>

        </div>

    </div>

</aside>

</div>

</div>

</section>
<!-- ================= BACK TO TOP ================= -->

<button
    id="backTop"
    class="fixed bottom-6 right-6 z-50 hidden h-14 w-14 rounded-full bg-blue-600 text-white shadow-xl transition duration-300 hover:scale-110 hover:bg-blue-700"
>

    ↑

</button>

<!-- ================= LIGHTBOX ================= -->

<div
    id="lightbox"
    class="fixed inset-0 z-[99999] hidden items-center justify-center bg-black/95"
>

    <button
        id="closeLightbox"
        class="absolute right-5 top-5 text-5xl text-white hover:text-red-400"
    >

        &times;

    </button>

    <button
        id="prevImage"
        class="absolute left-5 rounded-full bg-white/20 p-4 text-3xl text-white backdrop-blur hover:bg-white/40"
    >

        &#10094;

    </button>

    <img
        id="lightboxImage"
        src=""
        class="max-h-[90vh] max-w-[90vw] rounded-3xl shadow-2xl"
    >

    <button
        id="nextImage"
        class="absolute right-5 rounded-full bg-white/20 p-4 text-3xl text-white backdrop-blur hover:bg-white/40"
    >

        &#10095;

    </button>

    <div
        id="imageCounter"
        class="absolute bottom-8 rounded-full bg-black/50 px-5 py-2 text-white backdrop-blur"
    ></div>

</div>

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function(){

    const gallery = document.querySelectorAll('.gallery-image');

    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const imageCounter = document.getElementById('imageCounter');

    const closeBtn = document.getElementById('closeLightbox');
    const nextBtn = document.getElementById('nextImage');
    const prevBtn = document.getElementById('prevImage');

    if(!gallery.length) return;

    let current = 0;

    function show(index){

        current = index;

        lightboxImage.src = gallery[index].src;

        imageCounter.innerHTML =
            (index+1) + ' / ' + gallery.length;

        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');

        document.body.style.overflow = 'hidden';

    }

    gallery.forEach((img,index)=>{

        img.addEventListener('click',function(){

            show(index);

        });

    });

    function closeViewer(){

        lightbox.classList.remove('flex');
        lightbox.classList.add('hidden');

        document.body.style.overflow='auto';

    }

    closeBtn.addEventListener('click',closeViewer);

    lightbox.addEventListener('click',function(e){

        if(e.target===lightbox){

            closeViewer();

        }

    });

    nextBtn.addEventListener('click',function(){

        current++;

        if(current>=gallery.length){

            current=0;

        }

        show(current);

    });

    prevBtn.addEventListener('click',function(){

        current--;

        if(current<0){

            current=gallery.length-1;

        }

        show(current);

    });

    document.addEventListener('keydown',function(e){

        if(lightbox.classList.contains('hidden')) return;

        if(e.key==="Escape"){

            closeViewer();

        }

        if(e.key==="ArrowRight"){

            nextBtn.click();

        }

        if(e.key==="ArrowLeft"){

            prevBtn.click();

        }

    });

});

</script>

@endpush
