@extends('guest.layouts.guest')

@section('title',$activity->judul)

@section('content')

@php
    use Illuminate\Support\Str;

    $photos = json_decode($activity->dokumentasi ?? '[]', true);
@endphp

<!-- Reading Progress -->

<div
    id="readingProgress"
    class="fixed left-0 top-0 z-[999] h-1 bg-blue-500 transition-all duration-150"
    style="width:0%"
></div>

<!-- HERO -->

<section
    class="relative overflow-hidden pt-28"
>

    @if($activity->thumbnail)

        <img
            src="{{ asset('storage/'.$activity->thumbnail) }}"
            class="absolute inset-0 h-full w-full object-cover"
            alt="{{ $activity->judul }}"
        >

    @endif

    <!-- Overlay -->

    <div
        class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-blue-900/80 to-cyan-700/70"
    ></div>

    <div
        class="relative mx-auto flex min-h-[560px] max-w-7xl items-center px-6"
    >

        <div
            class="max-w-4xl text-white"
            data-aos="fade-up"
        >

            <!-- Status -->

            <span
                class="inline-flex items-center rounded-full bg-white/20 px-5 py-2 text-sm font-semibold backdrop-blur"
            >

                📅 {{ $activity->status }}

            </span>

            <!-- Title -->

            <h1
                class="mt-8 text-4xl font-extrabold leading-tight md:text-6xl"
            >

                {{ $activity->judul }}

            </h1>

            <!-- Excerpt -->

            <p
                class="mt-6 max-w-3xl text-lg leading-8 text-blue-100"
            >

                {{ Str::limit(strip_tags($activity->deskripsi),220) }}

            </p>

            <!-- Info -->

            <div
                class="mt-10 flex flex-wrap gap-6 text-blue-100"
            >

                <div
                    class="rounded-xl bg-white/10 px-5 py-3 backdrop-blur"
                >

                    📅

                    {{ \Carbon\Carbon::parse($activity->tanggal)->translatedFormat('d F Y') }}

                </div>

                <div
                    class="rounded-xl bg-white/10 px-5 py-3 backdrop-blur"
                >

                    📍

                    {{ $activity->lokasi }}

                </div>

                <div
                    class="rounded-xl bg-white/10 px-5 py-3 backdrop-blur"
                >

                    📷

                    {{ count($photos) }}

                    Dokumentasi

                </div>

            </div>

        </div>

    </div>

</section>

<!-- CONTENT -->

<section
    class="bg-gradient-to-b from-blue-50 to-slate-100 py-20"
>

    <div
        class="mx-auto max-w-7xl px-6"
    >

        <!-- Ringkasan -->

        <div
            class="mb-10 overflow-hidden rounded-3xl border border-blue-200 bg-white shadow-lg"
        >

            <div
                class="flex items-center gap-4 bg-blue-600 px-8 py-5 text-white"
            >

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 text-2xl"
                >

                    📌

                </div>

                <div>

                    <h2
                        class="text-xl font-bold"
                    >

                        Ringkasan Kegiatan

                    </h2>

                    <p
                        class="text-blue-100"
                    >

                        Informasi singkat mengenai kegiatan yang dilaksanakan.

                    </p>

                </div>

            </div>

            <div
                class="p-8"
            >

                <p
                    class="text-lg leading-9 text-slate-700"
                >

                    {{ Str::limit(strip_tags($activity->deskripsi),300) }}

                </p>

            </div>

        </div>

        <div
            class="grid gap-10 lg:grid-cols-3"
        >

            <!-- Artikel -->

            <div
                class="space-y-8 lg:col-span-2"
            ></div>
{{-- ================= DESKRIPSI ================= --}}

<article
    class="overflow-hidden rounded-3xl bg-white shadow-xl"
>

    @if($activity->thumbnail)

        <div
            class="relative"
        >

            <img
                src="{{ asset('storage/'.$activity->thumbnail) }}"
                alt="{{ $activity->judul }}"
                class="h-[450px] w-full object-cover transition duration-500 hover:scale-105"
            >

            <div
                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-8"
            >

                <span
                    class="rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white"
                >

                    {{ $activity->status }}

                </span>

            </div>

        </div>

    @endif

    <div
        class="article-content p-8 md:p-12"
    >

        {!! $activity->deskripsi !!}

    </div>

</article>

{{-- ================= DOKUMENTASI ================= --}}

