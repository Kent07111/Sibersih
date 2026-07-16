@extends('layouts.admin')

@section('title','Harga Sampah')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Harga Sampah
            </h1>

            <p class="mt-2 text-slate-500">
                Kelola harga dan point setiap kategori sampah.
            </p>

        </div>

        <a
            href="{{ route('waste-prices.create') }}"
            class="rounded-xl bg-green-600 px-5 py-3 font-semibold text-white hover:bg-green-700"
        >
            + Tambah
        </a>

    </div>

    <form method="GET">

        <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Cari kategori..."
            class="w-full rounded-xl border p-3"
        >

    </form>

    <div class="overflow-hidden rounded-2xl bg-white shadow">

        <table class="min-w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="p-4">Kategori</th>

                    <th class="p-4">Harga / Kg</th>

                    <th class="p-4">Point / Kg</th>

                    <th class="p-4">Berlaku</th>

                    <th class="p-4">Status</th>

                    <th class="p-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($prices as $price)

                <tr class="border-t">

                    <td class="p-4">

                        {{ $price->category->name }}

                    </td>

                    <td class="p-4">

                        Rp {{ number_format($price->price_per_kg,0,',','.') }}

                    </td>

                    <td class="p-4">

                        {{ $price->point_per_kg }}

                    </td>

                    <td class="p-4">

                        {{ $price->effective_date->format('d M Y') }}

                    </td>

                    <td class="p-4">

                        @if($price->is_active)

                            <span class="rounded-full bg-green-100 px-3 py-1 text-green-700 text-sm">
                                Aktif
                            </span>

                        @else

                            <span class="rounded-full bg-red-100 px-3 py-1 text-red-700 text-sm">
                                Nonaktif
                            </span>

                        @endif

                    </td>

                    <td class="p-4 text-center">
<div class="flex justify-center gap-2">

    <a
        href="{{ route('waste-prices.edit',$price) }}"
        class="rounded-lg bg-blue-600 px-3 py-2 text-sm text-white"
    >
        Edit
    </a>

    <form
        action="{{ route('waste-prices.destroy',$price) }}"
        method="POST"
        onsubmit="return confirm('Hapus harga ini?')"
    >

        @csrf
        @method('DELETE')

        <button
            class="rounded-lg bg-red-600 px-3 py-2 text-sm text-white"
        >
            Hapus
        </button>

    </form>

</div>
                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="6"
                        class="p-8 text-center text-slate-500"
                    >

                        Belum ada data.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{ $prices->links() }}

</div>

@endsection
