@extends('layouts.user
')

@section('title','Riwayat Setoran')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold">
                Riwayat Setoran
            </h1>

            <p class="text-slate-500">
                Daftar setoran sampah Anda.
            </p>

        </div>

        <a
            href="{{ route('my-deposits.create') }}"
            class="rounded-xl bg-green-600 px-5 py-3 text-white"
        >
            + Setor Sampah
        </a>

    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow">

        <table class="min-w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="p-4">Invoice</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Berat</th>
                    <th class="p-4">Point</th>
                    <th class="p-4">Status</th>

                </tr>

            </thead>

            <tbody>

            @forelse($deposits as $deposit)

                <tr class="border-t">

                    <td class="p-4">
                        {{ $deposit->invoice_number }}
                    </td>

                    <td class="p-4">
                        {{ $deposit->deposit_date->format('d M Y') }}
                    </td>

                    <td class="p-4">
                        {{ $deposit->total_weight }} Kg
                    </td>

                    <td class="p-4">
                        {{ $deposit->total_point }}
                    </td>

                    <td class="p-4">
                        {{ $deposit->status }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="5"
                        class="p-8 text-center"
                    >

                        Belum ada setoran.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{ $deposits->links() }}

</div>

@endsection
