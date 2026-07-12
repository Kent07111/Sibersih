@extends('layouts.admin')

@section('title','Gallery')

@section('content')

<div
    x-data="galleryApp()"
    class="space-y-8"
>

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Gallery

            </h1>

            <p class="mt-2 text-slate-500">

                Dokumentasi seluruh kegiatan SIBERSIH.

            </p>

        </div>

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

        @forelse($images as $image)

            <div
                class="group overflow-hidden rounded-2xl bg-white shadow transition hover:shadow-xl"
            >

                <img
                    src="{{ asset('storage/'.$image->gambar) }}"
                    class="h-64 w-full cursor-pointer object-cover transition duration-300 group-hover:scale-105"
                    @click="open(
                        '{{ asset('storage/'.$image->gambar) }}',
                        @js($image->activity->judul),
                        @js($image->activity->lokasi),
                        @js($image->activity->tanggal->format('d F Y')),
                        @js(strip_tags($image->activity->isi))
                    )"
                >

                <div class="space-y-2 p-4">

                    <h2
                        class="line-clamp-1 text-lg font-bold"
                    >

                        {{ $image->activity->judul }}

                    </h2>

                    <p
                        class="text-sm text-slate-500"
                    >

                        {{ $image->activity->tanggal->format('d F Y') }}

                    </p>

                    <p
                        class="line-clamp-2 text-sm text-slate-600"
                    >

                        {{ Str::limit(strip_tags($image->activity->isi),80) }}

                    </p>

                </div>

            </div>

        @empty

            <div
                class="col-span-full rounded-2xl bg-white p-20 text-center shadow"
            >

                <div class="text-7xl">

                    📷

                </div>

                <h2
                    class="mt-5 text-2xl font-bold"
                >

                    Gallery Kosong

                </h2>

                <p
                    class="mt-2 text-slate-500"
                >

                    Belum ada dokumentasi kegiatan.

                </p>

            </div>

        @endforelse

    </div>

    <div>

        {{ $images->links() }}

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
            class="relative w-full max-w-6xl overflow-hidden rounded-2xl bg-white shadow-2xl"
        >

            {{-- Close --}}
            <button
                @click="show=false"
                class="absolute right-4 top-4 z-50 flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-xl text-white hover:bg-red-700"
            >

                ✕

            </button>

            <div class="grid lg:grid-cols-2">

                {{-- Image --}}
                <div class="bg-slate-900">

                    <img
                        :src="image"
                        class="h-[700px] w-full object-contain"
                    >

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
                            :href="image"
                            download
                            class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white hover:bg-green-700"
                        >

                            Download

                        </a>

                        <a
                            :href="image"
                            target="_blank"
                            class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700"
                        >

                            Full Size

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

        image:'',

        title:'',

        location:'',

        date:'',

        description:'',

        open(image,title,location,date,description){

            this.show=true;

            this.image=image;

            this.title=title;

            this.location=location;

            this.date=date;

            this.description=description;

        }

    }

}

</script>

@endpush
