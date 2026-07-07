@extends('layouts.admin')

@section('title','Edit Kegiatan')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Kegiatan
            </h1>

            <p class="mt-2 text-slate-500">
                Perbarui data kegiatan beserta dokumentasinya.
            </p>

        </div>

        <a
            href="{{ route('activity.index') }}"
            class="rounded-xl border px-5 py-3 hover:bg-slate-100"
        >
            Kembali
        </a>

    </div>

    <form
        action="{{ route('activity.update',$activity) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Sidebar --}}
            <div class="space-y-6">

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold">
                        Informasi Kegiatan
                    </h2>

                    <div class="space-y-5">

                        <div>

                            <label class="mb-2 block font-medium">
                                Judul
                            </label>

                            <input
                                type="text"
                                name="judul"
                                value="{{ old('judul',$activity->judul) }}"
                                class="w-full rounded-xl border p-3"
                                required
                            >

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">
                                Slug
                            </label>

                            <input
                                id="slug"
                                type="text"
                                name="slug"
                                value="{{ old('slug',$activity->slug) }}"
                                class="w-full rounded-xl border p-3"
                                required
                            >

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">
                                Kategori
                            </label>

                            <input
                                type="text"
                                name="kategori"
                                value="{{ old('kategori',$activity->kategori) }}"
                                class="w-full rounded-xl border p-3"
                                required
                            >

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">
                                Tanggal
                            </label>

                            <input
                                type="date"
                                name="tanggal"
                                value="{{ old('tanggal',$activity->tanggal->format('Y-m-d')) }}"
                                class="w-full rounded-xl border p-3"
                                required
                            >

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">
                                Lokasi
                            </label>

                            <input
                                type="text"
                                name="lokasi"
                                value="{{ old('lokasi',$activity->lokasi) }}"
                                class="w-full rounded-xl border p-3"
                                required
                            >

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">
                                Status
                            </label>

                            <select
                                name="status"
                                class="w-full rounded-xl border p-3"
                            >

                                <option
                                    value="Draft"
                                    @selected($activity->status=="Draft")
                                >
                                    Draft
                                </option>

                                <option
                                    value="Publish"
                                    @selected($activity->status=="Publish")
                                >
                                    Publish
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                {{-- Thumbnail --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold">
                        Thumbnail
                    </h2>

                    @if($activity->thumbnail)

                        <img
                            id="previewThumbnail"
                            src="{{ asset('storage/'.$activity->thumbnail) }}"
                            class="mb-5 w-full rounded-xl"
                        >

                    @else

                        <img
                            id="previewThumbnail"
                            class="mb-5 hidden w-full rounded-xl"
                        >

                    @endif

                    <input
                        id="thumbnail"
                        type="file"
                        name="thumbnail"
                        accept="image/*"
                        class="w-full rounded-xl border p-3"
                    >

                </div>

            </div>

            {{-- Content --}}
            <div class="space-y-6 lg:col-span-2">

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-4 text-lg font-bold">
                        Isi Kegiatan
                    </h2>

                    <textarea
                        id="editor"
                        name="isi"
                    >{{ old('isi',$activity->isi) }}</textarea>

                </div>

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold">

                        Tambah Dokumentasi Baru

                    </h2>

                    <label
                        for="gallery"
                        class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 p-8 transition hover:border-green-500 hover:bg-green-50"
                    >

                        <span class="text-5xl">

                            📷

                        </span>

                        <span class="mt-3 font-semibold">

                            Klik untuk memilih foto

                        </span>

                        <span class="mt-2 text-sm text-slate-500">

                            Bisa memilih banyak foto sekaligus

                        </span>

                        <input
                            id="gallery"
                            type="file"
                            name="gallery[]"
                            multiple
                            accept="image/*"
                            class="hidden"
                        >

                    </label>

                    <div
                        id="galleryPreview"
                        class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-4"
                    >

                    </div>

                </div>
                {{-- Dokumentasi Lama --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <div class="mb-5 flex items-center justify-between">

                        <h2 class="text-lg font-bold">

                            Dokumentasi Saat Ini

                        </h2>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm">

                            {{ $activity->images->count() }} Foto

                        </span>

                    </div>

                    @if($activity->images->count())

                        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-4">

                            @foreach($activity->images as $image)

                                <div class="group relative overflow-hidden rounded-xl border bg-white">

                                    <img
                                        src="{{ asset('storage/'.$image->gambar) }}"
                                        class="h-40 w-full object-cover transition duration-300 group-hover:scale-105"
                                    >

                                    <form
                                        action="{{ route('activity-image.destroy',$image) }}"
                                        method="POST"
                                        class="absolute right-2 top-2"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Hapus dokumentasi ini?')"
                                            class="rounded-full bg-red-600 px-3 py-2 text-white shadow hover:bg-red-700"
                                        >

                                            ✕

                                        </button>

                                    </form>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="rounded-xl border border-dashed p-10 text-center text-slate-500">

                            Belum ada dokumentasi.

                        </div>

                    @endif

                </div>

                {{-- Footer --}}
                <div class="flex justify-end gap-3">

                    <a
                        href="{{ route('activity.index') }}"
                        class="rounded-xl border px-6 py-3 hover:bg-slate-100"
                    >

                        Batal

                    </a>

                    <button
                        class="rounded-xl bg-blue-600 px-8 py-3 font-semibold text-white hover:bg-blue-700"
                    >

                        Update Kegiatan

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection


@push('scripts')

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>

ClassicEditor
.create(document.querySelector('#editor'));


// ===========================================
// Thumbnail Preview
// ===========================================

document
.getElementById("thumbnail")
.addEventListener("change",function(e){

    const file=e.target.files[0];

    if(!file) return;

    const reader=new FileReader();

    reader.onload=function(ev){

        const img=document.getElementById("previewThumbnail");

        img.src=ev.target.result;

        img.classList.remove("hidden");

    }

    reader.readAsDataURL(file);

});


// ===========================================
// Preview Gallery
// ===========================================

const galleryInput=document.getElementById("gallery");

const galleryPreview=document.getElementById("galleryPreview");

galleryInput.addEventListener("change",function(){

    galleryPreview.innerHTML='';

    Array.from(this.files).forEach(file=>{

        if(!file.type.startsWith("image/")) return;

        const reader=new FileReader();

        reader.onload=function(e){

            const card=document.createElement("div");

            card.className="overflow-hidden rounded-xl border shadow";

            card.innerHTML=`

                <img
                    src="${e.target.result}"
                    class="h-40 w-full object-cover"
                >

                <div
                    class="truncate border-t p-2 text-center text-xs"
                >

                    ${file.name}

                </div>

            `;

            galleryPreview.appendChild(card);

        }

        reader.readAsDataURL(file);

    });

});


// ===========================================
// Slug
// ===========================================

document
.getElementById("slug")
.addEventListener("input",function(){

    this.value=this.value
        .toLowerCase()
        .replace(/[^a-z0-9-]/g,'')
        .replace(/\s+/g,'-')
        .replace(/-+/g,'-');

});

</script>

@endpush
