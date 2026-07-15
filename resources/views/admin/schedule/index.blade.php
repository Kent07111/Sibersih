@extends('layouts.admin')

@section('title','Schedule')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Jadwal Kegiatan

            </h1>

            <p class="mt-2 text-slate-500">

                Kelola agenda kegiatan SIBERSIH.

            </p>

        </div>

        <a
            href="{{ route('schedule.create') }}"
            class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white hover:bg-green-700"
        >

            + Tambah Jadwal

        </a>

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
                name="status"
                class="rounded-xl border p-3"
            >

                <option value="">

                    Semua Status

                </option>

                <option
                    value="Aktif"
                    @selected(request('status')=="Aktif")
                >

                    Aktif

                </option>

                <option
                    value="Selesai"
                    @selected(request('status')=="Selesai")
                >

                    Selesai

                </option>
                <option
                    value="Selesai"
                    @selected(request('status')=="Dibatalkan")
                >

                    Dibatalkan

                </option>
                <option
                    value="Selesai"
                    @selected(request('status')=="Progress")
                >

                    Progress

                </option>
                <option
                    value="Selesai"
                    @selected(request('status')=="Comming Soon")
                >

                    Comming Soon

                </option>
            </select>

            <button
                class="rounded-xl bg-blue-600 font-semibold text-white"
            >

                Filter

            </button>

        </div>

    </form>

    {{-- Card --}}
    <div class="grid gap-6 lg:grid-cols-2 xl:grid-cols-3">

        @forelse($schedules as $schedule)

        <div
            class="overflow-hidden rounded-2xl bg-white shadow transition hover:shadow-xl"
        >

            <div class="flex">

                {{-- Tanggal --}}
                <div
                    class="flex w-28 flex-col items-center justify-center bg-green-600 text-white"
                >

                    <span
                        class="text-4xl font-bold"
                    >

                        {{ $schedule->tanggal->format('d') }}

                    </span>

                    <span
                        class="text-lg uppercase"
                    >

                        {{ $schedule->tanggal->translatedFormat('M') }}

                    </span>

                </div>

                {{-- Isi --}}
                <div class="flex-1 p-5">

                    <div
                        class="flex items-start justify-between"
                    >

                        <h2
                            class="text-xl font-bold"
                        >

                            {{ $schedule->judul }}

                        </h2>

@php
    $statusClass = match($schedule->status) {
        'Aktif' => 'bg-green-100 text-green-700',
        'Progress' => 'bg-blue-100 text-blue-700',
        'Comming Soon' => 'bg-yellow-100 text-yellow-700',
        'Selesai' => 'bg-slate-200 text-slate-700',
        'Dibatalkan' => 'bg-red-100 text-red-700',
        default => 'bg-gray-100 text-gray-700',
    };
@endphp

<span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">
    {{ $schedule->status }}
</span>

                    </div>

                    <div
                        class="mt-4 space-y-2 text-sm text-slate-600"
                    >

                        <div>

                            📅 {{ $schedule->hari }}

                        </div>

                        <div>

                            🕒 {{ \Carbon\Carbon::parse($schedule->jam)->format('H:i') }} WIB

                        </div>

                        <div>

                            📍 {{ $schedule->lokasi }}

                        </div>

                    </div>

@if($schedule->keterangan)

    <p class="mt-4 line-clamp-3 text-sm text-slate-600">
        {{ \Illuminate\Support\Str::limit(strip_tags($schedule->keterangan), 120) }}
    </p>

@endif

                    <div
                        class="mt-6 flex gap-3"
                    >

                        <a
                            href="{{ route('schedule.edit',$schedule) }}"
                            class="flex-1 rounded-xl bg-blue-600 py-3 text-center font-semibold text-white hover:bg-blue-700"
                        >

                            Edit

                        </a>

                        <form
                            action="{{ route('schedule.destroy',$schedule) }}"
                            method="POST"
                            class="flex-1"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                onclick="return confirm('Hapus jadwal ini?')"
                                class="w-full rounded-xl bg-red-600 py-3 font-semibold text-white hover:bg-red-700"
                            >

                                Hapus

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div
            class="col-span-full rounded-2xl bg-white p-20 text-center shadow"
        >

            <div class="text-7xl">

                📅

            </div>

            <h2
                class="mt-5 text-2xl font-bold"
            >

                Belum Ada Jadwal

            </h2>

            <p
                class="mt-2 text-slate-500"
            >

                Tambahkan agenda kegiatan pertama.

            </p>

        </div>

        @endforelse

    </div>

    <div>

        {{ $schedules->links() }}

    </div>

</div>

@endsection
