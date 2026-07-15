@extends('guest.layouts.guest')

@section('title','Lapor Sampah')

@section('content')

<!-- HERO -->

<section
    class="relative overflow-hidden bg-gradient-to-r from-red-700 via-orange-600 to-yellow-500 pt-36 pb-40"
>

    <div
        class="absolute inset-0 opacity-10"
    >

        <div class="absolute left-10 top-16 text-8xl">🚮</div>

        <div class="absolute right-16 top-16 text-7xl">📍</div>

        <div class="absolute bottom-10 left-1/3 text-8xl">♻️</div>

        <div class="absolute bottom-12 right-24 text-7xl">🌱</div>

    </div>

    <div
        class="relative mx-auto max-w-5xl px-6 text-center"
    >

        <span
            class="rounded-full bg-white/20 px-5 py-2 text-sm font-semibold text-white backdrop-blur"
        >

            🚮 Pelaporan Sampah

        </span>

        <h1
            class="mt-8 text-5xl font-extrabold text-white"
        >

            Lapor Sampah

        </h1>

        <p
            class="mx-auto mt-8 max-w-3xl text-xl leading-9 text-orange-100"
        >

            Laporkan lokasi sampah liar agar petugas dapat segera melakukan penanganan.

        </p>

    </div>

</section>

<!-- FORM -->

<section
    class="relative z-20 -mt-24 pb-24"
>

    <div
        class="mx-auto max-w-7xl px-6"
    >

        <form
            action="{{ route('guest.report.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="rounded-[30px] bg-white p-8 shadow-2xl"
        >

            @csrf

            <div
                class="grid gap-8 lg:grid-cols-2"
            >

                {{-- Nama --}}

                <div>

                    <label
                        class="mb-2 block font-semibold"
                    >

                        Nama

                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        class="w-full rounded-xl border p-4"
                    >

                </div>

                {{-- Telepon --}}

                <div>

                    <label
                        class="mb-2 block font-semibold"
                    >

                        Nomor HP

                    </label>

                    <input
                        type="number"
                        name="telepon"
                        value="{{ old('telepon') }}"
                        class="w-full rounded-xl border p-4"
                    >

                </div>

                {{-- RT --}}

                <div>

                    <label
                        class="mb-2 block font-semibold"
                    >

                        RT

                    </label>

                    <input
                        type="number"
                        name="rt"
                        value="{{ old('rt') }}"
                        class="w-full rounded-xl border p-4"
                    >

                </div>

                {{-- RW --}}

                <div>

                    <label
                        class="mb-2 block font-semibold"
                    >

                        RW

                    </label>

                    <input
                        type="number"
                        name="rw"
                        value="{{ old('rw') }}"
                        class="w-full rounded-xl border p-4"
                    >

                </div>

                {{-- Titik Sampah Terdekat --}}

                <div class="lg:col-span-2">

                    <label
                        class="mb-2 block font-semibold"
                    >

                        Titik Sampah Terdekat (Opsional)

                    </label>

                    <select
                        name="waste_point_id"
                        class="w-full rounded-xl border p-4"
                    >

                        <option value="">

                            Pilih Titik Sampah

                        </option>

                        @foreach($wastePoints as $item)

                            <option
                                value="{{ $item->id }}"
                            >

                                {{ $item->nama }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Lokasi --}}

                <div
                    class="lg:col-span-2"
                >

                    <label
                        class="mb-2 block font-semibold"
                    >

                        Lokasi

                    </label>

                    <textarea
                        name="lokasi"
                        rows="3"
                        class="w-full rounded-xl border p-4"
                    >{{ old('lokasi') }}</textarea>

                </div>

            </div>
            {{-- MAP --}}

            <div class="mt-10">

                <h2
                    class="mb-5 text-2xl font-bold"
                >

                    📍 Lokasi Kejadian

                </h2>

                <div
                    id="reportMap"
                    class="h-[450px] w-full rounded-3xl border"
                ></div>

                <div
                    class="mt-5 flex flex-wrap gap-4"
                >

                    <button
                        type="button"
                        id="currentLocation"
                        class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700"
                    >

                        📍 Gunakan Lokasi Saya

                    </button>

                    <small
                        class="self-center text-slate-500"
                    >

                        Klik pada peta atau gunakan GPS.

                    </small>

                </div>

            </div>

            {{-- Latitude Longitude --}}

            <div
                class="mt-8 grid gap-8 lg:grid-cols-2"
            >

                <div>

                    <label
                        class="mb-2 block font-semibold"
                    >

                        Latitude

                    </label>

                    <input
                        type="text"
                        id="latitude"
                        name="latitude"
                        value="{{ old('latitude') }}"
                        readonly
                        class="w-full rounded-xl border bg-slate-100 p-4"
                    >

                </div>

                <div>

                    <label
                        class="mb-2 block font-semibold"
                    >

                        Longitude

                    </label>

                    <input
                        type="text"
                        id="longitude"
                        name="longitude"
                        value="{{ old('longitude') }}"
                        readonly
                        class="w-full rounded-xl border bg-slate-100 p-4"
                    >

                </div>

            </div>

            {{-- FOTO --}}

            <div
                class="mt-10"
            >

                <label
                    class="mb-2 block font-semibold"
                >

                    Foto Sampah

                </label>

                <input
                    type="file"
                    id="foto"
                    name="foto"
                    accept="image/*"
                    class="w-full rounded-xl border p-4"
                >

                <img
                    id="preview"
                    class="mt-6 hidden max-h-96 rounded-2xl border object-cover"
                >

            </div>

            {{-- DESKRIPSI --}}

            <div
                class="mt-10"
            >

                <label
                    class="mb-2 block font-semibold"
                >

                    Deskripsi

                </label>

                <textarea
                    name="deskripsi"
                    rows="5"
                    class="w-full rounded-xl border p-4"
                >{{ old('deskripsi') }}</textarea>

            </div>

            <div
                class="mt-10 text-center"
            >

                <button
                    class="rounded-2xl bg-red-600 px-10 py-4 text-lg font-bold text-white transition hover:bg-red-700"
                >

                    🚀 Kirim Laporan

                </button>

            </div>

        </form>

    </div>