@if(count($photos))

<div
    class="overflow-hidden rounded-3xl bg-white shadow-xl"
>

    <div
        class="border-b bg-blue-600 px-8 py-5 text-white"
    >

        <h2
            class="text-2xl font-bold"
        >

            📸 Dokumentasi Kegiatan

        </h2>

        <p
            class="mt-2 text-blue-100"
        >

            Dokumentasi kegiatan yang telah dilaksanakan.

        </p>

    </div>

    <div
        class="grid grid-cols-2 gap-5 p-8 md:grid-cols-3"
    >

        @foreach($photos as $photo)

            <div
                class="group cursor-pointer overflow-hidden rounded-2xl"
            >

                <img
                    src="{{ asset('storage/'.$photo) }}"
                    class="gallery-image h-64 w-full object-cover transition duration-500 group-hover:scale-110"
                    alt="Dokumentasi"
                >

            </div>

        @endforeach

    </div>

</div>

@endif

{{-- ================= MAP ================= --}}

@if($activity->lokasi)

<div
    class="overflow-hidden rounded-3xl bg-white shadow-xl"
>

    <div
        class="border-b bg-slate-800 px-8 py-5 text-white"
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
            class="rounded-2xl border bg-slate-50 p-8 text-center"
        >

            <div
                class="text-6xl"
            >

                📍

            </div>

            <h3
                class="mt-5 text-2xl font-bold text-slate-800"
            >

                {{ $activity->lokasi }}

            </h3>

            <p
                class="mt-3 text-slate-500"
            >

                Lokasi pelaksanaan kegiatan.

            </p>

        </div>

    </div>

</div>

@endif

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
            class="overflow-hidden rounded-3xl bg-white shadow-xl"
        >

            <div
                class="bg-gradient-to-r from-blue-700 to-cyan-600 p-6 text-white"
            >

                <h2
                    class="text-2xl font-bold"
                >

                    📋 Informasi Kegiatan

                </h2>

            </div>

            <div
                class="space-y-6 p-6"
            >

                {{-- Status --}}

                <div
                    class="flex items-center gap-4"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-xl"
                    >

                        📢

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Status

                        </p>

                        <h3 class="font-bold">

                            {{ $activity->status }}

                        </h3>

                    </div>

                </div>

                {{-- Tanggal --}}

                <div
                    class="flex items-center gap-4"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100 text-xl"
                    >

                        📅

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Tanggal

                        </p>

                        <h3 class="font-bold">

                            {{ \Carbon\Carbon::parse($activity->tanggal)->translatedFormat('d F Y') }}

                        </h3>

                    </div>

                </div>

                {{-- Lokasi --}}

                <div
                    class="flex items-center gap-4"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-xl"
                    >

                        📍

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Lokasi

                        </p>

                        <h3 class="font-bold">

                            {{ $activity->lokasi }}

                        </h3>

                    </div>

                </div>

                {{-- Dokumentasi --}}

                <div
                    class="flex items-center gap-4"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-yellow-100 text-xl"
                    >

                        📷

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Dokumentasi

                        </p>

                        <h3 class="font-bold">

                            {{ count($photos) }} Foto

                        </h3>

                    </div>

                </div>

            </div>

        </div>

        {{-- Bagikan --}}

        <div
            class="rounded-3xl bg-white p-6 shadow-xl"
        >

            <h2
                class="mb-5 text-xl font-bold"
            >

                📲 Bagikan Kegiatan

            </h2>

            <div
                class="space-y-3"
            >

                <a
                    href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}"
                    target="_blank"
                    class="flex items-center justify-center rounded-2xl bg-green-600 py-4 font-semibold text-white transition hover:scale-[1.02] hover:bg-green-700"
                >

                    WhatsApp

                </a>

                <a
                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                    target="_blank"
                    class="flex items-center justify-center rounded-2xl bg-blue-600 py-4 font-semibold text-white transition hover:scale-[1.02] hover:bg-blue-700"
                >

                    Facebook

                </a>

                <a
                    href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
                    target="_blank"
                    class="flex items-center justify-center rounded-2xl bg-slate-900 py-4 font-semibold text-white transition hover:scale-[1.02]"
                >

                    X (Twitter)

                </a>

            </div>

        </div>

        {{-- Kegiatan Terkait --}}

        <div
            class="rounded-3xl bg-white p-6 shadow-xl"
        >

            <h2
                class="mb-6 text-xl font-bold"
            >

                📚 Kegiatan Terkait

            </h2>

            <div
                class="space-y-5"
            >

                @forelse($related as $item)

                    <a
                        href="{{ route('guest.activity.show',$item) }}"
                        class="group flex gap-4 rounded-2xl p-2 transition hover:bg-slate-100"
                    >

                        @if($item->thumbnail)

                            <img
                                src="{{ asset('storage/'.$item->thumbnail) }}"
                                class="h-20 w-24 rounded-xl object-cover transition group-hover:scale-105"
                            >

                        @else

                            <div
                                class="flex h-20 w-24 items-center justify-center rounded-xl bg-slate-200 text-2xl"
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

                    <p class="text-slate-500">

                        Belum ada kegiatan terkait.

                    </p>

                @endforelse

            </div>

        </div>

        {{-- CTA --}}

        <div
            class="rounded-3xl bg-gradient-to-br from-blue-700 via-cyan-600 to-sky-500 p-8 text-center text-white shadow-xl"
        >

            <div
                class="text-5xl"
            >

                🌍

            </div>

            <h2
                class="mt-5 text-2xl font-bold"
            >

                Mari Ikut Berpartisipasi

            </h2>

            <p
                class="mt-4 leading-8 text-blue-100"
            >

                Bersama masyarakat kita dapat menjaga kebersihan lingkungan melalui kegiatan nyata dan gotong royong.

            </p>

            <a
                href="{{ route('guest.activity.index') }}"
                class="mt-8 inline-block rounded-2xl bg-white px-8 py-4 font-bold text-blue-700 transition hover:scale-105"
            >

                📅 Lihat Semua Kegiatan

            </a>

        </div>

    </div>

