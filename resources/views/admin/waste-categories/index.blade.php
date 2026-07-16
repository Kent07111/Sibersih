@extends('layouts.admin')

@section('title','Kategori Sampah')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Kategori Sampah
            </h1>

            <p class="mt-2 text-slate-500">
                Kelola kategori sampah Bank Sampah.
            </p>

        </div>

        <a
            href="{{ route('waste-categories.create') }}"
            class="rounded-xl bg-green-600 px-5 py-3 font-semibold text-white hover:bg-green-700"
        >
            + Tambah
        </a>

    </div>

    {{-- Search --}}
    <form method="GET">

        <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Cari kategori..."
            class="w-full rounded-xl border p-3"
        >

    </form>

    {{-- Table --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow">

        <table class="min-w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="p-4 text-left">Kode</th>

                    <th class="p-4 text-left">Nama</th>

                    <th class="p-4 text-left">Status</th>
                    <th class="p-4">
                        Gambar
                    </th>

                    <th class="p-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                <tr class="border-t">

                    <td class="p-4">
                        {{ $category->code }}
                    </td>

                    <td class="p-4">
                        {{ $category->name }}
                    </td>

                    <td class="p-4">

                        @if($category->is_active)

                            <span class="rounded-full bg-green-100 px-3 py-1 text-sm text-green-700">
                                Aktif
                            </span>

                        @else

                            <span class="rounded-full bg-red-100 px-3 py-1 text-sm text-red-700">
                                Nonaktif
                            </span>

                        @endif

                    </td>
<td class="p-4">

    @if($category->image)

        <img
            src="{{ asset('storage/'.$category->image) }}"
            class="h-14 w-14 rounded-lg object-cover"
        >

    @else

        -

    @endif

</td>
                    <td class="p-4 text-center">

                        <div class="flex items-center justify-center gap-2">

                            <a
                                href="{{ route('waste-categories.edit',$category) }}"
                                class="rounded-lg bg-blue-500 px-3 py-2 text-sm text-white"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('waste-categories.destroy',$category) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    class="rounded-lg bg-red-500 px-3 py-2 text-sm text-white"
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
                        colspan="4"
                        class="p-8 text-center text-slate-500"
                    >
                        Belum ada data.
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{ $categories->links() }}

</div>

@endsection
