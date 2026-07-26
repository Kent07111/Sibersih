@extends('guest.layouts.guest')

@section('title',$education->judul)

@section('content')
<div
    id="readingProgress"
    class="fixed left-0 top-0 z-[999] h-1 bg-green-500 transition-all duration-150"
    style="width:0%"
></div>
<!-- HERO -->

{{-- ================= HERO ================= --}}

<section
    class="relative overflow-hidden pt-28"
>

    @if($education->thumbnail)

        <img
            src="{{ asset('storage/'.$education->thumbnail) }}"
            class="absolute inset-0 h-full w-full object-cover"
        >

    @endif

    <div
        class="absolute inset-0 bg-gradient-to-r from-green-900/90 via-green-800/80 to-green-700/70"
    ></div>

    <div
        class="relative mx-auto flex min-h-[520px] max-w-7xl items-center px-6"
    >

        <div
            class="max-w-4xl text-white"
        >

            <span
                class="inline-flex rounded-full bg-white/20 px-5 py-2 text-sm font-semibold backdrop-blur"
            >

                🌱 {{ $education->kategori }}

            </span>

            <h1
                class="mt-8 text-4xl font-extrabold leading-tight md:text-6xl"
            >

                {{ $education->judul }}

            </h1>

            <p
                class="mt-6 max-w-3xl text-lg leading-8 text-green-100"
            >

                {{ $education->excerpt }}

            </p>

            <div
                class="mt-10 flex flex-wrap gap-6 text-green-100"
            >

                <div
                    class="rounded-xl bg-white/10 px-5 py-3 backdrop-blur"
                >

                    📅
                    {{ $education->created_at->translatedFormat('d F Y') }}

                </div>

                <div
                    class="rounded-xl bg-white/10 px-5 py-3 backdrop-blur"
                >

                    📖 Edukasi Lingkungan

                </div>

                <div
                    class="rounded-xl bg-white/10 px-5 py-3 backdrop-blur"
                >

                    🌿 Desa Talagasari

                </div>

            </div>

        </div>

    </div>

</section>

<!-- CONTENT -->

<section
    class="bg-gradient-to-b from-green-50 to-slate-100 py-20"
>

    <div
        class="mx-auto max-w-7xl px-6"
    >

        {{-- Ringkasan --}}

        <div
            class="mb-10 overflow-hidden rounded-3xl border border-green-200 bg-white shadow-lg"
        >

            <div
                class="flex items-center gap-4 bg-green-600 px-8 py-5 text-white"
            >

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 text-2xl"
                >

                    💡

                </div>

                <div>

                    <h2
                        class="text-xl font-bold"
                    >

                        Ringkasan Edukasi

                    </h2>

                    <p
                        class="text-green-100"
                    >

                        Pahami poin utama sebelum membaca artikel.

                    </p>

                </div>

            </div>

            <div
                class="p-8"
            >

                <p
                    class="text-lg leading-9 text-slate-700"
                >

                    {{ $education->excerpt }}

                </p>

            </div>

        </div>

        <div
            class="grid gap-10 lg:grid-cols-3"
        >
{{-- ================= ARTIKEL ================= --}}

<div
    class="space-y-8 lg:col-span-2"
>

    {{-- Artikel --}}

    <article
        class="overflow-hidden rounded-3xl bg-white shadow-xl"
    >

        @if($education->thumbnail)

            <div
                class="relative"
            >

                <img
                    src="{{ asset('storage/'.$education->thumbnail) }}"
                    class="h-[450px] w-full object-cover transition duration-500 hover:scale-105"
                >

                <div
                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-8"
                >

                    <span
                        class="rounded-full bg-green-500 px-4 py-2 text-sm font-semibold text-white"
                    >

                        {{ $education->kategori }}

                    </span>

                </div>

            </div>

        @endif

        <div
            class="article-content p-8 md:p-12"
        >

            {!! $education->isi !!}

        </div>

    </article>


@if($education->video_url)

    @php
        $youtubeIframe = preg_replace(
            [
                '/\swidth=["\'][^"\']*["\']/i',
                '/\sheight=["\'][^"\']*["\']/i',
                '/<iframe/i',
            ],
            [
                '',
                '',
                '<iframe class="h-full w-full"',
            ],
            $education->video_url
        );
    @endphp

    <div class="overflow-hidden rounded-3xl bg-white shadow-xl">

        <div class="border-b bg-green-600 px-8 py-5 text-white">

            <h2 class="text-2xl font-bold">
                🎥 Video Edukasi
            </h2>

            <p class="mt-2 text-green-100">
                Tonton video untuk memahami materi dengan lebih mudah.
            </p>

        </div>

        <div class="p-8">

            <div class="aspect-video overflow-hidden rounded-2xl bg-black shadow-lg">

                {!! $youtubeIframe !!}

            </div>

        </div>

    </div>

@endif

{{-- ================= POWERPOINT ================= --}}

@if($education->ppt)

    @php
        $pptUrl = asset('storage/' . $education->ppt);

        $pptViewerUrl =
            'https://view.officeapps.live.com/op/embed.aspx?src=' .
            urlencode($pptUrl);
    @endphp

    <div class="overflow-hidden rounded-3xl bg-white shadow-xl">

        <div
            class="flex flex-col gap-4 border-b bg-gradient-to-r from-orange-600 to-amber-500 px-8 py-5 text-white sm:flex-row sm:items-center sm:justify-between"
        >

            <div>

                <h2 class="text-2xl font-bold">
                    📊 Materi PowerPoint
                </h2>

                <p class="mt-2 text-orange-100">
                    Pelajari materi presentasi langsung melalui halaman ini.
                </p>

            </div>

            <a
                href="{{ $pptUrl }}"
                download
                class="inline-flex items-center justify-center rounded-xl bg-white px-5 py-3 font-semibold text-orange-700 transition hover:scale-105 hover:bg-orange-50"
            >
                Download PPT
            </a>

        </div>

        <div class="p-4 md:p-8">

            <div
                class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-100 shadow-inner"
            >

                <iframe
                    src="{{ $pptViewerUrl }}"
                    title="PowerPoint {{ $education->judul }}"
                    class="h-[450px] w-full md:h-[650px] lg:h-[720px]"
                    frameborder="0"
                    allowfullscreen
                ></iframe>

            </div>

        </div>

    </div>

