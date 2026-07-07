@extends('layouts.admin')

@section('title','Tambah Edukasi')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <a
            href="{{ route('education.index') }}"
            class="rounded-xl border px-5 py-3 hover:bg-slate-100"
        >
            Kembali
        </a>

    </div>

    <form
        action="{{ route('education.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- ===========================
            LEFT
            =========================== --}}

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
                                id="judul"
                                type="text"
                                name="judul"
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
                                class="w-full rounded-xl border bg-slate-100 p-3"
                                readonly
                            >

                        </div>
                        <div>

                            <label class="mb-2 block font-medium">

                                Ringkasan Artikel

                            </label>

                            <textarea
                                name="excerpt"
                                rows="4"
                                maxlength="250"
                                class="w-full rounded-xl border p-3"
                                placeholder="Tulis ringkasan singkat yang menarik agar pengunjung penasaran..."
                            ></textarea>

                            <p class="mt-1 text-xs text-slate-500">

                                Maksimal 250 karakter. Ringkasan ini akan tampil di halaman masyarakat.

                            </p>

                        </div>
                        <div>

                            <label class="mb-2 block font-medium">

                                Kategori

                            </label>

                            <select
                                name="kategori"
                                class="w-full rounded-xl border p-3"
                            >

                                <option>Organik</option>
                                <option>Anorganik</option>
                                <option>B3</option>
                                <option>Minyak Jelantah</option>
                                <option>Eco Enzyme</option>
                                <option>Kompos</option>
                                <option>Lainnya</option>

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

                                <option value="Draft">

                                    Draft

                                </option>

                                <option value="Publish">

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

                    <input
                        id="thumbnail"
                        type="file"
                        name="thumbnail"
                        accept="image/*"
                        class="w-full rounded-xl border p-3"
                    >

                    <img
                        id="preview"
                        class="mt-5 hidden w-full rounded-xl"
                    >

                </div>

                {{-- PDF --}}

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold">

                        PDF Edukasi

                    </h2>

                    <input
                        type="file"
                        name="pdf"
                        accept=".pdf"
                        class="w-full rounded-xl border p-3"
                    >

                </div>

            </div>

            {{-- ===========================
            RIGHT
            =========================== --}}

            <div class="space-y-6 lg:col-span-2">

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold">

                        Isi Artikel

                    </h2>

                    <textarea
                        id="editor"
                        name="isi"
                    ></textarea>

                </div>

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold">

                        Video Youtube

                    </h2>

                    <input
                        type="url"
                        name="video_url"
                        class="w-full rounded-xl border p-3"
                        placeholder="https://youtube.com/..."
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
                        class="rounded-xl bg-green-600 px-8 py-3 font-semibold text-white hover:bg-green-700"
                    >

                        Simpan

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection


@push('scripts')

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>

ClassicEditor
.create(document.querySelector('#editor'));

document
.getElementById("judul")
.addEventListener("keyup",function(){

    document.getElementById("slug").value =
    this.value
        .toLowerCase()
        .replace(/[^a-z0-9 ]/g,'')
        .replace(/\s+/g,'-');

});

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

</script>

@endpush
