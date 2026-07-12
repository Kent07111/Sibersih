@extends('guest.layouts.guest')

@section('title',$education->judul)

@section('content')

<!-- HERO -->

<section
    class="relative overflow-hidden bg-gradient-to-r from-green-800 via-green-600 to-green-500 pt-36 pb-24"
>

    <div
        class="mx-auto max-w-5xl px-6 text-center"
    >

        <span
            class="rounded-full bg-white/20 px-4 py-2 text-sm font-semibold text-white"
        >

            {{ $education->kategori }}

        </span>

        <h1
            class="mt-8 text-5xl font-bold leading-tight text-white"
        >

            {{ $education->judul }}

        </h1>

        <div
            class="mt-8 flex items-center justify-center gap-6 text-green-100"
        >

            <span>

                📅
                {{ $education->created_at->translatedFormat('d F Y') }}

            </span>

            <span>

                📖
                Edukasi Lingkungan

            </span>

        </div>

    </div>

</section>

<!-- CONTENT -->

<section
    class="bg-slate-50 py-20"
>

    <div
        class="mx-auto grid max-w-7xl gap-10 px-6 lg:grid-cols-3"
    >

        <!-- Artikel -->

        <div
            class="lg:col-span-2"
        >

            <div
                class="overflow-hidden rounded-3xl bg-white shadow-xl"
            >

                @if($education->thumbnail)

                    <img
                        src="{{ asset('storage/'.$education->thumbnail) }}"
                        class="h-[450px] w-full object-cover"
                    >

                @endif

                <div
                    class="p-10"
                >

                    {!! $education->isi !!}

                </div>

            </div>

            {{-- Video --}}

            @if($education->video_url)

                <div
                    class="mt-8 rounded-3xl bg-white p-8 shadow-xl"
                >

                    <h2
                        class="mb-6 text-2xl font-bold"
                    >

                        🎥 Video Edukasi

                    </h2>

                    <div
                        class="aspect-video overflow-hidden rounded-2xl"
                    >

                        <iframe
                            src="{{ $education->video_url }}"
                            class="h-full w-full"
                            allowfullscreen
                        ></iframe>

                    </div>

                </div>

            @endif

            {{-- PDF --}}

            @if($education->pdf)

                <div
                    class="mt-8 rounded-3xl bg-white p-8 shadow-xl"
                >

                    <h2
                        class="mb-5 text-2xl font-bold"
                    >

                        📄 Materi PDF

                    </h2>

                    <a
                        href="{{ asset('storage/'.$education->pdf) }}"
                        target="_blank"
                        class="inline-flex rounded-xl bg-red-600 px-6 py-4 font-semibold text-white hover:bg-red-700"
                    >

                        Download PDF

                    </a>

                </div>

            @endif

        </div>

        <!-- Sidebar -->

        <div
            class="space-y-8"
        >

            <div
                class="rounded-3xl bg-white p-8 shadow-xl"
            >

                <h2
                    class="text-2xl font-bold"
                >

                    Informasi

                </h2>

                <div
                    class="mt-6 space-y-4"
                >

                    <div>

                        <strong>Kategori</strong>

                        <p class="mt-2">

                            {{ $education->kategori }}

                        </p>

                    </div>

                    <div>

                        <strong>Dibuat</strong>

                        <p class="mt-2">

                            {{ $education->created_at->translatedFormat('d F Y') }}

                        </p>

                    </div>

                </div>

            </div>
            {{-- Artikel Terkait --}}

            <div
                class="rounded-3xl bg-white p-8 shadow-xl"
            >

                <h2
                    class="mb-6 text-2xl font-bold"
                >

                    Artikel Terkait

                </h2>

                <div
                    class="space-y-6"
                >

                    @forelse($related as $item)

                        <a
                            href="{{ route('guest.education.show',$item) }}"
                            class="flex gap-4 transition hover:opacity-80"
                        >

                            @if($item->thumbnail)

                                <img
                                    src="{{ asset('storage/'.$item->thumbnail) }}"
                                    class="h-20 w-24 rounded-xl object-cover"
                                >

                            @else

                                <div
                                    class="flex h-20 w-24 items-center justify-center rounded-xl bg-slate-100"
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
                                    class="mt-3 line-clamp-2 font-bold text-slate-800"
                                >

                                    {{ $item->judul }}

                                </h3>

                            </div>

                        </a>

                    @empty

                        <p
                            class="text-slate-500"
                        >

                            Belum ada artikel terkait.

                        </p>

                    @endforelse

                </div>

            </div>

            {{-- Share --}}

            <div
                class="rounded-3xl bg-white p-8 shadow-xl"
            >

                <h2
                    class="mb-6 text-2xl font-bold"
                >

                    Bagikan

                </h2>

                <div
                    class="grid grid-cols-3 gap-4"
                >

                    <a
                        href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}"
                        target="_blank"
                        class="rounded-xl bg-green-600 py-4 text-center font-bold text-white hover:bg-green-700"
                    >

                        WhatsApp

                    </a>

                    <a
                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                        target="_blank"
                        class="rounded-xl bg-blue-600 py-4 text-center font-bold text-white hover:bg-blue-700"
                    >

                        Facebook

                    </a>

                    <a
                        href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
                        target="_blank"
                        class="rounded-xl bg-slate-800 py-4 text-center font-bold text-white hover:bg-black"
                    >

                        X

                    </a>

                </div>

            </div>

            {{-- Tombol Kembali --}}

            <a
                href="{{ route('guest.education.index') }}"
                class="block rounded-2xl bg-green-600 py-4 text-center text-lg font-semibold text-white transition hover:bg-green-700"
            >

                ← Kembali ke Edukasi

            </a>

        </div>

    </div>

</section>

@endsection
