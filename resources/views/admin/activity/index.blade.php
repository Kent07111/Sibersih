@extends('layouts.admin')

@section('title','Data Kegiatan')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Kegiatan
            </h1>

            <p class="mt-2 text-slate-500">
                Kelola seluruh kegiatan kebersihan desa.
            </p>

        </div>

        <a
            href="{{ route('activity.create') }}"
            class="rounded-xl bg-green-600 px-5 py-3 font-semibold text-white hover:bg-green-700"
        >

            + Tambah Kegiatan

        </a>

    </div>

    {{-- Statistik --}}
    <div class="grid gap-5 md:grid-cols-3">

        <div class="rounded-2xl bg-white p-6 shadow">

            <p class="text-slate-500">

                Total Kegiatan

            </p>

            <h2 class="mt-3 text-4xl font-bold">

                {{ $total }}

            </h2>

        </div>

        <div class="rounded-2xl bg-white p-6 shadow">

            <p class="text-slate-500">

                Publish

            </p>

            <h2 class="mt-3 text-4xl font-bold text-green-600">

                {{ $publish }}

            </h2>

        </div>

        <div class="rounded-2xl bg-white p-6 shadow">

            <p class="text-slate-500">

                Draft

            </p>

            <h2 class="mt-3 text-4xl font-bold text-orange-500">

                {{ $draft }}

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
                placeholder="Cari kegiatan..."
                class="rounded-xl border p-3"
            >

            <input
                type="text"
                name="kategori"
                value="{{ request('kategori') }}"
                placeholder="Kategori"
                class="rounded-xl border p-3"
            >

            <select
                name="status"
                class="rounded-xl border p-3"
            >

                <option value="">

                    Semua Status

                </option>

                <option
                    value="Publish"
                    @selected(request('status')=='Publish')
                >

                    Publish

                </option>

                <option
                    value="Draft"
                    @selected(request('status')=='Draft')
                >

                    Draft

                </option>

            </select>

            <button
                class="rounded-xl bg-slate-800 text-white"
            >

                Filter

            </button>

        </div>

    </form>

    {{-- Card --}}
    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

        @forelse($activities as $activity)

        <div class="overflow-hidden rounded-2xl bg-white shadow transition hover:-translate-y-1 hover:shadow-xl">

            {{-- Thumbnail --}}
            @if($activity->thumbnail)

                <img
                    src="{{ asset('storage/'.$activity->thumbnail) }}"
                    class="h-56 w-full object-cover"
                >

            @else

                <div class="flex h-56 items-center justify-center bg-slate-100">

                    <span class="text-6xl">

                        📸

                    </span>

                </div>

            @endif

            <div class="space-y-4 p-5">

                <h2 class="line-clamp-2 text-xl font-bold">

                    {{ $activity->judul }}

                </h2>

                <div class="space-y-2 text-sm text-slate-600">

                    <div>

                        📅

                        {{ $activity->tanggal->format('d M Y') }}

                    </div>

                    <div>

                        📍

                        {{ $activity->lokasi }}

                    </div>

                </div>

                <div class="flex flex-wrap gap-2">

                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                        {{ $activity->kategori }}

                    </span>

                    @if($activity->status=="Publish")

                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">

                            Publish

                        </span>

                    @else

                        <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">

                            Draft

                        </span>

                    @endif

                </div>

                <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3">

                    <span class="text-sm text-slate-500">

                        Dokumentasi

                    </span>

                    <span class="font-bold">

                        {{ $activity->images->count() }}

                        Foto

                    </span>

                </div>

            </div>

            <div class="flex border-t">

                <a
                    href="{{ route('activity.edit',$activity) }}"
                    class="flex-1 py-3 text-center font-semibold text-blue-600 hover:bg-blue-50"
                >

                    Edit

                </a>

                <form
                    action="{{ route('activity.destroy',$activity) }}"
                    method="POST"
                    class="flex-1"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Hapus kegiatan ini?')"
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

                📸

            </div>

            <h2 class="mt-5 text-2xl font-bold">

                Belum Ada Kegiatan

            </h2>

            <p class="mt-2 text-slate-500">

                Tambahkan kegiatan pertama.

            </p>

        </div>

        @endforelse

    </div>

    <div>

        {{ $activities->links() }}

    </div>

</div>

@endsection
