@extends('layouts.user')

@section('title', 'Riwayat Setoran')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- HERO --}}

    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-700 via-green-600 to-lime-500">

        <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>

        <div class="relative flex flex-col gap-6 p-8 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <span class="inline-flex items-center rounded-full bg-white/20 px-4 py-1 text-sm font-medium text-white backdrop-blur">

                    ♻️ Bank Sampah

                </span>

                <h1 class="mt-4 text-4xl font-bold text-white">

                    Riwayat Setoran

                </h1>

                <p class="mt-3 max-w-2xl text-green-100">

                    Lihat seluruh transaksi penyetoran sampah, saldo yang diterima,
                    poin yang diperoleh, serta status transaksi Anda.

                </p>

            </div>

            <div class="flex flex-wrap gap-3">

                <a
                    href="{{ route('my-deposits.create') }}"
                    class="rounded-2xl bg-white px-6 py-3 font-semibold text-green-700 shadow-lg transition hover:-translate-y-1 hover:shadow-xl"
                >

                    + Setor Sampah

                </a>

                <a
                    href="#"
                    class="rounded-2xl border border-white/40 px-6 py-3 font-semibold text-white backdrop-blur transition hover:bg-white/10"
                >

                    Export PDF

                </a>

            </div>

        </div>

    </section>

    {{-- CARD STATISTIK --}}

    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">

        {{-- TRANSAKSI --}}

        <div class="group rounded-3xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">

                        Total Transaksi

                    </p>

                    <h2 class="mt-3 text-4xl font-bold text-slate-800">

                        {{ number_format($totalTransaction) }}

                    </h2>

                    <p class="mt-1 text-xs text-slate-400">

                        Semua transaksi

                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-100 text-2xl transition group-hover:scale-110">

                    📦

                </div>

            </div>

        </div>

        {{-- BERAT --}}

        <div class="group rounded-3xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">

                        Total Berat

                    </p>

                    <h2 class="mt-3 text-4xl font-bold text-sky-600">

                        {{ number_format($totalWeight,1,',','.') }}

                        Kg

                    </h2>

                    <p class="mt-1 text-xs text-slate-400">

                        Sampah berhasil disetor

                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-100 text-2xl transition group-hover:scale-110">

                    ⚖️

                </div>

            </div>

        </div>

        {{-- SALDO --}}

        <div class="group rounded-3xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">

                        Total Saldo

                    </p>

                    <h2 class="mt-3 text-4xl font-bold text-amber-500">

                        Rp {{ number_format($totalAmount,0,',','.') }}

                    </h2>

                    <p class="mt-1 text-xs text-slate-400">

                        Saldo diterima

                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-2xl transition group-hover:scale-110">

                    💰

                </div>

            </div>

        </div>

        {{-- RATA-RATA --}}

        <div class="group rounded-3xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">

                        Rata-rata

                    </p>

                    <h2 class="mt-3 text-4xl font-bold text-purple-600">

                        Rp {{ number_format($average,0,',','.') }}

                    </h2>

                    <p class="mt-1 text-xs text-slate-400">

                        Per transaksi

                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-100 text-2xl transition group-hover:scale-110">

                    📈

                </div>

            </div>

        </div>

    </div>
    {{-- FILTER --}}

    <form
        action="{{ route('my-deposits.index') }}"
        method="GET"
        class="rounded-3xl bg-white p-6 shadow-sm"
    >

        <div class="grid gap-5 xl:grid-cols-12">

            {{-- Search --}}

            <div class="xl:col-span-4">

                <label class="mb-2 block text-sm font-semibold text-slate-700">

                    Cari Transaksi

                </label>

                <div class="relative">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"
                        />

                    </svg>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nomor invoice..."
                        class="w-full rounded-2xl border border-slate-200 py-3 pl-12 pr-4 transition focus:border-green-500 focus:ring-green-500"
                    >

                </div>

            </div>

            {{-- Status --}}

            <div class="xl:col-span-2">

                <label class="mb-2 block text-sm font-semibold text-slate-700">

                    Status

                </label>

                <select
                    name="status"
                    class="w-full rounded-2xl border border-slate-200 px-4 py-3 focus:border-green-500 focus:ring-green-500"
                >

                    <option value="">

                        Semua Status

                    </option>

                    <option
                        value="Menunggu"
                        @selected(request('status')=='Menunggu')
                    >

                        Menunggu

                    </option>

                    <option
                        value="Diproses"
                        @selected(request('status')=='Diproses')
                    >

                        Diproses

                    </option>

                    <option
                        value="Selesai"
                        @selected(request('status')=='Selesai')
                    >

                        Selesai

                    </option>

                    <option
                        value="Ditolak"
                        @selected(request('status')=='Ditolak')
                    >

                        Ditolak

                    </option>

                </select>

            </div>

            {{-- Dari --}}

            <div class="xl:col-span-2">

                <label class="mb-2 block text-sm font-semibold text-slate-700">

                    Dari

                </label>

                <input
                    type="date"
                    name="start_date"
                    value="{{ request('start_date') }}"
                    class="w-full rounded-2xl border border-slate-200 px-4 py-3 focus:border-green-500 focus:ring-green-500"
                >

            </div>

            {{-- Sampai --}}

            <div class="xl:col-span-2">

                <label class="mb-2 block text-sm font-semibold text-slate-700">

                    Sampai

                </label>

                <input
                    type="date"
                    name="end_date"
                    value="{{ request('end_date') }}"
                    class="w-full rounded-2xl border border-slate-200 px-4 py-3 focus:border-green-500 focus:ring-green-500"
                >

            </div>

            {{-- Tombol --}}

            <div class="flex items-end gap-3 xl:col-span-2">

                <button
                    type="submit"
                    class="flex-1 rounded-2xl bg-green-600 py-3 font-semibold text-white transition hover:bg-green-700"
                >

                    Cari

                </button>

                <a
                    href="{{ route('my-deposits.index') }}"
                    class="rounded-2xl border border-slate-300 px-5 py-3 font-semibold text-slate-600 transition hover:bg-slate-100"
                >

                    Reset

                </a>

            </div>

        </div>

    </form>

    {{-- TABLE CARD --}}

    <div class="overflow-hidden rounded-3xl bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-5">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-xl font-bold text-slate-800">

                        Daftar Riwayat Setoran

                    </h2>

                    <p class="mt-1 text-sm text-slate-500">

                        Semua transaksi penyetoran sampah Anda.

                    </p>

                </div>

                <div class="rounded-xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-600">

                    {{ $deposits->total() }} Transaksi

                </div>

            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full"></table>
