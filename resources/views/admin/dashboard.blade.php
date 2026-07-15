@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

@php
    use App\Models\WastePoint;
    use App\Models\Report;
    use App\Models\Education;
    use App\Models\Activity;


    $reports = Report::all();
    $wastePoints = WastePoint::all();
    $activities = Activity::latest()->take(5)->get();

    $cards = [
        [
            'title' => 'Titik Sampah',
            'value' => WastePoint::count(),
            'color' => 'bg-green-100',
            'icon' => '🗑️',
        ],
        [
            'title' => 'Laporan',
            'value' => Report::count(),
            'color' => 'bg-red-100',
            'icon' => '📍',
        ],
        [
            'title' => 'Edukasi',
            'value' => Education::count(),
            'color' => 'bg-blue-100',
            'icon' => '📚',
        ],
        [
            'title' => 'Kegiatan',
            'value' => Activity::count(),
            'color' => 'bg-yellow-100',
            'icon' => '📰',
        ],
    ];
@endphp

<div class="space-y-8">

    {{-- Statistik --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">

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

        {{-- Peta --}}
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

                    @forelse($activities as $activity)

                        <div class="rounded-xl border-l-4 border-green-500 bg-green-50 p-4">

                            <h3 class="font-semibold text-slate-800">
                                {{ $activity->judul }}
                            </h3>

                            @if($activity->deskripsi)
                                <p class="mt-1 line-clamp-2 text-sm text-slate-500">
                                    {{ $activity->deskripsi }}
                                </p>
                            @endif

                            <div class="mt-2 text-xs text-slate-400">
                                {{ $activity->created_at->diffForHumans() }}
                            </div>

                        </div>

                    @empty

                        <div class="rounded-xl border-l-4 border-green-500 bg-green-50 p-4">

                            Belum ada aktivitas.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const map = L.map('map').setView([-6.305,107.300],13);

    L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom:19,
            attribution:'&copy; OpenStreetMap'
        }
    ).addTo(map);

    const points = @json($wastePoints);
    const reports = @json($reports);

    const bounds = [];

    const wasteIcon = new L.Icon({
        iconUrl:'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
        shadowUrl:'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        iconSize:[25,41],
        iconAnchor:[12,41],
        popupAnchor:[1,-34],
        shadowSize:[41,41]
    });

    const reportIcon = new L.Icon({
        iconUrl:'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
        shadowUrl:'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        iconSize:[25,41],
        iconAnchor:[12,41],
        popupAnchor:[1,-34],
        shadowSize:[41,41]
    });

    // =========================
    // TITIK SAMPAH
    // =========================
    points.forEach(function(point){

        if(point.latitude && point.longitude){

            const latlng = [
                parseFloat(point.latitude),
                parseFloat(point.longitude)
            ];

            bounds.push(latlng);

            L.marker(latlng,{
                icon:wasteIcon
            })
            .addTo(map)
            .bindPopup(`
                <div style="min-width:200px">
                    <strong>${point.nama}</strong><br>
                    <small>${point.alamat ?? '-'}</small>
                </div>
            `);

        }

    });

    // =========================
    // LAPORAN
    // =========================
    reports.forEach(function(report){

        if(report.latitude && report.longitude){

            const latlng = [
                parseFloat(report.latitude),
                parseFloat(report.longitude)
            ];

            bounds.push(latlng);

            L.marker(latlng,{
                icon:reportIcon
            })
            .addTo(map)
            .bindPopup(`
                <div style="width:260px">

                    <img
                        src="/storage/${report.foto}"
                        style="
                            width:100%;
                            height:160px;
                            object-fit:cover;
                            border-radius:10px;
                            margin-bottom:10px;
                        "
                        onerror="this.src='https://placehold.co/260x160?text=Tidak+Ada+Foto'"
                    >

                    <h4 style="margin-bottom:10px">
                        Laporan Sampah
                    </h4>

                    <table style="font-size:13px">

                        <tr>
                            <td><b>Pelapor</b></td>
                            <td>: ${report.nama}</td>
                        </tr>

                        <tr>
                            <td><b>Status</b></td>
                            <td>: ${report.status}</td>
                        </tr>

                        <tr>
                            <td><b>RT/RW</b></td>
                            <td>: ${report.rt}/${report.rw}</td>
                        </tr>

                    </table>

                    <hr>

                    <div style="font-size:13px">
                        ${report.deskripsi ?? '-'}
                    </div>

                </div>
            `);

        }

    });

    // =========================
    // AUTO ZOOM
    // =========================
    if(bounds.length > 0){

        map.fitBounds(bounds,{
            padding:[40,40]
        });

    }else{

        L.marker([-6.305,107.300])
            .addTo(map)
            .bindPopup('Belum ada data.');

    }

});
</script>

@endpush
