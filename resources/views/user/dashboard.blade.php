@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    <!-- Header -->

    <div class="rounded-3xl bg-gradient-to-r from-green-600 via-emerald-500 to-teal-500 p-8 text-white shadow-xl">

        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <h1 class="text-3xl font-bold">
                    Halo, {{ Auth::user()->name }} 👋
                </h1>

                <p class="mt-2 text-green-100">
                    Selamat datang kembali di Sistem Informasi Bank Sampah.
                    Terima kasih telah berpartisipasi menjaga lingkungan.
                </p>

            </div>

            <div class="rounded-2xl bg-white/20 px-6 py-4 backdrop-blur">

                <p class="text-sm text-green-100">
                    Saldo Anda
                </p>

                <h2 class="mt-2 text-3xl font-bold">

                    Rp {{ number_format($wallet->balance ?? 0,0,',','.') }}

                </h2>

            </div>

        </div>

    </div>

    <!-- Statistik -->

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

        <!-- Saldo -->

        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">

                        Saldo

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-green-600">

                        Rp {{ number_format($wallet->balance ?? 0,0,',','.') }}

                    </h2>

                </div>

                <div class="rounded-2xl bg-green-100 p-4">

                    💰

                </div>

            </div>

        </div>

        <!-- Poin -->

        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">

                        Total Poin

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-yellow-500">

                        {{ number_format($wallet->point ?? 0) }}

                    </h2>

                </div>

                <div class="rounded-2xl bg-yellow-100 p-4">

                    ⭐

                </div>

            </div>

        </div>

        <!-- Berat -->

        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">

                        Total Setoran

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-blue-600">

                        {{ number_format($totalWeight,1) }} Kg

                    </h2>

                </div>

                <div class="rounded-2xl bg-blue-100 p-4">

                    ♻️

                </div>

            </div>

        </div>

        <!-- Transaksi -->

        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">

                        Total Transaksi

                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-purple-600">

                        {{ $totalTransaction }}

                    </h2>

                </div>

                <div class="rounded-2xl bg-purple-100 p-4">

                    📦

                </div>

            </div>

        </div>

    </div>

    <!-- Isi Dashboard -->
    <!-- Riwayat & Reward -->

    <div class="grid gap-6 xl:grid-cols-3">

        <!-- Riwayat Setoran -->

        <div class="xl:col-span-2 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

            <div class="flex items-center justify-between border-b px-6 py-5">

                <div>

                    <h2 class="text-lg font-bold text-gray-800">
                        Riwayat Setoran Terbaru
                    </h2>

                    <p class="text-sm text-gray-500">
                        5 transaksi terakhir
                    </p>

                </div>

                <a
                    href="#"
                    class="rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700"
                >
                    Lihat Semua
                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                                Invoice
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                                Tanggal
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase text-gray-500">
                                Berat
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase text-gray-500">
                                Status
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($latestDeposits as $deposit)

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">

                                    <div class="font-semibold text-gray-800">

                                        {{ $deposit->deposit_number }}

                                    </div>

                                </td>

                                <td class="px-6 py-4 text-gray-600">

                                    {{ $deposit->created_at->format('d M Y') }}

                                </td>

                                <td class="px-6 py-4 text-center font-semibold">

                                    {{ number_format($deposit->total_weight,1) }} Kg

                                </td>

                                <td class="px-6 py-4 text-center">

                                    @if($deposit->status=='Menunggu')

                                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                            Menunggu
                                        </span>

                                    @elseif($deposit->status=='Diproses')

                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                            Diproses
                                        </span>

                                    @elseif($deposit->status=='Selesai')

                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                            Selesai
                                        </span>

                                    @else

                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Ditolak
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="py-10 text-center text-gray-500">

                                    Belum ada data setoran.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- Reward -->

        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

            <div class="border-b px-6 py-5">

                <h2 class="text-lg font-bold text-gray-800">

                    Reward Terbaru

                </h2>

                <p class="text-sm text-gray-500">

                    Tukarkan poinmu sekarang

                </p>

            </div>

            <div class="space-y-4 p-6">

                @forelse($rewards as $reward)

                    <div class="rounded-xl border border-gray-200 p-4 transition hover:border-green-500 hover:shadow">

                        <div class="flex items-center justify-between">

                            <div>

                                <h3 class="font-semibold text-gray-800">

                                    {{ $reward->name }}

                                </h3>

                                <p class="mt-1 text-sm text-gray-500">

                                    {{ number_format($reward->point_required) }} Poin

                                </p>

                            </div>

                            <div>

                                🎁

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="py-10 text-center text-gray-500">

                        Belum ada reward.

                    </div>

                @endforelse

            </div>

        </div>

    </div>
    <!-- Grafik -->

    <div class="grid gap-6 xl:grid-cols-3">

        <!-- Grafik Setoran -->

        <div class="xl:col-span-2 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

            <div class="mb-6">

                <h2 class="text-lg font-bold text-gray-800">
                    Grafik Setoran Sampah
                </h2>

                <p class="text-sm text-gray-500">
                    Total berat sampah yang telah disetor.
                </p>

            </div>

            <div id="depositChart" class="h-80"></div>

        </div>

        <!-- Komposisi -->

        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

            <div class="mb-6">

                <h2 class="text-lg font-bold text-gray-800">
                    Komposisi Sampah
                </h2>

                <p class="text-sm text-gray-500">
                    Berdasarkan kategori sampah.
                </p>

            </div>

            <div id="compositionChart" class="h-80"></div>

        </div>

    </div>

    <!-- Quick Menu -->

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

        <div class="mb-6">

            <h2 class="text-lg font-bold text-gray-800">
                Menu Cepat
            </h2>

            <p class="text-sm text-gray-500">
                Akses fitur Bank Sampah dengan sekali klik.
            </p>

        </div>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">

            <!-- Setor Sampah -->

            <a href="#"
               class="group rounded-2xl border border-green-100 bg-green-50 p-6 text-center transition hover:-translate-y-1 hover:border-green-500 hover:shadow-lg">

                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-500 text-3xl text-white transition group-hover:scale-110">
                    ♻️
                </div>

                <h3 class="font-semibold text-gray-800">
                    Setor Sampah
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    Ajukan setoran sampah baru.
                </p>

            </a>

            <!-- Riwayat -->

            <a href="#"
               class="group rounded-2xl border border-blue-100 bg-blue-50 p-6 text-center transition hover:-translate-y-1 hover:border-blue-500 hover:shadow-lg">

                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-500 text-3xl text-white transition group-hover:scale-110">
                    📋
                </div>

                <h3 class="font-semibold text-gray-800">
                    Riwayat
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    Lihat riwayat transaksi.
                </p>

            </a>

            <!-- Reward -->

            <a href="#"
               class="group rounded-2xl border border-yellow-100 bg-yellow-50 p-6 text-center transition hover:-translate-y-1 hover:border-yellow-500 hover:shadow-lg">

                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-yellow-500 text-3xl text-white transition group-hover:scale-110">
                    🎁
                </div>

                <h3 class="font-semibold text-gray-800">
                    Reward
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    Tukarkan poin hadiah.
                </p>

            </a>

            <!-- Dompet -->

            <a href="#"
               class="group rounded-2xl border border-emerald-100 bg-emerald-50 p-6 text-center transition hover:-translate-y-1 hover:border-emerald-500 hover:shadow-lg">

                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-500 text-3xl text-white transition group-hover:scale-110">
                    💰
                </div>

                <h3 class="font-semibold text-gray-800">
                    Dompet
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    Saldo dan poin Anda.
                </p>

            </a>

            <!-- Profil -->

            <a href="#"
               class="group rounded-2xl border border-purple-100 bg-purple-50 p-6 text-center transition hover:-translate-y-1 hover:border-purple-500 hover:shadow-lg">

                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-purple-500 text-3xl text-white transition group-hover:scale-110">
                    👤
                </div>

                <h3 class="font-semibold text-gray-800">
                    Profil
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    Kelola data akun.
                </p>

            </a>

        </div>

    </div>
</div>

@endsection




@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>

const months = [
    'Jan','Feb','Mar','Apr','Mei','Jun',
    'Jul','Agu','Sep','Okt','Nov','Des'
];

const chartData = @json($chart);

const categories = chartData.map(item => months[item.month - 1]);

const totals = chartData.map(item => parseFloat(item.total));

new ApexCharts(document.querySelector("#depositChart"), {

    chart:{
        type:'bar',
        height:320,
        toolbar:{
            show:false
        }
    },

    series:[{
        name:'Kg',
        data:totals
    }],

    xaxis:{
        categories:categories
    },

    colors:['#16a34a'],

    plotOptions:{
        bar:{
            borderRadius:8,
            columnWidth:'45%'
        }
    },

    dataLabels:{
        enabled:false
    },

    stroke:{
        show:true,
        width:2
    }

}).render();

const composition = @json($composition);

const labels = composition.map(item => item.category.name);

const values = composition.map(item => parseFloat(item.total));

new ApexCharts(document.querySelector("#compositionChart"),{

    chart:{
        type:'donut',
        height:320
    },

    labels:labels,

    series:values,

    legend:{
        position:'bottom'
    }

}).render();

</script>

@endpush
