@extends('layouts.admin')

@section('title','Detail Setoran')

@section('content')

<div class="space-y-6">

    <div class="rounded-2xl bg-white p-6 shadow">

        <h1 class="text-3xl font-bold">

            Detail Setoran

        </h1>

        <div class="mt-6 grid grid-cols-2 gap-6">

            <div>

                <p><strong>Invoice</strong></p>

                {{ $deposit->invoice_number }}

            </div>

            <div>

                <p><strong>Nasabah</strong></p>

                {{ $deposit->user->name }}

            </div>

            <div>

                <p><strong>Tanggal</strong></p>

                {{ $deposit->deposit_date->format('d M Y') }}

            </div>

            <div>

                <p><strong>Status</strong></p>

                {{ $deposit->status }}

            </div>

        </div>

    </div>

    <div class="rounded-2xl bg-white shadow overflow-hidden">

        <table class="min-w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="p-4 text-left">Kategori</th>

                    <th class="p-4">Berat</th>

                    <th class="p-4">Harga/Kg</th>

                    <th class="p-4">Point/Kg</th>

                    <th class="p-4">Subtotal</th>

                    <th class="p-4">Point</th>

                </tr>

            </thead>

            <tbody>

            @foreach($deposit->details as $detail)

                <tr class="border-t">

                    <td class="p-4">

                        {{ $detail->category->name }}

                    </td>

                    <td class="p-4 text-center">

                        {{ $detail->weight }}

                    </td>

                    <td class="p-4 text-center">

                        Rp {{ number_format($detail->estimated_price,0,',','.') }}

                    </td>

                    <td class="p-4 text-center">

                        {{ $detail->estimated_point }}

                    </td>

                    <td class="p-4 text-center">

                        Rp {{ number_format($detail->estimated_subtotal_price,0,',','.') }}

                    </td>

                    <td class="p-4 text-center">

                        {{ $detail->estimated_subtotal_point }}

                    </td>

                </tr>

            @endforeach

            </tbody>

            <tfoot class="bg-slate-100">

                <tr>

                    <th colspan="4" class="p-4 text-right">

                        Total

                    </th>

                    <th class="p-4">

                        Rp {{ number_format($totalPrice,0,',','.') }}

                    </th>

                    <th class="p-4">

                        {{ $totalPoint }}

                    </th>

                </tr>

            </tfoot>

        </table>

    </div>

    @if($deposit->status == 'Menunggu')

    <div class="flex gap-3">

        <form
            action="{{ route('waste-deposits.approve',$deposit) }}"
            method="POST"
        >

            @csrf

            <button
                class="rounded-xl bg-green-600 px-6 py-3 text-white"
            >

                Approve

            </button>

        </form>

        <form
            action="{{ route('waste-deposits.reject',$deposit) }}"
            method="POST"
        >

            @csrf

            <button
                class="rounded-xl bg-red-600 px-6 py-3 text-white"
            >

                Tolak

            </button>

        </form>

    </div>

    @endif

</div>

@endsection
