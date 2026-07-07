@extends('layouts.admin')

@section('title', 'Tambah Titik Sampah')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Tambah Titik Sampah
            </h1>

            <p class="mt-2 text-slate-500">
                Klik pada peta untuk menentukan lokasi titik sampah.
            </p>
        </div>

        <a
            href="{{ route('waste-point.index') }}"
            class="rounded-xl border border-slate-300 bg-white px-5 py-3 hover:bg-slate-100"
        >
            Kembali
        </a>

    </div>

    <form
        action="{{ route('waste-point.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

            {{-- MAP --}}
            <div class="xl:col-span-2">

                <div class="overflow-hidden rounded-2xl bg-white shadow">

                    <div class="border-b p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <h2 class="text-lg font-semibold">
                                    Peta Titik Sampah
                                </h2>

                                <p class="text-sm text-slate-500 mt-1">
                                    Marker biru = Titik Sampah yang sudah ada
                                    <br>
                                    Marker merah = Titik baru
                                </p>

                            </div>

                        </div>

                    </div>

                    <div
                        id="map"
                        class="h-[650px]"
                    ></div>

                </div>

            </div>

            {{-- FORM --}}
            <div>

                <div class="rounded-2xl bg-white shadow">

                    <div class="border-b p-5">

                        <h2 class="font-semibold">
                            Informasi Titik Sampah
                        </h2>

                    </div>

                    <div class="space-y-5 p-6">

                        {{-- Nama --}}
                        <div>

                            <label class="mb-2 block font-medium">
                                Nama Titik
                            </label>

                            <input
                                type="text"
                                name="nama"
                                value="{{ old('nama') }}"
                                class="w-full rounded-xl border border-slate-300 p-3 focus:border-green-500 focus:outline-none"
                                required
                            >

                        </div>

                        {{-- Jenis --}}
                        <div>

                            <label class="mb-2 block font-medium">
                                Jenis
                            </label>

                            <select
                                name="jenis"
                                class="w-full rounded-xl border border-slate-300 p-3"
                            >

                                <option value="Organik">Organik</option>
                                <option value="Anorganik">Anorganik</option>
                                <option value="B3">B3</option>
                                <option value="TPS">TPS</option>
                                <option value="Lainnya">Lainnya</option>

                            </select>

                        </div>

                        {{-- Alamat --}}
                        <div>

                            <label class="mb-2 block font-medium">
                                Alamat
                            </label>

                            <textarea
                                id="alamat"
                                name="alamat"
                                rows="3"
                                class="w-full rounded-xl border border-slate-300 p-3"
                            >{{ old('alamat') }}</textarea>

                        </div>

                        {{-- Deskripsi --}}
                        <div>

                            <label class="mb-2 block font-medium">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                rows="4"
                                class="w-full rounded-xl border border-slate-300 p-3"
                            >{{ old('deskripsi') }}</textarea>

                        </div>

                        {{-- Foto --}}
                        <div>

                            <label class="mb-2 block font-medium">
                                Foto
                            </label>

                            <input
                                type="file"
                                id="foto"
                                name="foto"
                                accept="image/*"
                                class="w-full rounded-xl border border-slate-300 p-3"
                            >

                        </div>

                        {{-- Preview --}}
                        <div>

                            <img
                                id="preview"
                                class="hidden h-48 w-full rounded-xl object-cover"
                            >

                        </div>

                        {{-- Hidden Coordinate --}}
                        <input
                            type="hidden"
                            id="latitude"
                            name="latitude"
                        >

                        <input
                            type="hidden"
                            id="longitude"
                            name="longitude"
                        >

                        {{-- Coordinate --}}
                        <div class="grid grid-cols-2 gap-4">

                            <div>

                                <label class="mb-2 block text-sm font-medium">
                                    Latitude
                                </label>

                                <input
                                    id="lat_view"
                                    class="w-full rounded-xl border bg-slate-100 p-3"
                                    readonly
                                >

                            </div>

                            <div>

                                <label class="mb-2 block text-sm font-medium">
                                    Longitude
                                </label>

                                <input
                                    id="lng_view"
                                    class="w-full rounded-xl border bg-slate-100 p-3"
                                    readonly
                                >

                            </div>

                        </div>

                        <button
                            type="submit"
                            class="w-full rounded-xl bg-green-600 py-3 font-semibold text-white transition hover:bg-green-700"
                        >
                            Simpan Titik Sampah
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection
@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    // ================================
    // Data Titik Sampah
    // ================================

    const wastePoints = @json($wastePoints);

    // ================================
    // Inisialisasi Map
    // ================================

    const map = L.map('map').setView([-6.4025, 107.4550], 13);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(map);

    // ================================
    // Icon Existing
    // ================================

    const blueIcon = new L.Icon({

        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',

        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',

        iconSize: [25, 41],

        iconAnchor: [12, 41],

        popupAnchor: [1, -34],

        shadowSize: [41, 41]

    });

    // ================================
    // Icon Marker Baru
    // ================================

    const redIcon = new L.Icon({

        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',

        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',

        iconSize: [25, 41],

        iconAnchor: [12, 41],

        popupAnchor: [1, -34],

        shadowSize: [41, 41]

    });

    // ================================
    // Marker Existing
    // ================================

    const group = [];

    wastePoints.forEach(function (item) {

        const marker = L.marker(
            [
                item.latitude,
                item.longitude
            ],
            {
                icon: blueIcon
            }
        ).addTo(map);

        let foto = '';

        if (item.foto) {

            foto = `
                <img
                    src="/storage/${item.foto}"
                    style="
                        width:220px;
                        height:120px;
                        object-fit:cover;
                        border-radius:8px;
                        margin-bottom:10px;
                    "
                >
            `;

        }

        marker.bindPopup(`
            ${foto}

            <strong>${item.nama}</strong>

            <br>

            ${item.jenis}

            <br>

            <small>${item.alamat}</small>
        `);

        group.push(marker);

    });

    // ================================
    // Zoom Semua Marker
    // ================================

    if (group.length > 0) {

        const featureGroup = new L.featureGroup(group);

        map.fitBounds(featureGroup.getBounds().pad(0.2));

    }

    // ================================
    // Marker Baru
    // ================================

    let marker = null;

    map.on('click', async function (e) {

        if (marker) {

            map.removeLayer(marker);

        }

        marker = L.marker(
            e.latlng,
            {
                icon: redIcon
            }
        ).addTo(map);

        document.getElementById('latitude').value = e.latlng.lat;

        document.getElementById('longitude').value = e.latlng.lng;

        document.getElementById('lat_view').value = e.latlng.lat;

        document.getElementById('lng_view').value = e.latlng.lng;

        // ============================
        // Reverse Geocoding
        // ============================

        try {

            const response = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${e.latlng.lat}&lon=${e.latlng.lng}`
            );

            const result = await response.json();

            if (result.display_name) {

                document.getElementById('alamat').value = result.display_name;

            }

        } catch (error) {

            console.log(error);

        }

    });

    // ================================
    // Preview Foto
    // ================================

    document
        .getElementById('foto')
        .addEventListener('change', function (e) {

            const file = e.target.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function (event) {

                const preview = document.getElementById('preview');

                preview.src = event.target.result;

                preview.classList.remove('hidden');

            };

            reader.readAsDataURL(file);

        });

});

</script>

@endpush
