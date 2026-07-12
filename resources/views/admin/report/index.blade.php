@extends('layouts.admin')

@section('title','Laporan Sampah')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Laporan Sampah

            </h1>

            <p class="mt-2 text-slate-500">

                Kelola seluruh laporan masyarakat.

            </p>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="grid gap-5 md:grid-cols-5">

        <div class="rounded-2xl bg-white p-6 shadow">

            <p class="text-slate-500">

                Total

            </p>

            <h2 class="mt-3 text-4xl font-bold">

                {{ $total }}

            </h2>

        </div>

        <div class="rounded-2xl bg-yellow-50 p-6 shadow">

            <p class="text-yellow-700">

                Menunggu

            </p>

            <h2 class="mt-3 text-4xl font-bold text-yellow-600">

                {{ $menunggu }}

            </h2>

        </div>

        <div class="rounded-2xl bg-blue-50 p-6 shadow">

            <p class="text-blue-700">

                Diproses

            </p>

            <h2 class="mt-3 text-4xl font-bold text-blue-600">

                {{ $diproses }}

            </h2>

        </div>

        <div class="rounded-2xl bg-green-50 p-6 shadow">

            <p class="text-green-700">

                Selesai

            </p>

            <h2 class="mt-3 text-4xl font-bold text-green-600">

                {{ $selesai }}

            </h2>

        </div>

        <div class="rounded-2xl bg-red-50 p-6 shadow">

            <p class="text-red-700">

                Ditolak

            </p>

            <h2 class="mt-3 text-4xl font-bold text-red-600">

                {{ $ditolak }}

            </h2>

        </div>

    </div>

    {{-- Filter --}}
    <form
        method="GET"
        class="rounded-2xl bg-white p-5 shadow"
    >

        <div class="grid gap-4 lg:grid-cols-5">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama..."
                class="rounded-xl border p-3"
            >

            <select
                name="status"
                class="rounded-xl border p-3"
            >

                <option value="">Semua Status</option>

                <option value="Menunggu" @selected(request('status')=="Menunggu")>
                    Menunggu
                </option>

                <option value="Diproses" @selected(request('status')=="Diproses")>
                    Diproses
                </option>

                <option value="Selesai" @selected(request('status')=="Selesai")>
                    Selesai
                </option>

                <option value="Ditolak" @selected(request('status')=="Ditolak")>
                    Ditolak
                </option>

            </select>

            <input
                type="text"
                name="rt"
                value="{{ request('rt') }}"
                placeholder="RT"
                class="rounded-xl border p-3"
            >

            <input
                type="text"
                name="rw"
                value="{{ request('rw') }}"
                placeholder="RW"
                class="rounded-xl border p-3"
            >

            <button
                class="rounded-xl bg-green-600 font-semibold text-white"
            >

                Filter

            </button>

        </div>

    </form>

    {{-- Card --}}
    <div class="grid gap-6 lg:grid-cols-2 xl:grid-cols-3">

        @forelse($reports as $report)

        <div class="overflow-hidden rounded-2xl bg-white shadow transition hover:shadow-xl">

            {{-- Foto --}}

            <img
                src="{{ asset('storage/'.$report->foto) }}"
                class="h-60 w-full object-cover"
            >

            <div class="space-y-4 p-5">

                <div class="flex items-center justify-between">

                    <h2 class="text-xl font-bold">

                        {{ $report->nama }}

                    </h2>

                    @if($report->status=="Menunggu")

                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">

                            Menunggu

                        </span>

                    @elseif($report->status=="Diproses")

                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">

                            Diproses

                        </span>

                    @elseif($report->status=="Selesai")

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                            Selesai

                        </span>

                    @else

                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">

                            Ditolak

                        </span>

                    @endif

                </div>

                <div class="space-y-2 text-sm text-slate-600">

                    <div>

                        📍 {{ $report->lokasi }}

                    </div>

                    <div>

                        RT {{ $report->rt }}

                        /

                        RW {{ $report->rw }}

                    </div>

                    <div>

                        {{ $report->created_at->format('d M Y H:i') }}

                    </div>

                </div>

                <p class="line-clamp-3 text-sm text-slate-600">

                    {{ $report->deskripsi }}

                </p>

                <a
                    href="{{ route('report.show',$report) }}"
                    class="block rounded-xl bg-green-600 py-3 text-center font-semibold text-white hover:bg-green-700"
                >

                    Lihat Detail

                </a>

            </div>

        </div>

        @empty

        <div class="col-span-full rounded-2xl bg-white p-20 text-center shadow">

            <div class="text-7xl">

                📭

            </div>

            <h2 class="mt-5 text-2xl font-bold">

                Belum Ada Laporan

            </h2>

            <p class="mt-2 text-slate-500">

                Belum ada laporan yang masuk.

            </p>

        </div>

        @endforelse

    </div>

    <div>

        {{ $reports->links() }}

    </div>

</div>

@endsection
