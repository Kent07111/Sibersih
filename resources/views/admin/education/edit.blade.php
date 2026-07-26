@extends('layouts.admin')

@section('title', 'Edit Edukasi')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Edukasi
            </h1>

            <p class="mt-2 text-slate-500">
                Perbarui artikel edukasi beserta media pendukungnya.
            </p>

        </div>

        <a
            href="{{ route('education.index') }}"
            class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 font-semibold text-slate-700 transition hover:bg-slate-100"
        >
            Kembali
        </a>

    </div>

    {{-- Pesan berhasil --}}
    @if(session('success'))

        <div class="rounded-xl border border-green-300 bg-green-100 p-4 text-green-700">

            {{ session('success') }}

        </div>

    @endif

    {{-- Pesan gagal --}}
    @if(session('error'))

        <div class="rounded-xl border border-red-300 bg-red-100 p-4 text-red-700">

            {{ session('error') }}

        </div>

    @endif

    {{-- Daftar error validasi --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-300 bg-red-100 p-4 text-red-700">

            <p class="mb-2 font-semibold">
                Data belum dapat disimpan:
            </p>

            <ul class="ml-5 list-disc space-y-1">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- ================= FORM EDIT UTAMA ================= --}}
    <form
        id="educationEditForm"
        action="{{ route('education.update', $education) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- ================= LEFT ================= --}}
            <div class="space-y-6">

                {{-- Informasi Artikel --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold text-slate-800">
                        Informasi Artikel
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
                                value="{{ old('judul', $education->judul) }}"
                                class="w-full rounded-xl border border-slate-300 p-3 focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-100"
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
                                value="{{ old('slug', $education->slug) }}"
                                class="w-full rounded-xl border border-slate-300 bg-slate-50 p-3 focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-100"
                                required
                            >

                            @error('slug')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        {{-- Ringkasan --}}
                        <div>

                            <label
                                for="excerpt"
                                class="mb-2 block font-medium text-slate-700"
                            >
                                Ringkasan Artikel
                            </label>

                            <textarea
                                id="excerpt"
                                name="excerpt"
                                rows="4"
                                maxlength="250"
                                class="w-full rounded-xl border border-slate-300 p-3 focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-100"
                                required
                            >{{ old('excerpt', $education->excerpt) }}</textarea>

                            <p class="mt-1 text-xs text-slate-500">
                                Maksimal 250 karakter.
                            </p>

                            @error('excerpt')

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

                            <select
                                id="kategori"
                                name="kategori"
                                class="w-full rounded-xl border border-slate-300 p-3 focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-100"
                                required
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
                                        @selected(
                                            old(
                                                'kategori',
                                                $education->kategori
                                            ) === $item
                                        )
                                    >
                                        {{ $item }}
                                    </option>

                                @endforeach

                            </select>

                            @error('kategori')

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
                                class="w-full rounded-xl border border-slate-300 p-3 focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-100"
                                required
                            >

                                <option
                                    value="Draft"
                                    @selected(
                                        old(
                                            'status',
                                            $education->status
                                        ) === 'Draft'
                                    )
                                >
                                    Draft
                                </option>

                                <option
                                    value="Publish"
                                    @selected(
                                        old(
                                            'status',
                                            $education->status
                                        ) === 'Publish'
                                    )
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

                    @if($education->thumbnail)

                        <img
                            id="preview"
                            src="{{ asset('storage/' . $education->thumbnail) }}"
                            alt="{{ $education->judul }}"
                            class="mb-5 max-h-72 w-full rounded-xl object-cover"
                        >

                    @else

                        <img
                            id="preview"
                            alt="Preview thumbnail"
                            class="mb-5 hidden max-h-72 w-full rounded-xl object-cover"
                        >

                    @endif

                    <input
                        id="thumbnail"
                        type="file"
                        name="thumbnail"
                        accept=".jpg,.jpeg,.png,.webp,image/*"
                        class="w-full rounded-xl border border-slate-300 p-3"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Kosongkan jika tidak ingin mengganti thumbnail.
                    </p>

                    @error('thumbnail')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                {{-- PDF --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold text-slate-800">
                        PDF Edukasi
                    </h2>

                    @if($education->pdf)

                        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4">

                            <p class="mb-3 text-sm font-semibold text-slate-700">
                                File PDF saat ini
                            </p>

                            <div class="flex flex-wrap gap-3">

                                <a
                                    href="{{ asset('storage/' . $education->pdf) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700"
                                >
                                    📄 Lihat PDF
                                </a>

                                <button
                                    type="button"
                                    onclick="deletePdf()"
                                    class="inline-flex items-center rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700"
                                >
                                    🗑️ Hapus PDF
                                </button>

                            </div>

                        </div>

                    @else

                        <div class="mb-5 rounded-xl border border-slate-200 bg-slate-50 p-4">

                            <p class="text-sm text-slate-500">
                                Belum ada file PDF.
                            </p>

                        </div>

                    @endif

                    <input
                        type="file"
                        name="pdf"
                        accept=".pdf,application/pdf"
                        class="w-full rounded-xl border border-slate-300 p-3"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Upload file baru untuk mengganti atau menambahkan PDF.
                    </p>

                    @error('pdf')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                {{-- PowerPoint --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold text-slate-800">
                        PowerPoint Edukasi
                    </h2>

                    @if($education->ppt)

                        <div class="mb-5 rounded-xl border border-orange-200 bg-orange-50 p-4">

                            <p class="mb-3 text-sm font-semibold text-slate-700">
                                File PowerPoint saat ini
                            </p>

                            <div class="flex flex-wrap gap-3">

                                <a
                                    href="{{ asset('storage/' . $education->ppt) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center rounded-xl bg-orange-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-orange-700"
                                >
                                    📊 Download PPT
                                </a>

                                <button
                                    type="button"
                                    onclick="deletePpt()"
                                    class="inline-flex items-center rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700"
                                >
                                    🗑️ Hapus PPT
                                </button>

                            </div>

                        </div>

                    @else

                        <div class="mb-5 rounded-xl border border-slate-200 bg-slate-50 p-4">

                            <p class="text-sm text-slate-500">
                                Belum ada file PowerPoint.
                            </p>

                        </div>

                    @endif

                    <input
                        type="file"
                        name="ppt"
                        accept=".ppt,.pptx,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation"
                        class="w-full rounded-xl border border-slate-300 p-3"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Upload file PPT atau PPTX baru. Maksimal 20 MB.
                    </p>

                    @error('ppt')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

            {{-- ================= RIGHT ================= --}}
            <div class="space-y-6 lg:col-span-2">

                {{-- Isi Artikel --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold text-slate-800">
                        Isi Artikel
                    </h2>

                    <textarea
                        id="editor"
                        name="isi"
                    >{{ old('isi', $education->isi) }}</textarea>

                    @error('isi')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                {{-- Video YouTube --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 font-bold text-slate-800">
                        Video YouTube
                    </h2>

                    <textarea
                        name="video_url"
                        rows="8"
                        class="w-full rounded-xl border border-slate-300 p-3 font-mono text-sm focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-100"
                        placeholder='<iframe width="560" height="315" src="https://www.youtube.com/embed/VIDEO_ID" title="YouTube video player" frameborder="0" allowfullscreen></iframe>'
                    >{{ old('video_url', $education->video_url) }}</textarea>

                    <p class="mt-2 text-xs text-slate-500">
                        Tempel kode iframe dari YouTube melalui menu Bagikan → Sematkan.
                    </p>

                    @error('video_url')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                {{-- Tombol Aksi --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('education.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-6 py-3 font-semibold text-slate-700 transition hover:bg-slate-100"
                    >
                        Batal
                    </a>

                    <button
                        id="updateButton"
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-8 py-3 font-semibold text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60"
                    >
                        Update
                    </button>

                </div>

            </div>

        </div>

    </form>
    {{-- ================= END FORM EDIT ================= --}}

    {{-- Form hapus PDF harus di luar form edit --}}
    <form
        id="deletePdfForm"
        action="{{ route('education.delete-pdf', $education) }}"
        method="POST"
        class="hidden"
    >
        @csrf
        @method('DELETE')
    </form>

    {{-- Form hapus PPT harus di luar form edit --}}
    <form
        id="deletePptForm"
        action="{{ route('education.delete-ppt', $education) }}"
        method="POST"
        class="hidden"
    >
        @csrf
        @method('DELETE')
    </form>

</div>

@endsection

@push('scripts')

<script
    src="https://cdn.tiny.cloud/1/4jrzzsgk6khdvn5i43u7wbrxotg20bhraoc2697y5s60qcr9/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"
></script>

<script>

    tinymce.init({

        selector: '#editor',

        height: 600,

        menubar: true,

        plugins: 'image link table lists media code fullscreen preview wordcount',

        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | image media link table | code fullscreen preview',

        automatic_uploads: true,

        document_base_url: "{{ url('/') }}/",

        relative_urls: false,

        remove_script_host: false,

        convert_urls: false,

        file_picker_types: 'image',

        file_picker_callback: function (callback) {

            const input = document.createElement('input');

            input.type = 'file';

            input.accept = 'image/*';

            input.onchange = function () {

                const file = this.files[0];

                if (!file) {
                    return;
                }

                const formData = new FormData();

                formData.append('file', file);

                fetch("{{ route('education.upload-image') }}", {

                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },

                    body: formData

                })
                .then(async response => {

                    const data = await response.json();

                    if (!response.ok) {

                        throw new Error(
                            data.message || 'Upload gambar gagal.'
                        );

                    }

                    return data;

                })
                .then(data => {

                    callback(data.location);

                })
                .catch(error => {

                    console.error(error);

                    alert(
                        error.message || 'Upload gambar gagal.'
                    );

                });

            };

            input.click();

        }

    });

    /*
    |--------------------------------------------------------------------------
    | Preview Thumbnail
    |--------------------------------------------------------------------------
    */

    const thumbnailInput = document.getElementById('thumbnail');

    if (thumbnailInput) {

        thumbnailInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (result) {

                const preview = document.getElementById('preview');

                preview.src = result.target.result;

                preview.classList.remove('hidden');

            };

            reader.readAsDataURL(file);

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Simpan isi TinyMCE sebelum update
    |--------------------------------------------------------------------------
    */

    const educationEditForm =
        document.getElementById('educationEditForm');

    if (educationEditForm) {

        educationEditForm.addEventListener('submit', function () {

            tinymce.triggerSave();

            const updateButton =
                document.getElementById('updateButton');

            if (updateButton) {

                updateButton.disabled = true;

                updateButton.textContent = 'Menyimpan...';

            }

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Format Slug
    |--------------------------------------------------------------------------
    */

    const slugInput = document.getElementById('slug');

    if (slugInput) {

        slugInput.addEventListener('input', function () {

            this.value = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Hapus PDF
    |--------------------------------------------------------------------------
    */

    function deletePdf() {

        const confirmed = confirm(
            'Yakin ingin menghapus file PDF ini?\n\nArtikel edukasi tidak akan dihapus.'
        );

        if (!confirmed) {
            return;
        }

        const form = document.getElementById('deletePdfForm');

        if (form) {
            form.submit();
        }

    }

    /*
    |--------------------------------------------------------------------------
    | Hapus PowerPoint
    |--------------------------------------------------------------------------
    */

    function deletePpt() {

        const confirmed = confirm(
            'Yakin ingin menghapus file PowerPoint ini?\n\nArtikel edukasi tidak akan dihapus.'
        );

        if (!confirmed) {
            return;
        }

        const form = document.getElementById('deletePptForm');

        if (form) {
            form.submit();
        }

    }

</script>

@endpush