</aside>

</div>

</div>

</section>
<!-- Back To Top -->

<button
    id="backTop"
    class="fixed bottom-8 right-8 hidden h-14 w-14 rounded-full bg-blue-600 text-2xl text-white shadow-xl transition hover:scale-110 hover:bg-blue-700"
>

    ↑

</button>

<!-- Image Viewer -->

<div
    id="imageViewer"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/90 p-8"
>

    <img
        id="viewerImage"
        class="max-h-full max-w-full rounded-2xl shadow-2xl"
    >

</div>

@endsection

@push('scripts')

<script>

    /*
    |--------------------------------------------------------------------------
    | Reading Progress
    |--------------------------------------------------------------------------
    */

    window.addEventListener('scroll', () => {

        const scrollTop =
            document.documentElement.scrollTop;

        const scrollHeight =
            document.documentElement.scrollHeight -
            document.documentElement.clientHeight;

        const progress =
            (scrollTop / scrollHeight) * 100;

        document
            .getElementById('readingProgress')
            .style.width = progress + '%';

    });

    /*
    |--------------------------------------------------------------------------
    | Back To Top
    |--------------------------------------------------------------------------
    */

    const backTop =
        document.getElementById('backTop');

    window.addEventListener('scroll', () => {

        if(window.scrollY > 400){

            backTop.classList.remove('hidden');

        }else{

            backTop.classList.add('hidden');

        }

    });

    backTop.onclick = () => {

        window.scrollTo({

            top:0,

            behavior:'smooth'

        });

    };

    /*
    |--------------------------------------------------------------------------
    | Gallery Viewer
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.gallery-image')
        .forEach(image => {

            image.onclick = function(){

                document
                    .getElementById('viewerImage')
                    .src = this.src;

                document
                    .getElementById('imageViewer')
                    .classList.remove('hidden');

                document
                    .getElementById('imageViewer')
                    .classList.add('flex');

            };

        });

    document
        .getElementById('imageViewer')
        .onclick = function(){

            this.classList.remove('flex');

            this.classList.add('hidden');

        };

</script>

@endpush
<div
    class="relative z-10 mx-auto max-w-7xl px-6 pt-10"
>

    <nav
        class="flex items-center gap-2 text-sm text-blue-100"
    >

        <a
            href="{{ route('guest.home') }}"
            class="hover:text-white"
        >

            Beranda

        </a>

        <span>/</span>

        <a
            href="{{ route('guest.activity.index') }}"
            class="hover:text-white"
        >

            Kegiatan

        </a>

        <span>/</span>

        <span class="font-semibold text-white">

            Detail

        </span>

    </nav>

</div>
