@extends('layouts.admin')

@section('title','Tambah Kegiatan')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Tambah Kegiatan

            </h1>

            <p class="mt-2 text-slate-500">

                Tambahkan kegiatan baru beserta dokumentasinya.

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
        action="{{ route('activity.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

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

                    <h2 class="mb-4 font-bold">

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
                        id="previewThumbnail"
                        class="mt-4 hidden w-full rounded-xl"
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
                    ></textarea>

                </div>

                {{-- Multiple Upload --}}
{{-- Dokumentasi --}}
<div class="rounded-2xl bg-white p-6 shadow">

    <h2 class="mb-5 text-lg font-bold">

        Dokumentasi Foto

    </h2>

    <label
        for="gallery"
        class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 p-8 transition hover:border-green-500 hover:bg-green-50"
    >

        <svg xmlns="http://www.w3.org/2000/svg"
            class="mb-3 h-12 w-12 text-slate-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">

            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="M3 16l5-5a2 2 0 012.828 0L16 16m-2-2l1-1a2 2 0 012.828 0L21 16m-9-9h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />

        </svg>

        <span class="font-semibold">

            Klik untuk memilih dokumentasi

        </span>

        <span class="mt-2 text-sm text-slate-500">

            Bisa memilih banyak foto sekaligus

        </span>

        <input
            id="gallery"
            type="file"
            name="gallery[]"
            accept="image/*"
            multiple
            class="hidden"
        >

    </label>

    <div
        id="galleryPreview"
        class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-4"
    >

    </div>

</div>

                <div class="flex justify-end gap-3">

                    <a
                        href="{{ route('activity.index') }}"
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
<script src="https://cdn.tiny.cloud/1/4jrzzsgk6khdvn5i43u7wbrxotg20bhraoc2697y5s60qcr9/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script>
const thumbnailInput = document.getElementById("thumbnail");
const thumbnailPreview = document.getElementById("previewThumbnail");

thumbnailInput.addEventListener("change", async function () {

    const originalFile = this.files[0];

    if (!originalFile) {
        return;
    }

    try {

        const newFile = await ImageUploader.process(originalFile);

        const dataTransfer = new DataTransfer();

        dataTransfer.items.add(newFile);

        // File asli diganti dengan hasil WebP
        this.files = dataTransfer.files;

        const imageUrl = URL.createObjectURL(newFile);

        thumbnailPreview.src = imageUrl;
        thumbnailPreview.classList.remove("hidden");

        thumbnailPreview.onload = function () {
            URL.revokeObjectURL(imageUrl);
        };

        console.log("Thumbnail berhasil diproses:", {
            nama: newFile.name,
            tipe: newFile.type,
            ukuran: newFile.size
        });

    } catch (error) {

        console.error("Thumbnail gagal diproses:", error);

        alert(
            "Thumbnail gagal diproses: " + error.message
        );

        this.value = "";
        thumbnailPreview.src = "";
        thumbnailPreview.classList.add("hidden");
    }

});
</script>
<script>

tinymce.init({
    selector: '#editor',
    height: 500,
    menubar: false,

    plugins: [
        'advlist',
        'autolink',
        'lists',
        'link',
        'image',
        'charmap',
        'preview',
        'anchor',
        'searchreplace',
        'visualblocks',
        'code',
        'fullscreen',
        'insertdatetime',
        'media',
        'table',
        'wordcount'
    ],

    toolbar:
        'undo redo | blocks | ' +
        'bold italic underline | forecolor backcolor | ' +
        'alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | ' +
        'link image media table | ' +
        'preview code fullscreen',

    branding: false,
    promotion: false
});

document.querySelector("form").addEventListener("submit", function () {
    tinymce.triggerSave();
});
// =======================================
// Preview Multiple Gallery
// =======================================

const galleryInput = document.getElementById("gallery");

const galleryPreview = document.getElementById("galleryPreview");

galleryInput.addEventListener("change", async function(){

    galleryPreview.innerHTML="";

    const dt = new DataTransfer();

    for(const file of this.files){

        const newFile = await ImageUploader.process(file);

        dt.items.add(newFile);

        const reader = new FileReader();

        reader.onload=function(e){

            const card=document.createElement("div");

            card.className="relative overflow-hidden rounded-xl border bg-white shadow";

            card.innerHTML=`
                <img
                    src="${e.target.result}"
                    class="h-40 w-full object-cover"
                >
                <div
                    class="truncate border-t bg-white p-2 text-xs text-center"
                >
                    ${newFile.name}
                </div>
            `;

            galleryPreview.appendChild(card);

        };

        reader.readAsDataURL(newFile);

    }

    this.files=dt.files;

});
// =======================================
// Auto Generate Slug
// =======================================

const judulInput = document.getElementById("judul");
const slugInput = document.getElementById("slug");

judulInput.addEventListener("input", function () {

    slugInput.value = this.value
        .toLowerCase()
        .trim()
        .replace(/\s+/g, "-")          // spasi -> -
        .replace(/[^\w\-]+/g, "")      // hapus karakter selain huruf, angka, -
        .replace(/\-\-+/g, "-")        // -- menjadi -
        .replace(/^-+/, "")            // hapus - di awal
        .replace(/-+$/, "");           // hapus - di akhir

});
</script>

@endpush
