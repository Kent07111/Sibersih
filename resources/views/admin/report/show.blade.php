@extends('layouts.admin')

@section('title','Detail Laporan')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Detail Laporan

            </h1>

            <p class="mt-2 text-slate-500">

                Informasi lengkap laporan masyarakat.

            </p>

        </div>

        <a
            href="{{ route('report.index') }}"
            class="rounded-xl border px-5 py-3 hover:bg-slate-100"
        >

            Kembali

        </a>

    </div>

    <form
        action="{{ route('report.update',$report) }}"
        method="POST"
    >

        @csrf

        @method('PUT')

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- LEFT --}}
            <div class="space-y-6">

                {{-- FOTO --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold">

                        Foto Laporan

                    </h2>

                    <img
                        src="{{ asset('storage/'.$report->foto) }}"
                        class="w-full rounded-xl"
                    >

                </div>

                {{-- DATA PELAPOR --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold">

                        Data Pelapor

                    </h2>

                    <div class="space-y-4">

                        <div>

                            <label class="text-sm text-slate-500">

                                Nama

                            </label>

                            <input
                                value="{{ $report->nama }}"
                                readonly
                                class="mt-1 w-full rounded-xl border bg-slate-100 p-3"
                            >

                        </div>

                        <div>

                            <label class="text-sm text-slate-500">

                                Telepon

                            </label>

                            <input
                                value="{{ $report->telepon }}"
                                readonly
                                class="mt-1 w-full rounded-xl border bg-slate-100 p-3"
                            >

                        </div>

                        <div class="grid grid-cols-2 gap-3">

                            <div>

                                <label class="text-sm text-slate-500">

                                    RT

                                </label>

                                <input
                                    value="{{ $report->rt }}"
                                    readonly
                                    class="mt-1 w-full rounded-xl border bg-slate-100 p-3"
                                >

                            </div>

                            <div>

                                <label class="text-sm text-slate-500">

                                    RW

                                </label>

                                <input
                                    value="{{ $report->rw }}"
                                    readonly
                                    class="mt-1 w-full rounded-xl border bg-slate-100 p-3"
                                >

                            </div>

                        </div>

                        <div>

                            <label class="text-sm text-slate-500">

                                Tanggal

                            </label>

                            <input
                                value="{{ $report->created_at->format('d M Y H:i') }}"
                                readonly
                                class="mt-1 w-full rounded-xl border bg-slate-100 p-3"
                            >

                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="space-y-6 lg:col-span-2">

                {{-- LOKASI --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold">

                        Lokasi Laporan

                    </h2>

                    <input
                        value="{{ $report->lokasi }}"
                        readonly
                        class="mb-5 w-full rounded-xl border bg-slate-100 p-3"
                    >

                    <div
                        id="map"
                        class="h-[450px] rounded-xl"
                    ></div>

                </div>

                {{-- DESKRIPSI --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold">

                        Deskripsi

                    </h2>

                    <textarea
                        readonly
                        rows="6"
                        class="w-full rounded-xl border bg-slate-100 p-3"
                    >{{ $report->deskripsi }}</textarea>

                </div>
                {{-- PROSES LAPORAN --}}
                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold">

                        Proses Laporan

                    </h2>

                    <div class="grid gap-5 md:grid-cols-2">

                        <div>

                            <label class="mb-2 block font-medium">

                                Status

                            </label>

                            <select
                                name="status"
                                class="w-full rounded-xl border p-3"
                            >

                                <option
                                    value="Menunggu"
                                    @selected($report->status=="Menunggu")
                                >

                                    Menunggu

                                </option>

                                <option
                                    value="Diproses"
                                    @selected($report->status=="Diproses")
                                >

                                    Diproses

                                </option>

                                <option
                                    value="Selesai"
                                    @selected($report->status=="Selesai")
                                >

                                    Selesai

                                </option>

                                <option
                                    value="Ditolak"
                                    @selected($report->status=="Ditolak")
                                >

                                    Ditolak

                                </option>

                            </select>

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">

                                Titik Sampah

                            </label>

                            <select
                                name="waste_point_id"
                                class="w-full rounded-xl border p-3"
                            >

                                <option value="">

                                    Belum Ditentukan

                                </option>

                                @foreach($wastePoints as $point)

                                    <option
                                        value="{{ $point->id }}"
                                        @selected($report->waste_point_id==$point->id)
                                    >

                                        {{ $point->nama }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="mt-5">

                        <label class="mb-2 block font-medium">

                            Catatan Admin

                        </label>

                        <textarea
                            name="catatan_admin"
                            rows="5"
                            class="w-full rounded-xl border p-3"
                        >{{ old('catatan_admin',$report->catatan_admin) }}</textarea>

                    </div>

                    <div class="mt-6 flex justify-end gap-3">

                        <a
                            target="_blank"
                            href="https://www.google.com/maps?q={{ $report->latitude }},{{ $report->longitude }}"
                            class="rounded-xl bg-blue-600 px-6 py-3 text-white hover:bg-blue-700"
                        >

                            Google Maps

                        </a>

                        <button
                            class="rounded-xl bg-green-600 px-8 py-3 font-semibold text-white hover:bg-green-700"
                        >

                            Simpan Perubahan

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script>

const map = L.map('map').setView(

    [

        {{ $report->latitude }},

        {{ $report->longitude }}

    ],

    17

);

L.tileLayer(

    'https://tile.openstreetmap.org/{z}/{x}/{y}.png',

    {

        attribution:'© OpenStreetMap'

    }

).addTo(map);

L.marker([

    {{ $report->latitude }},

    {{ $report->longitude }}

])

.addTo(map)

.bindPopup(`

<b>{{ $report->nama }}</b>

<br>

{{ $report->lokasi }}

`)

.openPopup();

</script>

@endpush