<thead class="bg-slate-50">

    <tr class="border-b border-slate-200">

        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">

            No

        </th>

        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">

            Invoice

        </th>

        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">

            Tanggal

        </th>

        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">

            Berat

        </th>

        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">

            Poin

        </th>

        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">

            Status

        </th>

        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">

            Aksi

        </th>

    </tr>

</thead>

<tbody class="divide-y divide-slate-100">

@forelse($deposits as $deposit)

<tr class="transition hover:bg-green-50">

    {{-- Nomor --}}

    <td class="px-6 py-5">

        {{ $loop->iteration + ($deposits->currentPage()-1) * $deposits->perPage() }}

    </td>

    {{-- Invoice --}}

    <td class="px-6 py-5">

        <div class="font-semibold text-slate-800">

            {{ $deposit->invoice_number }}

        </div>

        <div class="mt-1 text-xs text-slate-400">

            {{ $deposit->created_at->format('H:i') }}

        </div>

    </td>

    {{-- Tanggal --}}

    <td class="px-6 py-5">

        {{ $deposit->deposit_date->translatedFormat('d M Y') }}

    </td>

    {{-- Berat --}}

    <td class="px-6 py-5 text-center">

        <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">

            {{ number_format($deposit->total_weight,2) }} Kg

        </span>

    </td>

    {{-- Poin --}}

    <td class="px-6 py-5 text-center">

        <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">

            {{ number_format($deposit->total_point) }}

        </span>

    </td>

    {{-- Status --}}

    <td class="px-6 py-5 text-center">

        @switch($deposit->status)

            @case('Menunggu')

                <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">

                    Menunggu

                </span>

            @break

            @case('Diproses')

                <span class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-700">

                    Diproses

                </span>

            @break

            @case('Selesai')

                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                    Selesai

                </span>

            @break

            @default

                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">

                    Ditolak

                </span>

        @endswitch

    </td>

    {{-- Aksi --}}

    <td class="px-6 py-5">

        <div class="flex justify-center gap-2">

            <a
                href="#"
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-100 text-green-600 transition hover:bg-green-600 hover:text-white"
                title="Detail"
            >

                👁

            </a>

            @if($deposit->status=='Menunggu')

            <button
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-600 transition hover:bg-red-600 hover:text-white"
                title="Batalkan"
            >

                ✕

            </button>

            @endif

        </div>

    </td>

