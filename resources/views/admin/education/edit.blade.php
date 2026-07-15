@extends('layouts.admin')

@section('title','Edit Edukasi')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Edukasi
            </h1>

            <p class="mt-2 text-slate-500">
                Perbarui artikel edukasi.
            </p>

        </div>

        <a
            href="{{ route('education.index') }}"
            class="rounded-xl border px-5 py-3 hover:bg-slate-100"
        >
            Kembali
        </a>

    </div>

    <form
        action="{{ route('education.update',$education) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- LEFT --}}
            <div class="space-y-6">

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold">
                        Informasi Artikel
                    </h2>

                    <div class="space-y-5">

                        <div>

                            <label class="mb-2 block font-medium">
                                Judul
                            </label>

                            <input
                                type="text"
                                name="judul"
                                value="{{ old('judul',$education->judul) }}"
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
                                value="{{ old('slug',$education->slug) }}"
                                class="w-full rounded-xl border p-3"
                                required
                            >

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">
                                Ringkasan Artikel
                            </label>

                            <textarea
                                name="excerpt"
                                rows="4"
                                class="w-full rounded-xl border p-3"
                            >{{ old('excerpt',$education->excerpt) }}</textarea>

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">
                                Kategori
                            </label>

                            <select
                                name="kategori"
                                class="w-full rounded-xl border p-3"
                            >

                                @foreach([
                                    'Organik',
                                    'Anorganik',
                                    'B3',
                                    'Minyak Jelantah',
                                    'Eco Enzyme',
                                    'Kompos',
                                    'Lainnya'
                                ] as $item)

                                    <option
                                        value="{{ $item }}"
                                        @selected($education->kategori==$item)
                                    >
                                        {{ $item }}
                                    </option>

                                @endforeach

                            </select>

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
                                    @selected($education->status=="Draft")
                                >
                                    Draft
                                </option>

                                <option
                                    value="Publish"
                                    @selected($education->status=="Publish")
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

                    @if($education->thumbnail)

                        <img
                            id="preview"
                            src="{{ asset('storage/'.$education->thumbnail) }}"
                            class="mb-5 w-full rounded-xl"
                        >

                    @else

                        <img
                            id="preview"
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

                {{-- PDF --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold">
                        PDF Edukasi
                    </h2>

                    @if($education->pdf)

                        <a
                            href="{{ asset('storage/'.$education->pdf) }}"
                            target="_blank"
                            class="mb-4 inline-block text-blue-600 underline"
                        >
                            📄 Lihat PDF Saat Ini
                        </a>

                    @endif

                    <input
                        type="file"
                        name="pdf"
                        accept=".pdf"
                        class="w-full rounded-xl border p-3"
                    >

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="space-y-6 lg:col-span-2">

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold">
                        Isi Artikel
                    </h2>

                    <textarea
                        id="editor"
                        name="isi"
                    >{{ old('isi',$education->isi) }}</textarea>

                </div>

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold">
                        Video Youtube
                    </h2>

                    <input
                        type="url"
                        name="video_url"
                        value="{{ old('video_url',$education->video_url) }}"
                        class="w-full rounded-xl border p-3"
                    >

                </div>

                <div class="flex justify-end gap-3">

                    <a
                        href="{{ route('education.index') }}"
                        class="rounded-xl border px-6 py-3"
                    >
                        Batal
                    </a>

                    <button
                        class="rounded-xl bg-blue-600 px-8 py-3 font-semibold text-white hover:bg-blue-700"
                    >
                        Update
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')


<script>

ClassicEditor
.create(document.querySelector('#editor'));

document
.getElementById("thumbnail")
.addEventListener("change",function(e){

    const file=e.target.files[0];

    if(!file) return;

    const reader=new FileReader();

    reader.onload=function(ev){

        const img=document.getElementById("preview");

        img.src=ev.target.result;

        img.classList.remove("hidden");

    }

    reader.readAsDataURL(file);

});

document.getElementById("slug").addEventListener("input", function () {

    this.value = this.value
        .toLowerCase()
        .replace(/[^a-z0-9-]/g, "")
        .replace(/\s+/g, "-")
        .replace(/-+/g, "-");

});

</script>

@endpush
