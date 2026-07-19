@extends('layouts.user')

@section('title', 'Setor Sampah')

@section('content')

<div
    x-data="depositForm()"
    class="mx-auto max-w-7xl space-y-6"
>

    {{-- Header --}}

    <div>

        <h1 class="text-3xl font-bold text-slate-800">

            Setor Sampah

        </h1>

        <p class="mt-2 text-slate-500">

            Setorkan sampahmu dan dapatkan saldo serta poin dari setiap transaksi.

        </p>

    </div>

    {{-- Step Progress --}}

    <div class="rounded-2xl bg-white p-6 shadow-sm">

        <div class="flex items-center justify-center">

            <div class="flex w-full max-w-2xl items-center">

                <div class="flex flex-col items-center">

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-600 font-bold text-white">

                        1

                    </div>

                    <p class="mt-2 text-sm font-medium text-green-600">

                        Input Data

                    </p>

                </div>

                <div class="mx-3 h-1 flex-1 rounded bg-green-500"></div>

                <div class="flex flex-col items-center">

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 font-bold text-gray-500">

                        2

                    </div>

                    <p class="mt-2 text-sm text-gray-500">

                        Konfirmasi

                    </p>

                </div>

                <div class="mx-3 h-1 flex-1 rounded bg-gray-200"></div>

                <div class="flex flex-col items-center">

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 font-bold text-gray-500">

                        3

                    </div>

                    <p class="mt-2 text-sm text-gray-500">

                        Selesai

                    </p>

                </div>

            </div>

        </div>

    </div>

    @if ($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-4">

            <ul class="list-disc pl-5 text-red-600">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="grid gap-6 lg:grid-cols-3">

        {{-- FORM --}}

        <div class="lg:col-span-2">

            <form
                action="{{ route('my-deposits.store') }}"
                method="POST"
                class="space-y-6"
            >

                @csrf

                <div class="rounded-2xl bg-white p-6 shadow-sm">

                    <h2 class="mb-6 text-xl font-bold">

                        Input Data Setoran

                    </h2>

                    <template
                        x-for="(item,index) in items"
                        :key="index"
                    >

                        <div class="mb-6 rounded-xl border p-5">

                            <div class="grid gap-5 md:grid-cols-2">

                                {{-- Jenis Sampah --}}

                                <div>

                                    <label class="mb-2 block font-medium">

                                        Pilih Jenis Sampah

                                    </label>

                                    <select
                                        :name="'category_id[]'"
                                        x-model="item.category"
                                        class="w-full rounded-xl border px-4 py-3 focus:border-green-500 focus:ring-green-500"
                                    >

                                        <option value="">

                                            Pilih Jenis Sampah

                                        </option>

                                        @foreach($categories as $category)

                                            <option
                                                value="{{ $category->id }}"
                                            >

                                                {{ $category->name }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                                {{-- Berat --}}

                                <div>

                                    <label class="mb-2 block font-medium">

                                        Berat (Kg)

                                    </label>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0.1"
                                        :name="'weight[]'"
                                        x-model="item.weight"
                                        class="w-full rounded-xl border px-4 py-3"
                                        placeholder="0.00"
                                    >

                                </div>

                            </div>

                            <div class="mt-5 flex justify-end">

                                <button
                                    x-show="items.length>1"
                                    type="button"
                                    @click="remove(index)"
                                    class="rounded-xl bg-red-500 px-5 py-2 font-semibold text-white hover:bg-red-600"
                                >

                                    Hapus

                                </button>

                            </div>

                        </div>

                    </template>

                    <button
                        type="button"
                        @click="add()"
                        class="rounded-xl bg-green-600 px-5 py-3 font-semibold text-white hover:bg-green-700"
                    >

                        + Tambah Jenis Sampah

                    </button>

                    <div class="mt-8">

                        <label class="mb-2 block font-medium">

                            Keterangan

                        </label>

                        <textarea
                            name="note"
                            rows="4"
                            class="w-full rounded-xl border p-4"
                            placeholder="Tambahkan catatan jika diperlukan..."
                        >{{ old('note') }}</textarea>

                    </div>
                    {{-- Ringkasan Setoran --}}

                    <div class="mt-8 rounded-2xl border border-green-200 bg-green-50 p-5">

                        <div class="mb-4 flex items-center justify-between">

                            <h3 class="text-lg font-bold text-green-700">

                                Ringkasan Setoran

                            </h3>

                            <span
                                class="rounded-full bg-green-600 px-3 py-1 text-xs font-semibold text-white"
                                x-text="items.length + ' Jenis'"
                            ></span>

                        </div>

                        <div class="overflow-x-auto">

                            <table class="w-full text-sm">

                                <thead>

                                    <tr class="border-b">

                                        <th class="py-3 text-left">

                                            Jenis Sampah

                                        </th>

                                        <th class="py-3 text-center">

                                            Berat

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <template
                                        x-for="(item,index) in items"
                                        :key="'summary'+index"
                                    >

                                        <tr class="border-b last:border-none">

                                            <td class="py-3">

                                                <span
                                                    x-text="getCategoryName(item.category)"
                                                ></span>

                                            </td>

                                            <td class="py-3 text-center">

                                                <span
                                                    x-text="item.weight ? item.weight+' Kg' : '-'"
                                                ></span>

                                            </td>

                                        </tr>

                                    </template>

                                </tbody>

                            </table>

                        </div>

                    </div>

                    {{-- Tombol --}}

                    <div class="mt-8 flex flex-wrap gap-4">

                        <button
                            type="submit"
                            class="inline-flex items-center rounded-xl bg-green-600 px-8 py-3 font-semibold text-white transition hover:bg-green-700"
                        >

                            Lanjutkan

                            <svg
                                class="ml-2 h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 5l7 7-7 7"
                                />

                            </svg>

                        </button>

                        <button
                            type="reset"
                            class="rounded-xl border border-gray-300 px-8 py-3 font-semibold text-gray-700 hover:bg-gray-100"
                        >

                            Reset

                        </button>

                    </div>

                </div>

            </form>

        </div>

        {{-- SIDEBAR --}}

        <div class="space-y-6">

            {{-- Harga Sampah --}}

            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <h2 class="mb-5 text-lg font-bold">

                    Daftar Harga Sampah

                </h2>

                <div class="space-y-3">

                    @foreach($categories as $category)

                        <div class="flex items-center justify-between rounded-xl border p-3">

                            <div class="font-medium">

                                {{ $category->name }}

                            </div>

                            <div class="font-semibold text-green-600">

                                Rp
                                {{ number_format(optional($category->activePrice)->price_per_kg ?? 0,0,',','.') }}
                                /Kg

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

            {{-- Tips --}}

            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <h2 class="mb-5 text-lg font-bold">

                    Tips Memilah Sampah

                </h2>

                <div class="space-y-5">

                    <div>

                        <h4 class="font-semibold text-green-600">

                            Pisahkan Sampah

                        </h4>

                        <p class="mt-1 text-sm text-slate-500">

                            Pisahkan berdasarkan jenis sebelum disetor.

                        </p>

                    </div>

                    <div>

                        <h4 class="font-semibold text-green-600">

                            Bersihkan Sampah

                        </h4>

                        <p class="mt-1 text-sm text-slate-500">

                            Pastikan sampah bersih dan tidak bercampur.

                        </p>

                    </div>

                    <div>

                        <h4 class="font-semibold text-green-600">

                            Timbang Terlebih Dahulu

                        </h4>

                        <p class="mt-1 text-sm text-slate-500">

                            Berat yang akurat akan mempermudah proses penilaian.

                        </p>

                    </div>

                </div>

            </div>
    <!-- Riwayat Setoran -->

    <div class="rounded-2xl bg-white shadow-sm">

        <div class="flex items-center justify-between border-b px-6 py-5">

            <div>

                <h2 class="text-lg font-bold text-slate-800">

                    Riwayat Setoran Terakhir

                </h2>

                <p class="mt-1 text-sm text-slate-500">

                    Menampilkan 5 transaksi terakhir Anda.

                </p>

            </div>

            <a
                href="{{ route('my-deposits.index') }}"
                class="font-semibold text-green-600 hover:text-green-700"
            >

                Lihat Semua →

            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">

                            Tanggal

                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">

                            Total Berat

                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">

                            Total

                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase text-slate-500">

                            Status

                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($latestDeposits as $deposit)

                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4">

                                {{ $deposit->created_at->format('d M Y') }}

                            </td>

                            <td class="px-6 py-4 font-semibold">

                                {{ number_format($deposit->total_weight,2) }} Kg

                            </td>

                            <td class="px-6 py-4 font-semibold text-green-600">

                                Rp {{ number_format($deposit->total_amount,0,',','.') }}

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

                            <td
                                colspan="4"
                                class="py-12 text-center text-slate-500"
                            >

                                Belum ada riwayat setoran.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
<script>

function depositForm(){

    return{

        categories: @json(
            $categories->map(function($category){

                return[
                    'id'=>$category->id,
                    'name'=>$category->name,
                ];

            })
        ),

        items:[
            {
                category:'',
                weight:''
            }
        ],

        add(){

            this.items.push({

                category:'',
                weight:''

            });

        },

        remove(index){

            if(this.items.length==1){

                return;

            }

            this.items.splice(index,1);

        },

        getCategoryName(id){

            const category=this.categories.find(c=>c.id==id);

            return category ? category.name : '-';

        }

    }

}

</script>

</div>

@endsection