@endif
    {{-- ================= PDF ================= --}}

    @if($education->pdf)

        <div
            class="rounded-3xl border border-red-200 bg-white shadow-xl"
        >

            <div
                class="flex flex-col items-center gap-5 p-10 text-center md:flex-row md:text-left"
            >

                <div
                    class="flex h-20 w-20 items-center justify-center rounded-3xl bg-red-100 text-5xl"
                >

                    📄

                </div>

                <div
                    class="flex-1"
                >

                    <h2
                        class="text-2xl font-bold text-slate-800"
                    >

                        Materi PDF

                    </h2>

                    <p
                        class="mt-2 text-slate-500"
                    >

                        Unduh materi edukasi untuk dibaca secara offline.

                    </p>

                </div>

                <a
                    href="{{ asset('storage/'.$education->pdf) }}"
                    target="_blank"
                    class="rounded-2xl bg-red-600 px-8 py-4 font-semibold text-white transition hover:scale-105 hover:bg-red-700"
                >

                    Download PDF

                </a>

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

        {{-- Informasi Artikel --}}

        <div
            class="overflow-hidden rounded-3xl bg-white shadow-xl"
        >

            <div
                class="bg-gradient-to-r from-green-700 to-green-600 p-6 text-white"
            >

                <h2
                    class="text-2xl font-bold"
                >

                    📘 Informasi Artikel

                </h2>

            </div>

            <div
                class="space-y-6 p-6"
            >

                <div
                    class="flex items-center gap-4"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100 text-xl"
                    >

                        🌱

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Kategori

                        </p>

                        <h3 class="font-bold">

                            {{ $education->kategori }}

                        </h3>

                    </div>

                </div>

                <div
                    class="flex items-center gap-4"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-xl"
                    >

                        📅

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Dipublikasikan

                        </p>

                        <h3 class="font-bold">

                            {{ $education->created_at->translatedFormat('d F Y') }}

                        </h3>

                    </div>

                </div>

                <div
                    class="flex items-center gap-4"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-yellow-100 text-xl"
                    >

                        ⏱️

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Estimasi Membaca

                        </p>

                        <h3 class="font-bold">

                            {{ max(1, ceil(str_word_count(strip_tags($education->isi))/200)) }}
                            Menit

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

                📲 Bagikan Edukasi

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

        {{-- Artikel Terkait --}}

        <div
            class="rounded-3xl bg-white p-6 shadow-xl"
        >

            <h2
                class="mb-6 text-xl font-bold"
            >

                📚 Artikel Terkait

            </h2>

            <div
                class="space-y-5"
            >

                @forelse($related as $item)

                    <a
                        href="{{ route('guest.education.show',$item) }}"
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

                                📚

                            </div>

                        @endif

                        <div>

                            <span
                                class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700"
                            >

                                {{ $item->kategori }}

                            </span>

                            <h3
                                class="mt-3 line-clamp-2 font-bold text-slate-800 group-hover:text-green-700"
                            >

                                {{ $item->judul }}

                            </h3>

                        </div>

                    </a>

                @empty

                    <p class="text-slate-500">

                        Belum ada artikel terkait.

                    </p>

                @endforelse

            </div>

        </div>

        {{-- CTA --}}

        <div
            class="rounded-3xl bg-gradient-to-br from-green-700 via-green-600 to-lime-500 p-8 text-center text-white shadow-xl"
        >

            <div
                class="text-5xl"
            >

                🌍

            </div>

            <h2
                class="mt-5 text-2xl font-bold"
            >

                Mari Jaga Lingkungan

            </h2>

            <p
                class="mt-4 leading-8 text-green-100"
            >

                Mulailah dari langkah kecil seperti memilah sampah, mengurangi plastik sekali pakai, dan menjaga kebersihan lingkungan sekitar.

            </p>

            <a
                href="{{ route('guest.education.index') }}"
                class="mt-8 inline-block rounded-2xl bg-white px-8 py-4 font-bold text-green-700 transition hover:scale-105"
            >

                📖 Lihat Edukasi Lain

            </a>

        </div>

    </div>

</aside>
<button
    id="backTop"
    class="fixed bottom-8 right-8 hidden h-14 w-14 rounded-full bg-green-600 text-2xl text-white shadow-xl transition hover:scale-110 hover:bg-green-700"
>

    ↑

</button>
<div
    id="imageViewer"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/90 p-10"
>

    <img
        id="viewerImage"
        class="max-h-full max-w-full rounded-2xl shadow-2xl"
    >

</div>
@endsection
@push('scripts')

<script>

window.addEventListener('scroll', () => {

    const scrollTop = document.documentElement.scrollTop;

    const scrollHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

    const progress = (scrollTop / scrollHeight) * 100;

    document.getElementById('readingProgress')
        .style.width = progress + '%';

});
const backTop = document.getElementById('backTop');

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
document
.querySelectorAll('.article-content img')
.forEach(img=>{

    img.onclick=function(){

        document
            .getElementById('viewerImage')
            .src=this.src;

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
.onclick=function(){

    this.classList.remove('flex');

    this.classList.add('hidden');

};
</script>

@endpush
