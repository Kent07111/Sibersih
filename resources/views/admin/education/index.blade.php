@extends('layouts.admin')

@section('title', 'Data Edukasi')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <a
            href="{{ route('education.create') }}"
            class="inline-flex items-center rounded-xl bg-green-600 px-5 py-3 font-semibold text-white shadow hover:bg-green-700"
        >
            + Tambah Edukasi
        </a>

    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

        <div class="rounded-2xl bg-white p-6 shadow">

            <p class="text-slate-500">
                Total Artikel
            </p>

            <h2 class="mt-2 text-4xl font-bold">

                {{ $educations->count() }}

            </h2>

        </div>

        <div class="rounded-2xl bg-white p-6 shadow">

            <p class="text-slate-500">
                Publish
            </p>

            <h2 class="mt-2 text-4xl font-bold text-green-600">

                {{ $educations->where('status','Publish')->count() }}

            </h2>

        </div>

        <div class="rounded-2xl bg-white p-6 shadow">

            <p class="text-slate-500">
                Draft
            </p>

            <h2 class="mt-2 text-4xl font-bold text-orange-500">

                {{ $educations->where('status','Draft')->count() }}

            </h2>

        </div>

    </div>

    {{-- Filter --}}
    <form
        method="GET"
        class="rounded-2xl bg-white p-5 shadow"
    >

        <div class="grid gap-4 lg:grid-cols-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari judul..."
                class="rounded-xl border p-3"
            >

            <select
                name="kategori"
                class="rounded-xl border p-3"
            >

                <option value="">
                    Semua Kategori
                </option>

                @foreach([
                    'Organik',
                    'Anorganik',
                    'B3',
                    'Minyak Jelantah',
                    'Eco Enzyme',
                    'Kompos',
                    'Lainnya'
                ] as $item)

                    <option
                        value="{{ $item }}"
                        @selected(request('kategori')==$item)
                    >

                        {{ $item }}

                    </option>

                @endforeach

            </select>

            <select
                name="status"
                class="rounded-xl border p-3"
            >

                <option value="">
                    Semua Status
                </option>

                <option
                    value="Publish"
                    @selected(request('status')=="Publish")
                >

                    Publish

                </option>

                <option
                    value="Draft"
                    @selected(request('status')=="Draft")
                >

                    Draft

                </option>

            </select>

            <button
                class="rounded-xl bg-green-600 text-white"
            >

                Filter

            </button>

        </div>

    </form>
@if(request()->filled('search') || request()->filled('kategori') || request()->filled('status'))

<div>

    <a
        href="{{ route('education.index') }}"
        class="text-sm text-red-600 hover:underline"
    >

        Reset Filter

    </a>

</div>

@endif
    {{-- Card --}}
    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

        @forelse($educations as $education)

        <div class="overflow-hidden rounded-2xl bg-white shadow transition hover:-translate-y-1 hover:shadow-xl">

            {{-- Thumbnail --}}
            @if($education->thumbnail)

                <img
                    src="{{ asset('storage/'.$education->thumbnail) }}"
                    class="h-52 w-full object-cover"
                >

            @else

                <div class="flex h-52 items-center justify-center bg-slate-100">

                    <span class="text-6xl">
                        📚
                    </span>

                </div>

            @endif

            {{-- Body --}}
            <div class="space-y-4 p-5">

                <div>

                    <h2 class="line-clamp-2 text-lg font-bold">

                        {{ $education->judul }}

                    </h2>

                </div>

                <div class="flex flex-wrap gap-2">

                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                        {{ $education->kategori }}

                    </span>

                    @if($education->status=="Publish")

                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">

                            Publish

                        </span>

                    @else

                        <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">

                            Draft

                        </span>

                    @endif

                </div>

                <p class="line-clamp-3 text-sm text-slate-500">

                    {{ Str::limit(strip_tags($education->isi),120) }}

                </p>

                <div class="flex items-center justify-between text-sm text-slate-400">

                    <span>

                        {{ $education->created_at->format('d M Y') }}

                    </span>

                </div>

            </div>

            {{-- Footer --}}
            <div class="flex border-t">

                <a
                    href="{{ route('education.edit',$education) }}"
                    class="flex-1 py-3 text-center font-semibold text-blue-600 hover:bg-blue-50"
                >

                    Edit

                </a>

                <form
                    action="{{ route('education.destroy',$education) }}"
                    method="POST"
                    class="flex-1"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Hapus artikel?')"
                        class="w-full py-3 font-semibold text-red-600 hover:bg-red-50"
                    >

                        Hapus

                    </button>

                </form>

            </div>

        </div>

        @empty

        <div class="col-span-full rounded-2xl bg-white p-20 text-center shadow">

            <div class="text-7xl">

                📚

            </div>

            <h2 class="mt-5 text-2xl font-bold">

                Belum Ada Edukasi

            </h2>

            <p class="mt-2 text-slate-500">

                Silakan tambahkan artikel edukasi pertama.

            </p>

        </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    <div>

        {{ $educations->links() }}

    </div>

</div>

@endsection
