@extends('layouts.admin')

@section('title','Gallery')

@section('content')

<div
    x-data="galleryApp()"
    class="space-y-8"
>

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Gallery
            </h1>

            <p class="mt-2 text-slate-500">
                Dokumentasi seluruh kegiatan SIBERSIH.
            </p>

        </div>

        <a
            href="{{ route('gallery.create') }}"
            class="inline-flex items-center justify-center rounded-xl bg-green-600 px-5 py-3 font-semibold text-white shadow transition hover:bg-green-700"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="mr-2 h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                />
            </svg>

            Tambah Gallery
        </a>

    </div>

    {{-- Filter --}}
    <form
        method="GET"
        class="rounded-2xl bg-white p-5 shadow"
    >

        <div class="grid gap-4 lg:grid-cols-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari kegiatan..."
                class="rounded-xl border p-3"
            >

            <select
                name="activity"
                class="rounded-xl border p-3"
            >

                <option value="">

                    Semua Kegiatan

                </option>

                @foreach($activities as $activity)

                    <option
                        value="{{ $activity->id }}"
                        @selected(request('activity')==$activity->id)
                    >

                        {{ $activity->judul }}

                    </option>

                @endforeach

            </select>

            <button
                class="rounded-xl bg-green-600 text-white font-semibold"
            >

                Filter

            </button>

        </div>

    </form>

{{-- Gallery --}}
<div
    class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
>

    @forelse($gallery as $item)

        <div
            class="group relative overflow-hidden rounded-2xl bg-white shadow transition hover:-translate-y-1 hover:shadow-xl"
        >
        {{-- Tombol Hapus --}}
        <div class="absolute right-3 top-3 z-30">

            @if($item->type=='image')

                <form
                    action="{{ route('gallery.image.destroy', $item->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus foto ini?')"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-white shadow-lg transition hover:bg-red-700"
                        title="Hapus Foto"
                    >

                        🗑

                    </button>

                </form>

            @else

                <form
                    action="{{ route('gallery.video.destroy', $item->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus video ini?')"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-white shadow-lg transition hover:bg-red-700"
                        title="Hapus Video"
                    >

                        🗑

                    </button>

                </form>

            @endif

        </div>
            @if($item->type=='image')

                <img
                    src="{{ asset('storage/'.$item->path) }}"
                    class="h-64 w-full cursor-pointer object-cover transition duration-300 group-hover:scale-105"
                    @click="openImage(
                        '{{ asset('storage/'.$item->path) }}',
                        @js($item->activity->judul),
                        @js($item->activity->lokasi),
                        @js($item->activity->tanggal->format('d F Y')),
                        @js(strip_tags($item->activity->isi))
                    )"
                >

            @else

                <div
                    class="relative cursor-pointer"
                    @click="openVideo(
                        '{{ asset('storage/'.$item->path) }}',
                        @js($item->activity->judul),
                        @js($item->activity->lokasi),
                        @js($item->activity->tanggal->format('d F Y')),
                        @js(strip_tags($item->activity->isi))
                    )"
                >

                    <video
                        class="h-64 w-full object-cover"
                        muted
                        preload="metadata"
                    >

                        <source src="{{ asset('storage/'.$item->path) }}">

                    </video>

                    <div
                        class="absolute inset-0 flex items-center justify-center bg-black/30"
                    >

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 text-3xl"
                        >

                            ▶

                        </div>

                    </div>

                    <span
                        class="absolute right-3 top-3 rounded-lg bg-red-600 px-3 py-1 text-xs font-bold text-white"
                    >

                        VIDEO

                    </span>

                </div>

            @endif

            <div class="space-y-2 p-4">

                <h2 class="line-clamp-1 text-lg font-bold">

                    {{ $item->activity->judul }}

                </h2>

                <p class="text-sm text-slate-500">

                    {{ $item->activity->tanggal->format('d F Y') }}

                </p>

                <p class="line-clamp-2 text-sm text-slate-600">

                    {{ Str::limit(strip_tags($item->activity->isi),80) }}

                </p>

            </div>

        </div>

    @empty

        <div
            class="col-span-full rounded-2xl bg-white p-20 text-center shadow"
        >

            <div class="text-7xl">

                📂

            </div>

            <h2 class="mt-4 text-2xl font-bold">

                Gallery Masih Kosong

            </h2>

            <p class="mt-2 text-slate-500">

                Belum ada foto ataupun video.

            </p>

        </div>

    @endforelse

</div>


    <div>

        {{-- Pagination --}}

    </div>
    {{-- Lightbox --}}
    <div
        x-show="show"
        x-transition
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-6"
    >

        <div
            @click.away="show=false"
            @click.away="show=false;media='';"
            class="relative w-full max-w-6xl overflow-hidden rounded-2xl bg-white shadow-2xl"
        >

            {{-- Close --}}
            <button
                @click="show=false;media='';"
                class="absolute right-4 top-4 z-50 flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-xl text-white hover:bg-red-700"
            >

                ✕

            </button>

            <div class="grid lg:grid-cols-2">

                {{-- Media --}}
                <div class="flex items-center justify-center bg-slate-900">

                    {{-- IMAGE --}}
                    <template x-if="mediaType=='image'">

                        <img
                            :src="media"
                            class="h-[700px] w-full object-contain"
                        >

                    </template>

                    {{-- VIDEO --}}
                    <template x-if="mediaType=='video'">

                        <video
                            x-show="mediaType=='video'"
                            x-bind:key="media"
                            controls
                            autoplay
                            playsinline
                            class="h-[700px] w-full object-contain"
                        >

                            <source
                                :src="media"
                                type="video/mp4"
                            >

                        </video>
                    </template>

                </div>

                {{-- Detail --}}
                <div class="space-y-6 p-8">

                    <div>

                        <h2
                            x-text="title"
                            class="text-3xl font-bold"
                        ></h2>

                        <p
                            x-text="date"
                            class="mt-2 text-slate-500"
                        ></p>

                    </div>

                    <div>

                        <h3
                            class="mb-2 font-bold"
                        >

                            Lokasi

                        </h3>

                        <p
                            x-text="location"
                            class="text-slate-600"
                        ></p>

                    </div>

                    <div>

                        <h3
                            class="mb-2 font-bold"
                        >

                            Deskripsi

                        </h3>

                        <div
                            x-text="description"
                            class="leading-7 text-slate-600"
                        ></div>

                    </div>

                    <div class="flex gap-3">

                        <a
                            :href="media"
                            download
                            class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white hover:bg-green-700"
                        >

                            Download

                        </a>

                        <a
                            :href="media"
                            target="_blank"
                            class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700"
                        >

                            Buka

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

function galleryApp(){

    return{

        show:false,

        media:'',

        mediaType:'image',

        title:'',

        location:'',

        date:'',

        description:'',

        openImage(media,title,location,date,description){

            this.show=true;

            this.mediaType='image';

            this.media=media;

            this.title=title;

            this.location=location;

            this.date=date;

            this.description=description;

        },

        openVideo(media,title,location,date,description){

            this.show=true;

            this.mediaType='video';

            this.media=media;

            this.title=title;

            this.location=location;

            this.date=date;

            this.description=description;

        }

    }

}

</script>

@endpush
