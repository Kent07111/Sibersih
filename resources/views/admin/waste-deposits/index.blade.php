@extends('layouts.admin')

@section('title', 'Setoran Sampah')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Setoran Sampah
            </h1>

            <p class="mt-2 text-slate-500">
                Kelola dan validasi setoran sampah dari nasabah.
            </p>

        </div>

    </div>

    {{-- Search --}}
    <div class="rounded-2xl bg-white p-6 shadow">

        <form method="GET">

            <div class="flex gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari invoice atau nama nasabah..."
                    class="flex-1 rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:ring-green-500"
                >

                <button
                    class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white hover:bg-green-700"
                >
                    Cari
                </button>

            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow">

        <table class="min-w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-6 py-4 text-left">Invoice</th>

                    <th class="px-6 py-4 text-left">Nasabah</th>

                    <th class="px-6 py-4 text-center">Tanggal</th>

                    <th class="px-6 py-4 text-center">Berat</th>

                    <th class="px-6 py-4 text-center">Status</th>

                    <th class="px-6 py-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($deposits as $deposit)

                    <tr class="border-t hover:bg-slate-50">

                        <td class="px-6 py-4 font-semibold">

                            {{ $deposit->invoice_number }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $deposit->user->name }}

                        </td>

                        <td class="px-6 py-4 text-center">

                            {{ \Carbon\Carbon::parse($deposit->deposit_date)->translatedFormat('d F Y') }}

                        </td>

                        <td class="px-6 py-4 text-center">

                            {{ number_format($deposit->total_weight,2) }} Kg

                        </td>

                        <td class="px-6 py-4 text-center">

                            @switch($deposit->status)

                                @case('Menunggu')

                                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-700">
                                        Menunggu
                                    </span>

                                    @break

                                @case('Diterima')

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700">
                                        Diterima
                                    </span>

                                    @break

                                @case('Ditolak')

                                    <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-700">
                                        Ditolak
                                    </span>

                                    @break

                                @default

                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-sm">
                                        {{ $deposit->status }}
                                    </span>

                            @endswitch

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-center gap-2">

                                <a
                                    href="{{ route('waste-deposits.show',$deposit) }}"
                                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700"
                                >
                                    Detail
                                </a>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="px-6 py-12 text-center text-slate-500"
                        >

                            Belum ada data setoran.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div>

        {{ $deposits->links() }}

    </div>

</div>

@endsection
