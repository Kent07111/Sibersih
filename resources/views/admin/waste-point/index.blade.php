@extends('layouts.admin')

@section('title', 'Data Titik Sampah')

@section('content')

<div
    id="wastePointApp"
    x-data="{
        openCreate:false,
        openEdit:false
    }">

    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <button
            @click="openCreate=true"
            class="rounded-xl bg-green-600 px-5 py-3 font-semibold text-white transition hover:bg-green-700"
        >

            + Tambah Titik Sampah

        </button>

    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-2 gap-5 lg:grid-cols-4">

        <div class="rounded-2xl bg-white p-5 shadow">

            <p class="text-sm text-slate-500">

                Total Titik

            </p>

            <h2 class="mt-2 text-3xl font-bold">

                {{ $wastePoints->count() }}

            </h2>

        </div>

        <div class="rounded-2xl bg-white p-5 shadow">

            <p class="text-sm text-slate-500">

                Aktif

            </p>

            <h2 class="mt-2 text-3xl font-bold text-green-600">

                {{ $wastePoints->where('status','Aktif')->count() }}

            </h2>

        </div>

        <div class="rounded-2xl bg-white p-5 shadow">

            <p class="text-sm text-slate-500">

                Tidak Aktif

            </p>

            <h2 class="mt-2 text-3xl font-bold text-red-500">

                {{ $wastePoints->where('status','Tidak Aktif')->count() }}

            </h2>

        </div>

        <div class="rounded-2xl bg-white p-5 shadow">

            <p class="text-sm text-slate-500">

                TPS

            </p>

            <h2 class="mt-2 text-3xl font-bold text-blue-600">

                {{ $wastePoints->where('jenis','TPS')->count() }}

            </h2>

        </div>

    </div>

    {{-- MAP --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow">

        <div class="border-b p-5">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-xl font-semibold">

                        Peta Titik Sampah

                    </h2>

                    <p class="mt-1 text-sm text-slate-500">

                        Klik peta untuk menambah titik sampah.

                    </p>

                </div>

                <div class="flex gap-4 text-sm">

                    <div class="flex items-center gap-2">

                        <span class="h-4 w-4 rounded-full bg-blue-500"></span>

                        Existing

                    </div>

                    <div class="flex items-center gap-2">

                        <span class="h-4 w-4 rounded-full bg-red-500"></span>

                        Baru

                    </div>

                </div>

            </div>

        </div>

        <div
            id="map"
            class="h-[600px]"
        ></div>

    </div>

    {{-- TABLE --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow">

        <div class="border-b p-5">

            <h2 class="font-semibold">

                Daftar Titik Sampah

            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-5 py-4 text-left">
                            Kode
                        </th>

                        <th class="px-5 py-4 text-left">
                            Nama
                        </th>

                        <th class="px-5 py-4 text-left">
                            Jenis
                        </th>

                        <th class="px-5 py-4 text-left">
                            Status
                        </th>

                        <th class="px-5 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($wastePoints as $item)

                        <tr class="border-t">

                            <td class="px-5 py-4">

                                {{ $item->kode }}

                            </td>

                            <td class="px-5 py-4">

                                {{ $item->nama }}

                            </td>

                            <td class="px-5 py-4">

                                {{ $item->jenis }}

                            </td>

                            <td class="px-5 py-4">

                                @if($item->status=="Aktif")

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-green-700">

                                        Aktif

                                    </span>

                                @else

                                    <span class="rounded-full bg-red-100 px-3 py-1 text-red-700">

                                        Tidak Aktif

                                    </span>

                                @endif

                            </td>

                            <td class="px-5 py-4">

                                <div class="flex justify-center gap-2">

                                    <button

                                        class="editButton rounded-lg bg-yellow-500 px-4 py-2 text-white"

                                        data-id="{{ $item->id }}"

                                        data-nama="{{ $item->nama }}"

                                        data-jenis="{{ $item->jenis }}"

                                        data-alamat="{{ $item->alamat }}"

                                        data-deskripsi="{{ $item->deskripsi }}"

                                        data-status="{{ $item->status }}"

                                        data-lat="{{ $item->latitude }}"

                                        data-lng="{{ $item->longitude }}"

                                    >

                                        Edit

                                    </button>

                                    <form

                                        action="{{ route('waste-point.destroy',$item) }}"

                                        method="POST"

                                        onsubmit="return confirm('Yakin ingin menghapus titik sampah ini?')"

                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="rounded-lg bg-red-600 px-4 py-2 text-white"
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
                                colspan="5"
                                class="py-8 text-center text-slate-500"
                            >

                                Belum ada data.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
{{-- ===========================
MODAL EDIT
=========================== --}}

<div
    x-show="openEdit"
    x-transition
    x-cloak
    class="fixed inset-0 z-[99999] flex items-center justify-center bg-black/50 p-5"
>

    <div
        @click.outside="openEdit=false"
        @click.stop
        class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-2xl bg-white shadow-2xl"
    >

        {{-- Header --}}
        <div class="sticky top-0 z-10 flex items-center justify-between border-b bg-white p-5">

            <div>

                <h2 class="text-xl font-bold">
                    Edit Titik Sampah
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Perbarui data titik sampah.
                </p>

            </div>

            <button
                type="button"
                @click="openEdit=false"
                class="rounded-lg p-2 hover:bg-slate-100"
            >
                ✕
            </button>

        </div>

        {{-- Form --}}
        <form
            id="editForm"
            method="POST"
            enctype="multipart/form-data"
            @submit="openEdit=false"
        >

            @csrf
            @method('PUT')

            <div class="space-y-5 p-6">

                {{-- Nama --}}
                <div>

                    <label class="mb-2 block font-medium">
                        Nama Titik
                    </label>

                    <input
                        id="edit_nama"
                        type="text"
                        name="nama"
                        class="w-full rounded-xl border p-3"
                        required
                    >

                </div>

                {{-- Jenis --}}
                <div>

                    <label class="mb-2 block font-medium">
                        Jenis
                    </label>

                    <select
                        id="edit_jenis"
                        name="jenis"
                        class="w-full rounded-xl border p-3"
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
                        id="edit_alamat"
                        name="alamat"
                        rows="3"
                        class="w-full rounded-xl border p-3"
                    ></textarea>

                </div>

                {{-- Deskripsi --}}
                <div>

                    <label class="mb-2 block font-medium">
                        Deskripsi
                    </label>

                    <textarea
                        id="edit_deskripsi"
                        name="deskripsi"
                        rows="4"
                        class="w-full rounded-xl border p-3"
                    ></textarea>

                </div>

                {{-- Status --}}
                <div>

                    <label class="mb-2 block font-medium">
                        Status
                    </label>

                    <select
                        id="edit_status"
                        name="status"
                        class="w-full rounded-xl border p-3"
                    >

                        <option value="Aktif">
                            Aktif
                        </option>

                        <option value="Tidak Aktif">
                            Tidak Aktif
                        </option>

                    </select>

                </div>

                {{-- Foto --}}
                <div>

                    <label class="mb-2 block font-medium">
                        Ganti Foto
                    </label>

                    <input
                        id="edit_foto"
                        type="file"
                        name="foto"
                        accept="image/*"
                        class="w-full rounded-xl border p-3"
                    >

                </div>

                {{-- Preview Foto --}}
                <div>

                    <img
                        id="edit_preview"
                        class="hidden h-52 w-full rounded-xl object-cover"
                    >

                </div>

                {{-- Hidden Coordinate --}}
                <input
                    id="edit_latitude"
                    type="hidden"
                    name="latitude"
                >

                <input
                    id="edit_longitude"
                    type="hidden"
                    name="longitude"
                >

                {{-- Coordinate --}}
                <div class="grid grid-cols-2 gap-4">

                    <div>

                        <label class="mb-2 block text-sm">
                            Latitude
                        </label>

                        <input
                            id="edit_lat_view"
                            class="w-full rounded-xl border bg-slate-100 p-3"
                            readonly
                        >

                    </div>

                    <div>

                        <label class="mb-2 block text-sm">
                            Longitude
                        </label>

                        <input
                            id="edit_lng_view"
                            class="w-full rounded-xl border bg-slate-100 p-3"
                            readonly
                        >

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div class="sticky bottom-0 flex justify-end gap-3 border-t bg-white p-5">

                <button
                    type="button"
                    @click="openEdit=false"
                    class="rounded-xl border px-5 py-3 hover:bg-slate-100"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700"
                >
                    Update
                </button>

            </div>

        </form>

    </div>

</div>
    {{-- Modal Create --}}
    <div x-show="openCreate" x-on:openCreate.window="openCreate=true"
        x-transition
        x-cloak
        class="fixed inset-0 z-[99999] flex items-center justify-center bg-black/50 p-5">

        <div
            class="w-full max-w-2xl rounded-2xl bg-white shadow-2xl relative max-h-[90vh] overflow-y-auto"
            @click.stop
        >

            {{-- Header --}}
            <div class="flex items-center justify-between border-b p-5 sticky top-0 bg-white z-10">

                <div>

                    <h2 class="text-xl font-bold">

                        Tambah Titik Sampah

                    </h2>

                    <p class="mt-1 text-sm text-slate-500">

                        Klik lokasi pada peta terlebih dahulu.

                    </p>

                </div>

                <button
                    @click="openCreate=false"
                    class="rounded-lg p-2 hover:bg-slate-100"
                >

                    ✕

                </button>

            </div>

            {{-- Body --}}
            <form
                action="{{ route('waste-point.store') }}"
                method="POST"
                enctype="multipart/form-data"
                @submit="openCreate=false"
            >

                @csrf

                <div class="space-y-5 p-6">

                    {{-- Nama --}}
                    <div>

                        <label class="mb-2 block font-medium">

                            Nama Titik

                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="w-full rounded-xl border p-3"
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
                            class="w-full rounded-xl border p-3"
                        >

                            <option value="Organik">
                                Organik
                            </option>

                            <option value="Anorganik">
                                Anorganik
                            </option>

                            <option value="B3">
                                B3
                            </option>

                            <option value="TPS">
                                TPS
                            </option>

                            <option value="Lainnya">
                                Lainnya
                            </option>

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
                            class="w-full rounded-xl border p-3"
                        ></textarea>

                    </div>

                    {{-- Deskripsi --}}
                    <div>

                        <label class="mb-2 block font-medium">

                            Deskripsi

                        </label>

                        <textarea
                            name="deskripsi"
                            rows="4"
                            class="w-full rounded-xl border p-3"
                        ></textarea>

                    </div>

                    {{-- Foto --}}
                    <div>

                        <label class="mb-2 block font-medium">

                            Foto

                        </label>

                        <input
                            id="foto"
                            type="file"
                            name="foto"
                            accept="image/*"
                            class="w-full rounded-xl border p-3"
                        >

                    </div>

                    {{-- Preview --}}
                    <div>

                        <img
                            id="preview"
                            class="hidden h-52 w-full rounded-xl object-cover"
                        >

                    </div>

                    {{-- Hidden Coordinate --}}
                    <input
                        id="latitude"
                        name="latitude"
                        type="hidden"
                    >

                    <input
                        id="longitude"
                        name="longitude"
                        type="hidden"
                    >

                    {{-- Coordinate --}}
                    <div class="grid grid-cols-2 gap-4">

                        <div>

                            <label class="mb-2 block text-sm">

                                Latitude

                            </label>

                            <input
                                id="lat_view"
                                class="w-full rounded-xl border bg-slate-100 p-3"
                                readonly
                            >

                        </div>

                        <div>

                            <label class="mb-2 block text-sm">

                                Longitude

                            </label>

                            <input
                                id="lng_view"
                                class="w-full rounded-xl border bg-slate-100 p-3"
                                readonly
                            >

                        </div>

                    </div>

                </div>

                {{-- Footer --}}
                <div class="flex justify-end gap-3 border-t p-5 sticky bottom-0 bg-white">

                    <button
                        type="button"
                        @click="openCreate=false"
                        class="rounded-xl border px-5 py-3"
                    >

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white hover:bg-green-700"
                    >

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection
@push('scripts')

<script>
function wastePoint(){

    return{

        openCreate:false,

        openEdit:false

    }

}
let isEdit = false;
document.addEventListener("DOMContentLoaded", function () {

    // =====================================
    // DATA
    // =====================================

    const wastePoints = @json($wastePoints);

    // =====================================
    // ALPINE
    // =====================================


    // =====================================
    // MAP
    // =====================================

    const map = L.map("map").setView([-6.3235, 107.3375], 13);

    L.tileLayer(
        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        {
            attribution: "&copy; OpenStreetMap"
        }
    ).addTo(map);

    // =====================================
    // ICON
    // =====================================

    const blueIcon = new L.Icon({

        iconUrl:
            "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png",

        shadowUrl:
            "https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png",

        iconSize: [25, 41],

        iconAnchor: [12, 41],

        popupAnchor: [1, -34],

        shadowSize: [41, 41]

    });

    const redIcon = new L.Icon({

        iconUrl:
            "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png",

        shadowUrl:
            "https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png",

        iconSize: [25, 41],

        iconAnchor: [12, 41],

        popupAnchor: [1, -34],

        shadowSize: [41, 41]

    });

    // =====================================
    // MARKER
    // =====================================

    let createMarker = null;

    let editMarker = null;

    let bounds = [];

    // =====================================
    // LOAD EXISTING MARKER
    // =====================================

    wastePoints.forEach(function (item) {

        const marker = L.marker(
            [
                parseFloat(item.latitude),
                parseFloat(item.longitude)
            ],
            {
                icon: blueIcon
            }
        ).addTo(map);

        bounds.push([
            parseFloat(item.latitude),
            parseFloat(item.longitude)
        ]);

        let foto = "";

        if (item.foto) {

            foto = `
                <img
                    src="/storage/${item.foto}"
                    style="
                        width:220px;
                        height:130px;
                        object-fit:cover;
                        border-radius:10px;
                        margin-bottom:10px;
                    "
                >
            `;

        }

        marker.bindPopup(`

            ${foto}

            <h3 style="font-size:16px;font-weight:bold;margin-bottom:10px">

                ${item.nama}

            </h3>

            <table style="font-size:13px">

                <tr>

                    <td><b>Jenis</b></td>

                    <td>: ${item.jenis}</td>

                </tr>

                <tr>

                    <td><b>Status</b></td>

                    <td>: ${item.status}</td>

                </tr>

            </table>

            <hr>

            <small>

                ${item.alamat}

            </small>

        `);

    });

    if (bounds.length > 0) {

        map.fitBounds(bounds, {

            padding: [50, 50]

        });

    }

    // =====================================
    // PHOTO PREVIEW
    // =====================================

    document
        .getElementById("foto")
        .addEventListener("change", function (e) {

            const file = e.target.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function (ev) {

                const preview = document.getElementById("preview");

                preview.src = ev.target.result;

                preview.classList.remove("hidden");

            };

            reader.readAsDataURL(file);

        });

    // =====================================
    // EDIT BUTTON
    // =====================================

    document.querySelectorAll(".editButton").forEach(function (button) {

        button.addEventListener("click", function () {

            isEdit = true;

            const app = document.getElementById("wastePointApp");

            if (app && app._x_dataStack) {
                app._x_dataStack[0].openEdit = true;
            }
            document.getElementById("editForm").action =
                `/waste-point/${this.dataset.id}`;

            document.getElementById("edit_nama").value =
                this.dataset.nama;

            document.getElementById("edit_jenis").value =
                this.dataset.jenis;

            document.getElementById("edit_alamat").value =
                this.dataset.alamat;

            document.getElementById("edit_deskripsi").value =
                this.dataset.deskripsi;

            document.getElementById("edit_status").value =
                this.dataset.status;

            document.getElementById("edit_latitude").value =
                this.dataset.lat;

            document.getElementById("edit_longitude").value =
                this.dataset.lng;

            document.getElementById("edit_lat_view").value =
                this.dataset.lat;

            document.getElementById("edit_lng_view").value =
                this.dataset.lng;

            map.setView(

                [
                    parseFloat(this.dataset.lat),
                    parseFloat(this.dataset.lng)
                ],

                18

            );

            if (editMarker) {

                map.removeLayer(editMarker);

            }

            editMarker = L.marker(

                [
                    parseFloat(this.dataset.lat),
                    parseFloat(this.dataset.lng)
                ],

                {
                    icon: redIcon
                }

            ).addTo(map);

        });

    });
    // =====================================
    // MAP CLICK (CREATE & EDIT)
    // =====================================

    map.on("click", async function (e) {

        // =========================
        // MODE EDIT
        // =========================

        if (isEdit) {

            if (editMarker) {

                map.removeLayer(editMarker);

            }

            editMarker = L.marker(
                e.latlng,
                {
                    icon: redIcon
                }
            ).addTo(map);

            document.getElementById("edit_latitude").value = e.latlng.lat;
            document.getElementById("edit_longitude").value = e.latlng.lng;

            document.getElementById("edit_lat_view").value = e.latlng.lat;
            document.getElementById("edit_lng_view").value = e.latlng.lng;

            try {

                const response = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${e.latlng.lat}&lon=${e.latlng.lng}`
                );

                const result = await response.json();

                if (result.display_name) {

                    document.getElementById("edit_alamat").value =
                        result.display_name;

                }

            } catch (err) {

                console.log(err);

            }

            return;

        }

        // =========================
        // MODE CREATE
        // =========================

        if (createMarker) {

            map.removeLayer(createMarker);

        }

        createMarker = L.marker(
            e.latlng,
            {
                icon: redIcon
            }
        ).addTo(map);

        document.getElementById("latitude").value = e.latlng.lat;
        document.getElementById("longitude").value = e.latlng.lng;

        document.getElementById("lat_view").value = e.latlng.lat;
        document.getElementById("lng_view").value = e.latlng.lng;

        const app = document.getElementById("wastePointApp");

        if (app && app._x_dataStack) {
            app._x_dataStack[0].openCreate = true;
        }
        try {

            const response = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${e.latlng.lat}&lon=${e.latlng.lng}`
            );

            const result = await response.json();

            if (result.display_name) {

                document.getElementById("alamat").value =
                    result.display_name;

            }

        } catch (err) {

            console.log(err);

        }

    });

    // =====================================
    // RESET CREATE MODAL
    // =====================================

    document
        .querySelectorAll('[x-on\\:click*="openCreate=false"]')
        .forEach(function(btn){

            btn.addEventListener("click",function(){

                if(createMarker){

                    map.removeLayer(createMarker);

                    createMarker=null;

                }

                document.getElementById("latitude").value="";
                document.getElementById("longitude").value="";
                document.getElementById("lat_view").value="";
                document.getElementById("lng_view").value="";
                document.getElementById("alamat").value="";

            });

        });

    // =====================================
    // RESET EDIT MODAL
    // =====================================

    document
        .querySelectorAll('[x-on\\:click*="openEdit=false"]')
        .forEach(function(btn){

        btn.addEventListener("click", function () {

            isEdit = false;

            if (editMarker) {

                map.removeLayer(editMarker);

                editMarker = null;

            }

        });

        });

});

</script>

@endpush
@push('css')
<style>
/* Leaflet harus di bawah modal */
.leaflet-container {
    z-index: 1 !important;
}

.leaflet-pane,
.leaflet-top,
.leaflet-bottom,
.leaflet-control,
.leaflet-popup {
    z-index: 10 !important;
}

/* Modal harus paling atas */
.modal-overlay {
    z-index: 9999 !important;
}
</style>
@endpush
