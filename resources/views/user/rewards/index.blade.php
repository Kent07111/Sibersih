@extends('layouts.user')

@section('title','Reward')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- HERO --}}

    <section
        class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-amber-500 via-orange-500 to-yellow-500 shadow-xl"
    >

        <div
            class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-white/10 blur-3xl"
        ></div>

        <div
            class="relative flex flex-col gap-8 p-8 lg:flex-row lg:items-center lg:justify-between"
        >

            <div>

                <span
                    class="inline-flex rounded-full bg-white/20 px-4 py-1 text-sm font-semibold text-white backdrop-blur"
                >

                    🎁 Reward Bank Sampah

                </span>

                <h1
                    class="mt-4 text-4xl font-bold text-white"
                >

                    Tukarkan Poin Anda

                </h1>

                <p
                    class="mt-3 max-w-2xl text-yellow-100"
                >

                    Gunakan poin hasil penyetoran sampah untuk mendapatkan
                    berbagai hadiah menarik yang tersedia.

                </p>

            </div>

            <div
                class="rounded-3xl bg-white/15 p-8 backdrop-blur"
            >

                <p
                    class="text-yellow-100"
                >

                    Poin Saya

                </p>

                <h2
                    class="mt-3 text-5xl font-extrabold text-white"
                >

                    {{ number_format($wallet?->point ?? 0) }}

                </h2>

                <p
                    class="mt-2 text-yellow-100"
                >

                    Poin

                </p>

            </div>

        </div>

    </section>

    {{-- FLASH MESSAGE --}}

    @if(session('success'))

        <div
            class="rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700"
        >

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div
            class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700"
        >

            {{ session('error') }}

        </div>

    @endif

    {{-- CARD --}}

    <div
        class="grid gap-6 lg:grid-cols-3"
    >

        {{-- POINT --}}

        <div
            class="rounded-3xl bg-white p-6 shadow-sm"
        >

            <div
                class="flex items-center gap-5"
            >

                <div
                    class="flex h-16 w-16 items-center justify-center rounded-2xl bg-yellow-100 text-3xl"
                >

                    ⭐

                </div>

                <div>

                    <p
                        class="text-sm text-slate-500"
                    >

                        Total Poin

                    </p>

                    <h2
                        class="mt-2 text-3xl font-bold text-green-600"
                    >

                        {{ number_format($wallet?->point ?? 0) }}

                    </h2>

                </div>

            </div>

            <div
                class="mt-6 rounded-2xl bg-slate-50 p-4"
            >

                <p
                    class="text-sm leading-7 text-slate-500"
                >

                    Kumpulkan poin sebanyak mungkin dengan
                    menyetor sampah agar dapat ditukar
                    dengan hadiah pilihan.

                </p>

            </div>

        </div>

        {{-- CARA TUKAR --}}

        <div
            class="rounded-3xl bg-white p-6 shadow-sm lg:col-span-2"
        >

            <h2
                class="text-xl font-bold text-slate-800"
            >

                Cara Menukar Reward

            </h2>

            <div
                class="mt-8 grid grid-cols-2 gap-6 md:grid-cols-4"
            >

                <div class="text-center">

                    <div
                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-600 font-bold text-white"
                    >

                        1

                    </div>

                    <p
                        class="mt-3 text-sm font-semibold"
                    >

                        Pilih Reward

                    </p>

                </div>

                <div class="text-center">

                    <div
                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-600 font-bold text-white"
                    >

                        2

                    </div>

                    <p
                        class="mt-3 text-sm font-semibold"
                    >

                        Pastikan Poin Cukup

                    </p>

                </div>

                <div class="text-center">

                    <div
                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-600 font-bold text-white"
                    >

                        3

                    </div>

                    <p
                        class="mt-3 text-sm font-semibold"
                    >

                        Tukarkan Reward

                    </p>

                </div>

                <div class="text-center">

                    <div
                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-600 font-bold text-white"
                    >

                        4

                    </div>

                    <p
                        class="mt-3 text-sm font-semibold"
                    >

                        Reward Diproses

                    </p>

                </div>

            </div>

        </div>

    </div>
    {{-- ================= DAFTAR REWARD ================= --}}

    <div class="grid gap-6 lg:grid-cols-3">

        {{-- LIST REWARD --}}

        <div class="lg:col-span-2">

            <div class="mb-6 flex items-center justify-between">

                <div>

                    <h2 class="text-2xl font-bold text-slate-800">

                        Pilih Reward

                    </h2>

                    <p class="mt-1 text-slate-500">

                        Pilih hadiah yang ingin Anda tukarkan menggunakan poin.

                    </p>

                </div>

                <div
                    class="rounded-2xl bg-green-100 px-4 py-2 text-sm font-semibold text-green-700"
                >

                    {{ $rewards->count() }} Reward

                </div>

            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                @forelse($rewards as $reward)

                <div
                    class="group overflow-hidden rounded-3xl bg-white shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-xl"
                >

                    {{-- IMAGE --}}

                    <div class="relative h-52 overflow-hidden bg-slate-100">

                        @if($reward->image)

                            <img
                                src="{{ asset('storage/'.$reward->image) }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-110"
                            >

                        @else

                            <div
                                class="flex h-full items-center justify-center text-7xl"
                            >

                                🎁

                            </div>

                        @endif

                        @if($reward->stock > 0)

                            <span
                                class="absolute left-4 top-4 rounded-full bg-green-600 px-3 py-1 text-xs font-semibold text-white"
                            >

                                Stok {{ $reward->stock }}

                            </span>

                        @else

                            <span
                                class="absolute left-4 top-4 rounded-full bg-red-600 px-3 py-1 text-xs font-semibold text-white"
                            >

                                Habis

                            </span>

                        @endif

                    </div>

                    {{-- CONTENT --}}

                    <div class="p-5">

                        <h3
                            class="line-clamp-1 text-lg font-bold text-slate-800"
                        >

                            {{ $reward->name }}

                        </h3>

                        <p
                            class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500"
                        >

                            {{ $reward->description }}

                        </p>

                        <div
                            class="mt-5 rounded-2xl bg-amber-50 p-4"
                        >

                            <p
                                class="text-xs text-slate-500"
                            >

                                Dibutuhkan

                            </p>

                            <div
                                class="mt-2 flex items-center justify-between"
                            >

                                <span
                                    class="text-2xl font-bold text-amber-500"
                                >

                                    {{-- {{ number_format($reward->point_required) }} --}}
                                    {{ number_format($reward->required_point) }}

                                </span>

                                <span
                                    class="text-2xl"
                                >

                                    ⭐

                                </span>

                            </div>

                        </div>

                        {{-- BUTTON --}}

                        @if($reward->stock <= 0)

                            <button
                                disabled
                                class="mt-5 w-full cursor-not-allowed rounded-2xl bg-red-100 py-3 font-semibold text-red-600"
                            >

                                Reward Habis

                            </button>

                        @elseif($wallet?->point ?? 0) < $reward->required_point

                            <button
                                disabled
                                class="mt-5 w-full cursor-not-allowed rounded-2xl bg-slate-200 py-3 font-semibold text-slate-500"
                            >

                                Poin Tidak Cukup

                            </button>

                        @else

                            <form
                                action="{{ route('user.rewards.redeem',$reward) }}"
                                method="POST"
                                class="mt-5"
                            >

                                @csrf

                                <button
                                    class="w-full rounded-2xl bg-green-600 py-3 font-semibold text-white transition hover:bg-green-700"
                                >

                                    Tukar Reward

                                </button>

                            </form>

                        @endif

                    </div>

                </div>

                @empty

                <div
                    class="col-span-full rounded-3xl bg-white p-20 text-center shadow-sm"
                >

                    <div class="text-7xl">

                        🎁

                    </div>

                    <h2
                        class="mt-6 text-2xl font-bold"
                    >

                        Belum Ada Reward

                    </h2>

                    <p
                        class="mt-3 text-slate-500"
                    >

                        Saat ini belum tersedia hadiah yang dapat ditukarkan.

                    </p>

                </div>

                @endforelse

            </div>

        </div>
        {{-- ================= SIDEBAR ================= --}}

        <div class="space-y-6">

            {{-- Ringkasan Poin --}}

            <div
                class="rounded-3xl bg-white p-6 shadow-sm"
            >

                <div class="flex items-center gap-4">

                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-2xl bg-yellow-100 text-3xl"
                    >

                        ⭐

                    </div>

                    <div>

                        <p
                            class="text-sm text-slate-500"
                        >

                            Poin Tersedia

                        </p>

                        <h2
                            class="mt-2 text-3xl font-bold text-green-600"
                        >

                            {{ number_format($wallet?->point ?? 0) }}

                        </h2>

                    </div>

                </div>

                <div
                    class="mt-6 rounded-2xl bg-slate-100 p-4"
                >

                    <div class="flex justify-between text-sm">

                        <span>

                            Progress Reward

                        </span>

                        <span>

                            {{ number_format($wallet?->point ?? 0) }}

                            Poin

                        </span>

                    </div>

                    <div
                        class="mt-3 h-3 overflow-hidden rounded-full bg-slate-200"
                    >

                        <div
                            class="h-full rounded-full bg-green-600"
                            style="width: {{ min((($wallet?->point ?? 0)/500)*100,100) }}%;"
                        ></div>

                    </div>

                    <p
                        class="mt-3 text-xs text-slate-500"
                    >

                        Progress menuju 500 poin.

                    </p>

                </div>

            </div>

            {{-- Tips --}}

            <div
                class="rounded-3xl bg-white p-6 shadow-sm"
            >

                <h3
                    class="text-lg font-bold text-slate-800"
                >

                    Tips Mendapatkan Poin

                </h3>

                <div
                    class="mt-6 space-y-5"
                >

                    <div
                        class="flex gap-4"
                    >

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 font-bold text-green-600"
                        >

                            ✓

                        </div>

                        <div>

                            <h4
                                class="font-semibold"
                            >

                                Setor Sampah Rutin

                            </h4>

                            <p
                                class="mt-1 text-sm text-slate-500"
                            >

                                Semakin sering menyetor,
                                semakin banyak poin yang didapat.

                            </p>

                        </div>

                    </div>

                    <div
                        class="flex gap-4"
                    >

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 font-bold text-green-600"
                        >

                            ✓

                        </div>

                        <div>

                            <h4
                                class="font-semibold"
                            >

                                Pilah Sampah

                            </h4>

                            <p
                                class="mt-1 text-sm text-slate-500"
                            >

                                Pisahkan sampah sesuai kategori
                                agar penilaian lebih maksimal.

                            </p>

                        </div>

                    </div>

                    <div
                        class="flex gap-4"
                    >

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 font-bold text-green-600"
                        >

                            ✓

                        </div>

                        <div>

                            <h4
                                class="font-semibold"
                            >

                                Jaga Kebersihan

                            </h4>

                            <p
                                class="mt-1 text-sm text-slate-500"
                            >

                                Sampah yang bersih memiliki nilai
                                lebih baik.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Riwayat Penukaran --}}

            <div
                class="rounded-3xl bg-white shadow-sm"
            >

                <div
                    class="border-b px-6 py-5"
                >

                    <h3
                        class="text-lg font-bold text-slate-800"
                    >

                        Penukaran Terakhir

                    </h3>

                </div>

                <div
                    class="divide-y"
                >

                    @forelse($histories as $history)

                        <div
                            class="p-5"
                        >

                            <div
                                class="flex items-center justify-between"
                            >

                                <div>

                                    <h4
                                        class="font-semibold"
                                    >

                                        {{ $history->reward->name }}

                                    </h4>

                                    <p
                                        class="mt-1 text-xs text-slate-400"
                                    >

                                        {{ $history->created_at->translatedFormat('d M Y') }}

                                    </p>

                                </div>

                                <span
                                    class="font-bold text-amber-500"
                                >

                                    {{ number_format($history->used_point) }}

                                </span>

                            </div>

                            <div
                                class="mt-4"
                            >

                                @switch($history->status)

                                    @case('Menunggu')

                                        <span
                                            class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700"
                                        >

                                            Menunggu

                                        </span>

                                    @break

                                    @case('Disetujui')

                                        <span
                                            class="rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-700"
                                        >

                                            Disetujui

                                        </span>

                                    @break

                                    @case('Selesai')

                                        <span
                                            class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700"
                                        >

                                            Selesai

                                        </span>

                                    @break

                                    @default

                                        <span
                                            class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700"
                                        >

                                            Ditolak

                                        </span>

                                @endswitch

                            </div>

                        </div>

                    @empty

                        <div
                            class="p-10 text-center text-slate-500"
                        >

                            Belum ada riwayat penukaran.

                        </div>

                    @endforelse

                </div>

                <div
                    class="border-t p-5"
                >

                    <a
                        href="{{ route('user.rewards.history') }}"
                        class="block rounded-2xl border border-green-600 py-3 text-center font-semibold text-green-600 transition hover:bg-green-600 hover:text-white"
                    >

                        Lihat Semua Riwayat

                    </a>

                </div>

            </div>

        </div>

    </div>
    {{-- ================= FOOTER INFO ================= --}}

    <div
        class="rounded-3xl bg-gradient-to-r from-green-600 via-emerald-600 to-green-700 p-8 text-white shadow-lg"
    >

        <div
            class="grid gap-8 lg:grid-cols-3"
        >

            <div>

                <h3
                    class="text-xl font-bold"
                >

                    Tentang Reward

                </h3>

                <p
                    class="mt-4 leading-7 text-green-100"
                >

                    Setiap poin yang Anda kumpulkan berasal dari
                    aktivitas menyetor sampah. Gunakan poin tersebut
                    untuk mendapatkan berbagai hadiah menarik yang
                    telah disediakan oleh Bank Sampah.

                </p>

            </div>

            <div>

                <h3
                    class="text-xl font-bold"
                >

                    Ketentuan

                </h3>

                <ul
                    class="mt-4 space-y-3 text-green-100"
                >

                    <li>

                        ✓ Poin tidak dapat diuangkan.

                    </li>

                    <li>

                        ✓ Reward mengikuti stok yang tersedia.

                    </li>

                    <li>

                        ✓ Penukaran akan diverifikasi oleh Admin.

                    </li>

                    <li>

                        ✓ Poin akan dipotong setelah permintaan berhasil.

                    </li>

                </ul>

            </div>

            <div>

                <h3
                    class="text-xl font-bold"
                >

                    Statistik Reward

                </h3>

                <div
                    class="mt-5 space-y-4"
                >

                    <div
                        class="flex items-center justify-between rounded-2xl bg-white/10 px-5 py-3 backdrop-blur"
                    >

                        <span>

                            Reward Aktif

                        </span>

                        <strong>

                            {{ $rewards->count() }}

                        </strong>

                    </div>

                    <div
                        class="flex items-center justify-between rounded-2xl bg-white/10 px-5 py-3 backdrop-blur"
                    >

                        <span>

                            Penukaran Saya

                        </span>

                        <strong>

                            {{ $histories->count() }}

                        </strong>

                    </div>

                    <div
                        class="flex items-center justify-between rounded-2xl bg-white/10 px-5 py-3 backdrop-blur"
                    >

                        <span>

                            Poin Saat Ini

                        </span>

                        <strong>

                            {{ number_format($wallet?->point ?? 0) }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
