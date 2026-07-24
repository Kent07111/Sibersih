@extends('layouts.admin')

@section('title', 'Edit Kegiatan')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

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
            class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-5 py-3 transition hover:bg-slate-100"
        >
            Kembali
        </a>

    </div>

    {{-- Pesan error validasi --}}
    @if ($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-5 text-red-700">

            <h3 class="font-bold">
                Data gagal disimpan.
            </h3>

            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- Form utama update --}}
    <form
        id="activityUpdateForm"
        action="{{ route('activity.update', $activity) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Sidebar --}}
            <div class="space-y-6">

                {{-- Informasi Kegiatan --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold text-slate-800">
                        Informasi Kegiatan
                    </h2>

                    <div class="space-y-5">

                        {{-- Judul --}}
                        <div>

                            <label
                                for="judul"
                                class="mb-2 block font-medium text-slate-700"
                            >
                                Judul
                            </label>

                            <input
                                id="judul"
                                type="text"
                                name="judul"
                                value="{{ old('judul', $activity->judul) }}"
                                class="w-full rounded-xl border border-slate-300 p-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                required
                            >

                            @error('judul')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Slug --}}
                        <div>

                            <label
                                for="slug"
                                class="mb-2 block font-medium text-slate-700"
                            >
                                Slug
                            </label>

                            <input
                                id="slug"
                                type="text"
                                name="slug"
                                value="{{ old('slug', $activity->slug) }}"
                                class="w-full rounded-xl border border-slate-300 p-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                required
                            >

                            @error('slug')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Kategori --}}
                        <div>

                            <label
                                for="kategori"
                                class="mb-2 block font-medium text-slate-700"
                            >
                                Kategori
                            </label>

                            <input
                                id="kategori"
                                type="text"
                                name="kategori"
                                value="{{ old('kategori', $activity->kategori) }}"
                                class="w-full rounded-xl border border-slate-300 p-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                required
                            >

                            @error('kategori')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Tanggal --}}
                        <div>

                            <label
                                for="tanggal"
                                class="mb-2 block font-medium text-slate-700"
                            >
                                Tanggal
                            </label>

                            <input
                                id="tanggal"
                                type="date"
                                name="tanggal"
                                value="{{ old('tanggal', optional($activity->tanggal)->format('Y-m-d')) }}"
                                class="w-full rounded-xl border border-slate-300 p-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                required
                            >

                            @error('tanggal')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Lokasi --}}
                        <div>

                            <label
                                for="lokasi"
                                class="mb-2 block font-medium text-slate-700"
                            >
                                Lokasi
                            </label>

                            <input
                                id="lokasi"
                                type="text"
                                name="lokasi"
                                value="{{ old('lokasi', $activity->lokasi) }}"
                                class="w-full rounded-xl border border-slate-300 p-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                required
                            >

                            @error('lokasi')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Status --}}
                        <div>

                            <label
                                for="status"
                                class="mb-2 block font-medium text-slate-700"
                            >
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="w-full rounded-xl border border-slate-300 p-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                required
                            >

                                <option
                                    value="Draft"
                                    @selected(old('status', $activity->status) === 'Draft')
                                >
                                    Draft
                                </option>

                                <option
                                    value="Publish"
                                    @selected(old('status', $activity->status) === 'Publish')
                                >
                                    Publish
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

                {{-- Thumbnail --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold text-slate-800">
                        Thumbnail
                    </h2>

                    @if ($activity->thumbnail)

                        <img
                            id="previewThumbnail"
                            src="{{ asset('storage/' . $activity->thumbnail) }}"
                            alt="Thumbnail kegiatan"
                            class="mb-5 h-52 w-full rounded-xl object-cover"
                        >

                    @else

                        <img
                            id="previewThumbnail"
                            alt="Preview thumbnail"
                            class="mb-5 hidden h-52 w-full rounded-xl object-cover"
                        >

                    @endif

                    <input
                        id="thumbnail"
                        type="file"
                        name="thumbnail"
                        accept="image/jpeg,image/png,image/webp,image/heic,image/heif,.heic,.heif"
                        class="w-full rounded-xl border border-slate-300 p-3"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Kosongkan jika thumbnail tidak ingin diganti.
                    </p>

                    @error('thumbnail')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            {{-- Content --}}
            <div class="space-y-6 lg:col-span-2">

                {{-- Isi kegiatan --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-4 text-lg font-bold text-slate-800">
                        Isi Kegiatan
                    </h2>

                    <textarea
                        id="editor"
                        name="isi"
                    >{{ old('isi', $activity->isi) }}</textarea>

                    @error('isi')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Tambah dokumentasi --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold text-slate-800">
                        Tambah Dokumentasi Baru
                    </h2>

                    <label
                        for="gallery"
                        class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 p-8 transition hover:border-blue-500 hover:bg-blue-50"
                    >

                        <span class="text-5xl">
                            📷
                        </span>

                        <span class="mt-3 font-semibold text-slate-700">
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
                            accept="image/jpeg,image/png,image/webp,image/heic,image/heif,.heic,.heif"
                            class="hidden"
                        >

                    </label>

                    @error('gallery')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    @error('gallery.*')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    <div
                        id="galleryPreview"
                        class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-4"
                    ></div>

                </div>

                {{-- Dokumentasi lama --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <div class="mb-5 flex items-center justify-between">

                        <h2 class="text-lg font-bold text-slate-800">
                            Dokumentasi Saat Ini
                        </h2>

                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm text-slate-600">
                            {{ $activity->images->count() }} Foto
                        </span>

                    </div>

                    @if ($activity->images->count() > 0)

                        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-4">

                            @foreach ($activity->images as $image)

                                <div class="group relative overflow-hidden rounded-xl border bg-white">

                                    <img
                                        src="{{ asset('storage/' . $image->gambar) }}"
                                        alt="Dokumentasi kegiatan"
                                        class="h-40 w-full object-cover transition duration-300 group-hover:scale-105"
                                    >

                                    <button
                                        type="submit"
                                        form="delete-image-{{ $image->id }}"
                                        onclick="return confirm('Hapus dokumentasi ini?')"
                                        class="absolute right-2 top-2 rounded-full bg-red-600 px-3 py-2 text-white shadow transition hover:bg-red-700"
                                    >
                                        ✕
                                    </button>

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
                        class="rounded-xl border border-slate-300 px-6 py-3 transition hover:bg-slate-100"
                    >
                        Batal
                    </a>

                    <button
                        id="submitButton"
                        type="submit"
                        class="rounded-xl bg-blue-600 px-8 py-3 font-semibold text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60"
                    >
                        Update Kegiatan
                    </button>

                </div>

            </div>

        </div>

    </form>

    {{-- Form hapus dokumentasi harus di luar form update --}}
    @foreach ($activity->images as $image)

        <form
            id="delete-image-{{ $image->id }}"
            action="{{ route('activity-image.destroy', $image) }}"
            method="POST"
            class="hidden"
        >
            @csrf
            @method('DELETE')
        </form>

    @endforeach

</div>

@endsection

@push('scripts')

<script
    src="https://cdn.tiny.cloud/1/4jrzzsgk6khdvn5i43u7wbrxotg20bhraoc2697y5s60qcr9/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"
></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ===========================================
    // TinyMCE
    // ===========================================

    tinymce.init({

        selector: "#editor",

        height: 500,

        menubar: false,

        plugins: [
            "advlist",
            "autolink",
            "lists",
            "link",
            "image",
            "charmap",
            "preview",
            "anchor",
            "searchreplace",
            "visualblocks",
            "code",
            "fullscreen",
            "insertdatetime",
            "media",
            "table",
            "wordcount"
        ],

        toolbar:
            "undo redo | blocks | " +
            "bold italic underline | forecolor backcolor | " +
            "alignleft aligncenter alignright alignjustify | " +
            "bullist numlist outdent indent | " +
            "link image media table | " +
            "preview code fullscreen",

        branding: false,

        promotion: false

    });

    // ===========================================
    // Form update
    // ===========================================

    const updateForm = document.getElementById("activityUpdateForm");

    const submitButton = document.getElementById("submitButton");

    updateForm.addEventListener("submit", function () {

        tinymce.triggerSave();

        submitButton.disabled = true;

        submitButton.textContent = "Menyimpan...";

    });

    // ===========================================
    // Thumbnail menjadi WebP
    // ===========================================

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

            this.files = dataTransfer.files;

            const imageUrl = URL.createObjectURL(newFile);

            thumbnailPreview.src = imageUrl;

            thumbnailPreview.classList.remove("hidden");

            thumbnailPreview.onload = function () {
                URL.revokeObjectURL(imageUrl);
            };

        } catch (error) {

            console.error("Thumbnail gagal diproses:", error);

            alert(
                "Thumbnail gagal diproses: " + error.message
            );

            this.value = "";

        }

    });

    // ===========================================
    // Gallery menjadi WebP
    // ===========================================

    const galleryInput = document.getElementById("gallery");

    const galleryPreview = document.getElementById("galleryPreview");

    galleryInput.addEventListener("change", async function () {

        galleryPreview.innerHTML = "";

        const selectedFiles = Array.from(this.files);

        const dataTransfer = new DataTransfer();

        for (const originalFile of selectedFiles) {

            try {

                const newFile = await ImageUploader.process(originalFile);

                dataTransfer.items.add(newFile);

                const imageUrl = URL.createObjectURL(newFile);

                const card = document.createElement("div");

                card.className =
                    "relative overflow-hidden rounded-xl border bg-white shadow";

                card.innerHTML = `
                    <img
                        src="${imageUrl}"
                        class="h-40 w-full object-cover"
                        alt="Preview dokumentasi"
                    >

                    <div class="border-t bg-white p-2 text-center">

                        <div class="truncate text-xs font-medium">
                            ${escapeHtml(newFile.name)}
                        </div>

                        <div class="mt-1 text-xs text-slate-500">
                            ${formatFileSize(newFile.size)}
                        </div>

                    </div>
                `;

                galleryPreview.appendChild(card);

                const previewImage = card.querySelector("img");

                previewImage.addEventListener("load", function () {
                    URL.revokeObjectURL(imageUrl);
                });

            } catch (error) {

                console.error(
                    "Gagal memproses " + originalFile.name,
                    error
                );

                alert(
                    originalFile.name +
                    " gagal diproses: " +
                    error.message
                );

            }

        }

        this.files = dataTransfer.files;

    });

    // ===========================================
    // Format ukuran file
    // ===========================================

    function formatFileSize(bytes) {

        if (bytes < 1024) {
            return bytes + " Bytes";
        }

        if (bytes < 1024 * 1024) {
            return (bytes / 1024).toFixed(2) + " KB";
        }

        return (bytes / 1024 / 1024).toFixed(2) + " MB";

    }

    // ===========================================
    // Escape nama file
    // ===========================================

    function escapeHtml(value) {

        const div = document.createElement("div");

        div.textContent = value;

        return div.innerHTML;

    }

    // ===========================================
    // Format slug
    // ===========================================

    const slugInput = document.getElementById("slug");

    slugInput.addEventListener("input", function () {

        this.value = this.value
            .toLowerCase()
            .trim()
            .replace(/\s+/g, "-")
            .replace(/[^a-z0-9-]/g, "")
            .replace(/-+/g, "-")
            .replace(/^-+/, "")
            .replace(/-+$/, "");

    });

});
</script>

@endpush
