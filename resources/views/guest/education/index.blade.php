@extends('guest.layouts.guest')

@section('title','Edukasi')

@section('content')

<!-- HERO -->

<section
    class="relative overflow-hidden bg-gradient-to-r from-green-800 via-green-600 to-green-500 pt-36 pb-40"
>

    {{-- Background Pattern --}}

    <div
        class="absolute inset-0 opacity-10"
    >

        <div class="absolute left-10 top-20 text-8xl">🌿</div>

        <div class="absolute right-20 top-32 text-7xl">♻️</div>

        <div class="absolute bottom-10 left-1/3 text-8xl">🍃</div>

        <div class="absolute bottom-20 right-32 text-7xl">🌱</div>

    </div>

    <div
        class="relative mx-auto max-w-5xl px-6 text-center"
        data-aos="fade-up"
    >

        <span
            class="inline-flex items-center rounded-full bg-white/20 px-5 py-2 text-sm font-semibold text-white backdrop-blur"
        >

            📚 Edukasi Lingkungan

        </span>

        <h1
            class="mt-8 text-5xl font-extrabold text-white lg:text-6xl"
        >

            Artikel Edukasi

        </h1>

        <p
            class="mx-auto mt-8 max-w-3xl text-xl leading-9 text-green-100"
        >

            Pelajari cara mengelola sampah,
            membuat kompos,
            Eco Enzyme,
            serta berbagai informasi mengenai
            pelestarian lingkungan.

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
                class="grid gap-5 lg:grid-cols-12"
            >

                {{-- SEARCH --}}

                <div
                    class="lg:col-span-4"
                >

                    <div
                        class="relative"
                    >

                        <svg
                            class="absolute left-5 top-1/2 h-6 w-6 -translate-y-1/2 text-slate-400"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >

                            <circle
                                cx="11"
                                cy="11"
                                r="8"
                            />

                            <path
                                d="m21 21-4.3-4.3"
                            />

                        </svg>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari artikel..."
                            class="w-full rounded-2xl border p-5 pl-14 focus:border-green-600 focus:ring-0"
                        >

                    </div>

                </div>

                {{-- KATEGORI --}}

                <div
                    class="lg:col-span-4"
                >

                    <select
                        name="kategori"
                        class="w-full rounded-2xl border p-5 focus:border-green-600 focus:ring-0"
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

                {{-- BUTTON --}}

                <div
                    class="lg:col-span-4"
                >

                    <button
                        class="w-full rounded-2xl bg-green-600 p-5 text-lg font-bold text-white transition hover:bg-green-700"
                    >

                        🔍 Cari Artikel

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

        <div
            class="mb-10"
        >

            <h2
                class="text-4xl font-bold text-slate-800"
            >

                Semua Edukasi

            </h2>

            <p
                class="mt-3 text-slate-500"
            >

                {{ $educations->total() }} Artikel

            </p>

        </div>

        <div
            class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3"
        >
@forelse($educations as $education)

    <article
        data-aos="fade-up"
        class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl"
    >

        {{-- Thumbnail --}}
        <div class="relative overflow-hidden">

            @if($education->thumbnail)

                <img
                    src="{{ asset('storage/'.$education->thumbnail) }}"
                    alt="{{ $education->judul }}"
                    class="h-60 w-full object-cover transition duration-500 group-hover:scale-110"
                >

            @else

                <div
                    class="flex h-60 items-center justify-center bg-slate-100"
                >

                    <span class="text-6xl">

                        📚

                    </span>

                </div>

            @endif

            {{-- Badge --}}
            <div
                class="absolute left-5 top-5"
            >

                <span
                    class="rounded-full bg-green-600 px-4 py-2 text-xs font-semibold text-white shadow"
                >

                    {{ $education->kategori }}

                </span>

            </div>

        </div>

        {{-- Content --}}
        <div
            class="flex flex-1 flex-col p-6"
        >

            <div
                class="mb-4 flex items-center justify-between text-sm text-slate-500"
            >

                <span>

                    📅 {{ $education->created_at->translatedFormat('d F Y') }}

                </span>

                @if($education->video_url)

                    <span
                        class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-600"
                    >

                        🎥 Video

                    </span>

                @endif

            </div>

            {{-- Judul --}}
            <h3
                class="line-clamp-2 text-2xl font-bold text-slate-800"
            >

                {{ $education->judul }}

            </h3>

            {{-- Preview --}}
            <p
                class="mt-4 line-clamp-3 flex-1 leading-7 text-slate-600"
            >

                {{ $education->slug }}

            </p>

            {{-- Footer --}}
            <div
                class="mt-8 flex items-center justify-between border-t pt-5"
            >

                <a
                    href="{{ route('guest.education.show',$education) }}"
                    class="font-semibold text-green-600 transition hover:text-green-700"
                >

                    Baca Selengkapnya →

                </a>

                @if($education->pdf)

                    <span
                        class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700"
                    >

                        📄 PDF

                    </span>

                @endif

            </div>

        </div>

    </article>

@empty

    <div
        class="col-span-full rounded-3xl bg-white py-24 text-center shadow-lg"
    >

        <div class="text-7xl">

            📚

        </div>

        <h3
            class="mt-6 text-3xl font-bold text-slate-800"
        >

            Belum Ada Edukasi

        </h3>

        <p
            class="mt-3 text-slate-500"
        >

            Artikel edukasi belum tersedia.

        </p>

    </div>

@endforelse
        </div>

        {{-- Pagination --}}

        @if($educations->hasPages())

            <div
                class="mt-16 flex justify-center"
            >

                {{ $educations->links() }}

            </div>

        @endif

    </div>

</section>

@endsection
