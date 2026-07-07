@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    {{-- Statistik --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">

        @php
            $cards = [
                [
                    'title' => 'Titik Sampah',
                    'value' => 0,
                    'color' => 'bg-green-100',
                    'icon' => '🗑️',
                ],
                [
                    'title' => 'Laporan',
                    'value' => 0,
                    'color' => 'bg-red-100',
                    'icon' => '📍',
                ],
                [
                    'title' => 'Edukasi',
                    'value' => 0,
                    'color' => 'bg-blue-100',
                    'icon' => '📚',
                ],
                [
                    'title' => 'Kegiatan',
                    'value' => 0,
                    'color' => 'bg-yellow-100',
                    'icon' => '📰',
                ],
            ];
        @endphp

        @foreach ($cards as $card)

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            {{ $card['title'] }}
                        </p>

                        <h2 class="mt-2 text-3xl font-bold text-slate-800">
                            {{ $card['value'] }}
                        </h2>

                    </div>

                    <div class="{{ $card['color'] }} rounded-xl p-4 text-3xl">
                        {{ $card['icon'] }}
                    </div>

                </div>

            </div>

        @endforeach

    </div>

    {{-- Content --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Leaflet --}}
        <div class="xl:col-span-2">

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 p-5">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Peta Sebaran Titik Sampah
                    </h2>

                </div>

                <div
                    id="map"
                    class="h-[550px] w-full rounded-b-2xl"
                ></div>

            </div>

        </div>

        {{-- Aktivitas --}}
        <div>

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 p-5">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Aktivitas Terbaru
                    </h2>

                </div>

                <div class="space-y-4 p-5">

                    <div class="rounded-xl border-l-4 border-green-500 bg-green-50 p-4">

                        Belum ada aktivitas.

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection
@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const map = L.map('map').setView([-6.305, 107.300], 13);

    L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(map);

    L.marker([-6.305, 107.300])
        .addTo(map)
        .bindPopup('TPS Sukaharja')
        .openPopup();

});

</script>

@endpush
