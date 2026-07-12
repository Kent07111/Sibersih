@extends('guest.layouts.guest')

@section('title','Jadwal')

@section('content')

<!-- HERO -->

<section
    class="relative overflow-hidden bg-gradient-to-r from-emerald-700 via-green-600 to-lime-500 pt-36 pb-40"
>

    <div class="absolute inset-0 opacity-10">

        <div class="absolute left-10 top-20 text-8xl">📅</div>

        <div class="absolute right-16 top-16 text-7xl">♻️</div>

        <div class="absolute bottom-12 left-1/3 text-8xl">🌿</div>

        <div class="absolute bottom-12 right-20 text-7xl">🌎</div>

    </div>

    <div
        class="relative mx-auto max-w-5xl px-6 text-center"
        data-aos="fade-up"
    >

        <span
            class="inline-flex rounded-full bg-white/20 px-5 py-2 text-sm font-semibold text-white backdrop-blur"
        >

            📅 Agenda Bank Sampah

        </span>

        <h1
            class="mt-8 text-5xl font-extrabold text-white lg:text-6xl"
        >

            Jadwal Kegiatan Kkn Talagasari 2026

        </h1>

        <p
            class="mx-auto mt-8 max-w-3xl text-xl leading-9 text-green-100"
        >

            Informasi jadwal kegiatan,
            sosialisasi,
            pengangkutan sampah,
            pelatihan,
            dan agenda lingkungan.

        </p>

    </div>

</section>

<!-- FILTER -->

<section
    class="relative z-20 -mt-24 pb-16"
>

    <div
        class="mx-auto max-w-7xl px-6"
    >

        <form
            method="GET"
            class="rounded-[30px] border border-slate-100 bg-white p-7 shadow-2xl"
        >

            <div
                class="grid gap-5 lg:grid-cols-12"
            >

                <div
                    class="lg:col-span-9"
                >

                    <select
                        name="status"
                        class="w-full rounded-2xl border p-5"
                    >

                        <option value="">

                            Semua Status

                        </option>

                        <option
                            value="Aktif"
                            @selected(request('status')=='Aktif')
                        >

                            Aktif

                        </option>

                        <option
                            value="Selesai"
                            @selected(request('status')=='Selesai')
                        >

                            Selesai

                        </option>

                    </select>

                </div>

                <div
                    class="lg:col-span-3"
                >

                    <button
                        class="w-full rounded-2xl bg-green-600 p-5 text-lg font-bold text-white hover:bg-green-700"
                    >

                        Filter

                    </button>

                </div>

            </div>

        </form>

    </div>

</section>

<!-- TIMELINE -->

<section
    class="pb-24"
>

    <div
        class="mx-auto max-w-5xl px-6"
    >

        <div
            class="mb-12"
        >

            <h2
                class="text-4xl font-bold text-slate-800"
            >

                Agenda Terjadwal

            </h2>

            <p
                class="mt-3 text-slate-500"
            >

                {{ $schedules->total() }} Jadwal

            </p>

        </div>

        <div
            class="relative border-l-4 border-green-500 pl-10"
        ></div>
@forelse($schedules as $schedule)

    <div
        class="relative mb-12"
        data-aos="fade-up"
    >

        {{-- Timeline Dot --}}

        <div
            class="absolute -left-[54px] top-5 flex h-8 w-8 items-center justify-center rounded-full bg-green-600 ring-8 ring-slate-50"
        >

            <i
                class="fa-solid fa-calendar-days text-sm text-white"
            ></i>

        </div>

        {{-- Card --}}

        <div
            class="rounded-3xl bg-white p-8 shadow-lg transition hover:shadow-xl"
        >

            <div
                class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
            >

                <div>

                    <span
                        class="rounded-full bg-green-100 px-4 py-2 text-xs font-semibold text-green-700"
                    >

                        {{ $schedule->hari }}

                    </span>

                    <h3
                        class="mt-5 text-2xl font-bold text-slate-800"
                    >

                        {{ $schedule->judul }}

                    </h3>

                </div>

                <span
                    class="rounded-full
                    {{ $schedule->status=='Aktif'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-slate-200 text-slate-700'
                    }}
                    px-5 py-2 text-sm font-semibold"
                >

                    {{ $schedule->status }}

                </span>

            </div>

            <div
                class="mt-6 grid gap-4 md:grid-cols-3"
            >

                <div>

                    <div
                        class="text-sm text-slate-500"
                    >

                        Tanggal

                    </div>

                    <div
                        class="mt-2 font-semibold"
                    >

                        {{ \Carbon\Carbon::parse($schedule->tanggal)->translatedFormat('d F Y') }}

                    </div>

                </div>

                <div>

                    <div
                        class="text-sm text-slate-500"
                    >

                        Jam

                    </div>

                    <div
                        class="mt-2 font-semibold"
                    >

                        {{ \Carbon\Carbon::parse($schedule->jam)->format('H:i') }} WIB

                    </div>

                </div>

                <div>

                    <div
                        class="text-sm text-slate-500"
                    >

                        Lokasi

                    </div>

                    <div
                        class="mt-2 font-semibold"
                    >

                        {{ $schedule->lokasi }}

                    </div>

                </div>

            </div>

            @if($schedule->keterangan)

                <div
                    class="mt-6 rounded-2xl bg-slate-50 p-5 leading-8 text-slate-600"
                >

                    {{ $schedule->keterangan }}

                </div>

            @endif

        </div>

    </div>

@empty

    <div
        class="flex min-h-[400px] items-center justify-center rounded-3xl bg-white shadow-lg"
    >

        <div class="text-center">

            <div
                class="text-8xl"
            >

                📅

            </div>

            <h3
                class="mt-8 text-3xl font-bold"
            >

                Belum Ada Jadwal

            </h3>

            <p
                class="mt-3 text-slate-500"
            >

                Jadwal kegiatan akan segera ditampilkan.

            </p>

        </div>

    </div>

@endforelse

</div>

@if($schedules->hasPages())

    <div
        class="mt-16 flex justify-center"
    >

        {{ $schedules->links() }}

    </div>

@endif

</div>

</section>

@endsection