</tr>

@empty

<tr>

    <td
        colspan="7"
        class="py-20"
    >

        <div class="flex flex-col items-center">

            <div class="rounded-full bg-green-100 p-8">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-12 w-12 text-green-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5"
                    />

                </svg>

            </div>

            <h3 class="mt-6 text-2xl font-bold">

                Belum Ada Riwayat

            </h3>

            <p class="mt-2 text-slate-500">

                Anda belum pernah melakukan setoran sampah.

            </p>

            <a
                href="{{ route('my-deposits.create') }}"
                class="mt-6 rounded-xl bg-green-600 px-6 py-3 font-semibold text-white hover:bg-green-700"
            >

                + Setor Sampah

            </a>

        </div>

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>
    {{-- FOOTER --}}

    <div
        class="flex flex-col gap-4 rounded-3xl bg-white p-6 shadow-sm lg:flex-row lg:items-center lg:justify-between"
    >

        <div>

            <h3
                class="font-semibold text-slate-800"
            >

                Menampilkan

                {{ $deposits->firstItem() ?? 0 }}

                -

                {{ $deposits->lastItem() ?? 0 }}

                dari

                {{ $deposits->total() }}

                transaksi

            </h3>

            <p
                class="mt-1 text-sm text-slate-500"
            >

                Total transaksi penyetoran sampah Anda.

            </p>

        </div>

        <div>

            {{ $deposits->onEachSide(1)->links() }}

        </div>

    </div>

    {{-- RINGKASAN --}}

    <div
        class="grid gap-5 lg:grid-cols-3"
    >

        {{-- Berat --}}

        <div
            class="rounded-3xl bg-gradient-to-r from-sky-500 to-blue-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl"
        >

            <p
                class="text-sky-100"
            >

                Total Berat

            </p>

            <h2
                class="mt-3 text-4xl font-bold"
            >

                {{ number_format($totalWeight,1,',','.') }}

                Kg

            </h2>

        </div>

        {{-- Saldo --}}

        <div
            class="rounded-3xl bg-gradient-to-r from-green-500 to-emerald-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl"
        >

            <p
                class="text-green-100"
            >

                Total Saldo

            </p>

            <h2
                class="mt-3 text-4xl font-bold"
            >

                Rp

                {{ number_format($totalAmount,0,',','.') }}

            </h2>

        </div>

        {{-- Rata-rata --}}

        <div
            class="rounded-3xl bg-gradient-to-r from-purple-500 to-fuchsia-600 p-6 text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:shadow-2xl"
        >

            <p
                class="text-purple-100"
            >

                Rata-rata

            </p>

            <h2
                class="mt-3 text-4xl font-bold"
            >

                Rp

                {{ number_format($average,0,',','.') }}

            </h2>

        </div>

    </div>

</div>

@endsection