</section>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/compressorjs@1.2.1/dist/compressor.min.js"></script>
<script>

let map = L.map('reportMap').setView([-6.3235,107.3375],13);

L.tileLayer(

    'https://tile.openstreetmap.org/{z}/{x}/{y}.png',

    {

        attribution:'© OpenStreetMap'

    }

).addTo(map);

let marker;

function setMarker(lat,lng){

    document.getElementById('latitude').value=lat;

    document.getElementById('longitude').value=lng;

    if(marker){

        marker.setLatLng([lat,lng]);

    }

    else{

        marker=L.marker([lat,lng],{

            draggable:true

        }).addTo(map);

        marker.on('dragend',function(e){

            let pos=e.target.getLatLng();

            document.getElementById('latitude').value=pos.lat;

            document.getElementById('longitude').value=pos.lng;

        });

    }

}

map.on('click',function(e){

    setMarker(

        e.latlng.lat,

        e.latlng.lng

    );

});

document.getElementById('currentLocation')

.addEventListener('click',function(){

    if(!navigator.geolocation){

        alert('Browser tidak mendukung GPS.');

        return;

    }

    navigator.geolocation.getCurrentPosition(

        function(position){

            let lat=position.coords.latitude;

            let lng=position.coords.longitude;

            map.setView([lat,lng],17);

            setMarker(lat,lng);

        },

        function(){

            alert('Lokasi tidak dapat diambil.');

        }

    );

});

const fotoInput = document.getElementById('foto');
const preview = document.getElementById('preview');

fotoInput.addEventListener('change', function (e) {

    const file = e.target.files[0];

    if (!file) return;

    new Compressor(file, {

        quality: 0.7,
        maxWidth: 1280,
        maxHeight: 1280,
        convertSize: 0,
        mimeType: 'image/jpeg',

        success(result) {

            const compressedFile = new File(
                [result],
                file.name.replace(/\.\w+$/, '.jpg'),
                {
                    type: 'image/jpeg',
                    lastModified: Date.now()
                }
            );

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(compressedFile);

            fotoInput.files = dataTransfer.files;

            const reader = new FileReader();

            reader.onload = function (event) {

                preview.src = event.target.result;
                preview.classList.remove('hidden');

            };

            reader.readAsDataURL(compressedFile);

            console.log(
                'Ukuran sebelum:',
                (file.size / 1024 / 1024).toFixed(2) + ' MB'
            );

            console.log(
                'Ukuran sesudah:',
                (compressedFile.size / 1024 / 1024).toFixed(2) + ' MB'
            );

        },

        error(err) {

            console.error(err);
            alert('Gagal mengompres gambar.');

        }

    });

});


</script>

@endpush

@endsection
