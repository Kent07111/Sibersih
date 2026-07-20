@extends('layouts.admin')

@section('title','Tambah Gallery')

@section('content')

<div class="mx-auto max-w-5xl">

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Tambah Gallery
            </h1>

            <p class="mt-2 text-slate-500">
                Tambahkan dokumentasi foto dan video untuk kegiatan.
            </p>

        </div>

        <a
            href="{{ route('gallery.index') }}"
            class="rounded-xl border border-slate-300 px-5 py-3 font-semibold hover:bg-slate-100"
        >
            ← Kembali
        </a>

    </div>

    <form
        action="{{ route('gallery.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-8 rounded-3xl bg-white p-8 shadow"
    >

        @csrf

        {{-- Activity --}}
        <div>

            <label class="mb-2 block font-semibold">
                Kegiatan
            </label>

            <select
                name="activity_id"
                class="w-full rounded-xl border p-3 @error('activity_id') border-red-500 @enderror"
                required
            >

                <option value="">
                    -- Pilih Kegiatan --
                </option>

                @foreach($activities as $activity)

                    <option
                        value="{{ $activity->id }}"
                        @selected(old('activity_id')==$activity->id)
                    >
                        {{ $activity->judul }}
                        -
                        {{ $activity->tanggal->format('d M Y') }}
                    </option>

                @endforeach

            </select>

            @error('activity_id')
                <p class="mt-2 text-sm text-red-500">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- Images --}}
        <div>

            <label class="mb-2 block font-semibold">
                Upload Foto
            </label>

            <input
                id="images"
                type="file"
                name="images[]"
                accept="image/*"
                multiple
                class="w-full rounded-xl border p-3"
            >

            <p class="mt-2 text-sm text-slate-500">
                Foto akan otomatis dikompres dan diubah menjadi WEBP.
            </p>

            <div
                id="preview-images"
                class="mt-5 grid grid-cols-2 gap-4 md:grid-cols-4"
            ></div>

        </div>

        {{-- Videos --}}
        <div>

            <label class="mb-2 block font-semibold">
                Upload Video
            </label>

            <input
                id="videos"
                type="file"
                name="videos[]"
                accept="video/*"
                multiple
                class="w-full rounded-xl border p-3"
            >

            <p class="mt-2 text-sm text-slate-500">
                Format: MP4, MOV, AVI, WEBM, MKV (maks. 50MB/file).
            </p>

            <div
                id="preview-videos"
                class="mt-5 grid gap-4 md:grid-cols-2"
            ></div>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white hover:bg-green-700"
            >
                💾 Simpan Gallery
            </button>

            <a
                href="{{ route('gallery.index') }}"
                class="rounded-xl bg-slate-200 px-6 py-3 font-semibold hover:bg-slate-300"
            >
                Batal
            </a>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script>

// Preview Gambar
document.getElementById('images').addEventListener('change', function(e){

    const preview = document.getElementById('preview-images');

    preview.innerHTML = '';

    [...e.target.files].forEach(file=>{

        const reader = new FileReader();

        reader.onload = function(event){

            preview.innerHTML += `
                <div class="overflow-hidden rounded-xl border bg-white shadow">
                    <img
                        src="${event.target.result}"
                        class="h-40 w-full object-cover"
                    >
                    <div class="truncate p-2 text-xs">
                        ${file.name}
                    </div>
                </div>
            `;

        }

        reader.readAsDataURL(file);

    });

});


// Preview Video
document.getElementById('videos').addEventListener('change', function(e){

    const preview = document.getElementById('preview-videos');

    preview.innerHTML = '';

    [...e.target.files].forEach(file=>{

        const url = URL.createObjectURL(file);

        preview.innerHTML += `
            <div class="rounded-xl border bg-white p-3 shadow">
                <video
                    controls
                    class="w-full rounded-lg"
                >
                    <source src="${url}">
                </video>

                <div class="mt-2 truncate text-xs">
                    ${file.name}
                </div>
            </div>
        `;

    });

});

</script>

@endpush
