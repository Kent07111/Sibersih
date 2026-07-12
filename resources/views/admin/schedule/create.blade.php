@extends('layouts.admin')

@section('title','Tambah Jadwal')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Tambah Jadwal

            </h1>

            <p class="mt-2 text-slate-500">

                Tambahkan agenda kegiatan SIBERSIH.

            </p>

        </div>

        <a
            href="{{ route('schedule.index') }}"
            class="rounded-xl border px-5 py-3 hover:bg-slate-100"
        >

            Kembali

        </a>

    </div>

    <form
        action="{{ route('schedule.store') }}"
        method="POST"
    >

        @csrf

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- LEFT --}}
            <div class="space-y-6">

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold">

                        Informasi Jadwal

                    </h2>

                    <div class="space-y-5">

                        <div>

                            <label class="mb-2 block font-medium">

                                Judul Kegiatan

                            </label>

                            <input
                                type="text"
                                name="judul"
                                value="{{ old('judul') }}"
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
                                value="{{ old('tanggal') }}"
                                class="w-full rounded-xl border p-3"
                                required
                            >

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">

                                Jam

                            </label>

                            <input
                                type="time"
                                name="jam"
                                value="{{ old('jam') }}"
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
                                value="{{ old('lokasi') }}"
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

                                <option value="Aktif">

                                    Aktif

                                </option>

                                <option value="Selesai">

                                    Selesai

                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="lg:col-span-2">

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold">

                        Keterangan

                    </h2>

                    <textarea
                        name="keterangan"
                        id="editor"
                        rows="12"
                    >{{ old('keterangan') }}</textarea>

                </div>

                <div class="mt-6 flex justify-end gap-3">

                    <a
                        href="{{ route('schedule.index') }}"
                        class="rounded-xl border px-6 py-3 hover:bg-slate-100"
                    >

                        Batal

                    </a>

                    <button
                        class="rounded-xl bg-green-600 px-8 py-3 font-semibold text-white hover:bg-green-700"
                    >

                        Simpan Jadwal

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
.create(
    document.querySelector('#editor')
)
.catch(error => {

    console.error(error);

});

</script>

@endpush
