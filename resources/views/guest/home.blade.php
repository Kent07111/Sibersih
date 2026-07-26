@extends('guest.layouts.guest')

@section('title','Talagasari2026')

@section('content')

<!-- HERO -->

<section
    id="home"
    class="relative flex min-h-screen items-center overflow-hidden"
>

    <!-- Background -->

    <img
        src="{{ asset('images/hero.jpg') }}"
        class="absolute inset-0 h-full w-full object-cover"
    >

    <div
        class="absolute inset-0 bg-gradient-to-r from-green-900/90 via-green-800/75 to-green-700/50"
    ></div>

    <!-- Content -->

    <div
        class="relative mx-auto grid max-w-7xl items-center gap-12 px-6 py-32 lg:grid-cols-2"
    >

        <div
            data-aos="fade-right"
        >

            <span
                class="rounded-full bg-green-500/20 px-4 py-2 text-sm font-semibold text-green-200"
            >

                🌱 {{ $setting->name }}

            </span>

            <h1
                class="mt-6 text-5xl font-extrabold leading-tight text-white lg:text-6xl"
            >

                {{ $setting->nama_desa ?? 'Tidak ada data' }}

            </h1>

            <p
                class="mt-6 text-xl leading-9 text-green-100"
            >

                {{ $setting->tentang ?? 'Tidak ada data' }}

            </p>

            <div
                class="mt-10 flex flex-wrap gap-4"
            >

                <a
                    href="/edukasi"
                    class="rounded-xl bg-white px-8 py-4 font-semibold text-green-700 transition hover:scale-105"
                >

                    📚 Jelajahi Edukasi

                </a>

                <a
                    href="/lapor"
                    class="rounded-xl border border-white px-8 py-4 font-semibold text-white transition hover:bg-white hover:text-green-700"
                >

                    🚮 Lapor Sampah

                </a>

            </div>

        </div>

        <!-- Hero Image -->

        <div
            class="hidden lg:block"
            data-aos="fade-left"
        >

            <img
                src="{{ !empty($setting?->banner) ? asset('storage/'.$setting->banner) : asset('images/hero-illustration.png') }}"
                class="w-full"
                alt="Banner"
            >

        </div>

    </div>

    <!-- Wave -->

    <div
        class="absolute bottom-0 left-0 w-full"
    >

        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1440 320"
        >

            <path
                fill="#F8FAFC"
                d="M0,160L80,165.3C160,171,320,181,480,170.7C640,160,800,128,960,122.7C1120,117,1280,139,1360,149.3L1440,160L1440,320L0,320Z"
            ></path>

        </svg>

    </div>

</section>

<!-- STATISTIC -->

<section
    class="bg-slate-50 py-20"
>

    <div
        class="mx-auto grid max-w-7xl gap-8 px-6 md:grid-cols-2 lg:grid-cols-4"
    >

        <div
            class="rounded-2xl bg-white p-8 text-center shadow"
            data-aos="zoom-in"
        >

            <div
                class="text-5xl font-bold text-green-600"
            >

                {{ $wastePointCount }}

            </div>

            <p
                class="mt-3 text-slate-500"
            >

                Titik Sampah

            </p>

        </div>

        <div
            class="rounded-2xl bg-white p-8 text-center shadow"
            data-aos="zoom-in"
            data-aos-delay="100"
        >

            <div
                class="text-5xl font-bold text-blue-600"
            >

                {{ $educationCount }}

            </div>

            <p
                class="mt-3 text-slate-500"
            >

                Edukasi

            </p>

        </div>

        <div
            class="rounded-2xl bg-white p-8 text-center shadow"
            data-aos="zoom-in"
            data-aos-delay="200"
        >

            <div
                class="text-5xl font-bold text-yellow-500"
            >

                {{ $activityCount }}

            </div>

            <p
                class="mt-3 text-slate-500"
            >

                Kegiatan

            </p>

        </div>

        <div
            class="rounded-2xl bg-white p-8 text-center shadow"
            data-aos="zoom-in"
            data-aos-delay="300"
        >

            <div
                class="text-5xl font-bold text-red-500"
            >

                {{ $reportCount }}

            </div>

            <p
                class="mt-3 text-slate-500"
            >

                Laporan

            </p>

        </div>

    </div>

</section>

<!-- ABOUT -->

<section
    id="tentang"
    class="bg-white py-24"
>

    <div
        class="mx-auto grid max-w-7xl items-center gap-16 px-6 lg:grid-cols-2"
    >

        {{-- Gambar --}}

        <div
            data-aos="fade-right"
        >

            <img
                src="{{ !empty($setting?->hero_image) ? asset('storage/'.$setting->hero_image) : asset('images/about.png') }}"
                alt="Tentang SIBERSIH"
                class="w-full rounded-3xl shadow-2xl"
            />

        </div>

        {{-- Konten --}}

        <div
            data-aos="fade-left"
        >

            <span
                class="rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-700"
            >

                Sampahmu adalah Tanggung Jawabmu, Sampahku adalah Tanggung Jawabku!"

            </span>

            <h2
                class="mt-6 text-4xl font-bold text-slate-800"
            >

                Bersama Menjaga Lingkungan Lebih Bersih

            </h2>

            <p
                class="mt-6 leading-8 text-slate-600"
            >

                <strong>Warga Desa Talagasari</strong> , kini saatnya kita ambil bagian dalam menjaga bumi! 🌾✨ Telah hadir aplikasi Eco-Talagasari, wadah gotong-royong digital untuk mengelola limbah rumah tangga. Lewat aplikasi ini, kamu bisa belajar cara bikin kompos, menyetor sampah ke Bank Sampah terdekat, hingga melaporkan area yang kurang bersih. Yuk, unduh sekarang dan jadilah pahlawan lingkungan di desa kita!

            </p>

            <p
                class="mt-5 leading-8 text-slate-600"
            >

                Melalui sistem ini diharapkan kesadaran masyarakat
                terhadap kebersihan lingkungan semakin meningkat
                sehingga tercipta lingkungan yang sehat,
                nyaman,
                dan berkelanjutan.

            </p>

            <div
                class="mt-10 grid gap-5 md:grid-cols-2"
            >

                <div
                    class="rounded-2xl border border-green-100 bg-green-50 p-5"
                >

                    <div class="text-4xl">

                        ♻️

                    </div>

                    <h3
                        class="mt-3 text-lg font-bold"
                    >

                        Edukasi

                    </h3>

                    <p
                        class="mt-2 text-sm text-slate-600"
                    >

                        Belajar memilah sampah, membuat kompos,
                        Eco Enzyme, serta pengelolaan limbah rumah tangga.

                    </p>

                </div>

                <div
                    class="rounded-2xl border border-blue-100 bg-blue-50 p-5"
                >

                    <div class="text-4xl">

                        📍

                    </div>

                    <h3
                        class="mt-3 text-lg font-bold"
                    >

                        Titik Sampah

                    </h3>

                    <p
                        class="mt-2 text-sm text-slate-600"
                    >

                        Temukan lokasi TPS,
                        Bank Sampah,
                        dan tempat pengelolaan sampah terdekat.

                    </p>

                </div>

                <div
                    class="rounded-2xl border border-yellow-100 bg-yellow-50 p-5"
                >

                    <div class="text-4xl">

                        📅

                    </div>

                    <h3
                        class="mt-3 text-lg font-bold"
                    >

                        Kegiatan

                    </h3>

                    <p
                        class="mt-2 text-sm text-slate-600"
                    >

                        Ikuti agenda gotong royong,
                        pelatihan,
                        dan sosialisasi lingkungan.

                    </p>

                </div>

                <div
                    class="rounded-2xl border border-red-100 bg-red-50 p-5"
                >

                    <div class="text-4xl">

                        🚮

                    </div>

                    <h3
                        class="mt-3 text-lg font-bold"
                    >

                        Lapor Sampah

                    </h3>

                    <p
                        class="mt-2 text-sm text-slate-600"
                    >

                        Laporkan sampah liar
                        lengkap dengan foto
                        dan lokasi secara online.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- MAP -->

<!-- MAP -->

<section
    id="peta"
    class="bg-slate-100 py-24"
>
    <div class="mx-auto max-w-7xl px-6">

        {{-- Heading --}}
        <div
            class="mx-auto max-w-3xl text-center"
            data-aos="fade-up"
        >
            <span
                class="rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-700"
            >
                Peta Interaktif
            </span>

            <h2 class="mt-6 text-4xl font-bold text-slate-800">
                Sebaran Titik Sampah dan Laporan Warga
            </h2>

            <p class="mt-5 leading-8 text-slate-600">
                Temukan lokasi Bank Sampah, TPS, tempat pengelolaan
                sampah, serta titik laporan sampah yang dikirimkan warga.
            </p>
        </div>

        {{-- Statistik --}}
        <div class="mt-12 grid gap-6 md:grid-cols-3">

            {{-- Titik sampah --}}
            <div class="rounded-2xl bg-white p-6 shadow">
                <div class="text-3xl">
                    ♻️
                </div>

                <h3 class="mt-3 text-3xl font-bold text-green-600">
                    {{ $wastePoints->count() }}
                </h3>

                <p class="mt-2 text-slate-500">
                    Titik Tempat Sampah
                </p>
            </div>

            {{-- Laporan warga --}}
            <div class="rounded-2xl bg-white p-6 shadow">
                <div class="text-3xl">
                    📢
                </div>

                <h3 class="mt-3 text-3xl font-bold text-red-600">
                    {{ $reports->count() }}
                </h3>

                <p class="mt-2 text-slate-500">
                    Laporan Warga
                </p>
            </div>

            {{-- Total lokasi --}}
            <div class="rounded-2xl bg-white p-6 shadow">
                <div class="text-3xl">
                    📍
                </div>

                <h3 class="mt-3 text-3xl font-bold text-blue-600">
                    {{ $wastePoints->count() + $reports->count() }}
                </h3>

                <p class="mt-2 text-slate-500">
                    Total Lokasi pada Peta
                </p>
            </div>

        </div>

        {{-- Legenda --}}
        <div
            class="mt-8 flex flex-wrap items-center justify-center gap-4"
            data-aos="fade-up"
        >
            <div
                class="flex items-center gap-3 rounded-xl bg-white px-5 py-3 shadow"
            >
                <span class="h-4 w-4 rounded-full bg-green-500"></span>

                <span class="font-medium text-slate-700">
                    Titik Tempat Sampah
                </span>
            </div>

            <div
                class="flex items-center gap-3 rounded-xl bg-white px-5 py-3 shadow"
            >
                <span class="h-4 w-4 rounded-full bg-red-500"></span>

                <span class="font-medium text-slate-700">
                    Laporan Warga
                </span>
            </div>
        </div>

        {{-- Map --}}
        <div
            class="mt-8 overflow-hidden rounded-3xl bg-white shadow-xl"
            data-aos="zoom-in"
        >
            <div
                id="landingMap"
                class="h-[650px] w-full"
            ></div>
        </div>

    </div>
</section>


<!-- EDUCATION -->

<section
    id="edukasi"
    class="bg-white py-24"
>

    <div class="mx-auto max-w-7xl px-6">

        {{-- Heading --}}

        <div
            class="mx-auto max-w-3xl text-center"
            data-aos="fade-up"
        >

            <span
                class="rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-700"
            >

                Edukasi

            </span>

            <h2
                class="mt-6 text-4xl font-bold text-slate-800"
            >

                Belajar Mengelola Sampah

            </h2>

            <p
                class="mt-5 leading-8 text-slate-600"
            >

                Tingkatkan pengetahuan mengenai pengelolaan sampah,
                daur ulang, kompos, Eco Enzyme,
                hingga Bank Sampah melalui artikel edukasi.

            </p>

        </div>

        {{-- Card --}}

        <div
            class="mt-16 grid gap-8 md:grid-cols-2 xl:grid-cols-3"
        >

            @forelse($educations as $education)

                <article
                    data-aos="fade-up"
                    class="group overflow-hidden rounded-3xl bg-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl"
                >

                    {{-- Thumbnail --}}

                    <div class="overflow-hidden">

                        <img
                            src="{{ asset('storage/'.$education->thumbnail) }}"
                            class="h-60 w-full object-cover transition duration-500 group-hover:scale-110"
                        >

                    </div>

                    <div class="p-6">

                        {{-- Category --}}

                        <div
                            class="flex items-center justify-between"
                        >

                            <span
                                class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700"
                            >

                                {{ $education->kategori }}

                            </span>

                            <small
                                class="text-slate-400"
                            >

                                {{ $education->created_at->format('d M Y') }}

                            </small>

                        </div>

                        {{-- Title --}}

                        <h3
                            class="mt-5 line-clamp-2 text-2xl font-bold text-slate-800"
                        >

                            {{ $education->judul }}

                        </h3>

                        {{-- Teaser --}}

                        <p
                            class="mt-4 line-clamp-3 leading-7 text-slate-600"
                        >

                            {{ $education->slug }}

                        </p>

                        {{-- Footer --}}

                        <div
                            class="mt-8 flex items-center justify-between"
                        >
                            <a
                                href="{{ route('guest.education.show',$education) }}"
                                class="font-semibold text-green-600 transition hover:text-green-700"
                            >

                                Baca Selengkapnya →

                            </a>

                            @if($education->video_url)

                                <span
                                    class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-600"
                                >

                                    🎥 Video

                                </span>

                            @endif

                        </div>

                    </div>

                </article>

            @empty

                <div
                    class="col-span-full rounded-3xl bg-slate-50 p-20 text-center"
                >

                    <div
                        class="text-6xl"
                    >

                        📚

                    </div>

                    <h3
                        class="mt-6 text-2xl font-bold"
                    >

                        Belum Ada Edukasi

                    </h3>

                    <p
                        class="mt-3 text-slate-500"
                    >

                        Artikel edukasi akan segera ditambahkan.

                    </p>

                </div>

            @endforelse

        </div>

        {{-- Button --}}

        <div
            class="mt-16 text-center"
        >

            <a
                href="/edukasi"
                class="inline-flex items-center rounded-xl bg-green-600 px-8 py-4 font-semibold text-white transition hover:bg-green-700"
            >

                Lihat Semua Edukasi

            </a>

        </div>

    </div>

</section>









@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const wastePoints = @json($wastePoints);
    const reports = @json($reports);

    const mapElement = document.getElementById('landingMap');

    if (!mapElement) {
        return;
    }

    const map = L.map('landingMap').setView(
        [-6.3235, 107.3375],
        13
    );

    L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19
        }
    ).addTo(map);

    /*
    |--------------------------------------------------------------------------
    | Marker tempat sampah
    |--------------------------------------------------------------------------
    */

    const greenIcon = new L.Icon({
        iconUrl:
            'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',

        shadowUrl:
            'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',

        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    /*
    |--------------------------------------------------------------------------
    | Marker laporan warga
    |--------------------------------------------------------------------------
    */

    const redIcon = new L.Icon({
        iconUrl:
            'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',

        shadowUrl:
            'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',

        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    /*
    |--------------------------------------------------------------------------
    | Layer marker
    |--------------------------------------------------------------------------
    */

    const wastePointLayer = L.layerGroup().addTo(map);
    const reportLayer = L.layerGroup().addTo(map);

    const bounds = [];

    /*
    |--------------------------------------------------------------------------
    | Fungsi mengamankan teks
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {
        if (value === null || value === undefined) {
            return '-';
        }

        return String(value)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    /*
    |--------------------------------------------------------------------------
    | Warna status laporan
    |--------------------------------------------------------------------------
    */

    function reportStatusColor(status) {
        switch (status) {
            case 'Menunggu':
                return '#eab308';

            case 'Diproses':
                return '#2563eb';

            case 'Selesai':
                return '#16a34a';

            case 'Ditolak':
                return '#64748b';

            default:
                return '#64748b';
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilkan titik tempat sampah
    |--------------------------------------------------------------------------
    */

    wastePoints.forEach(function (item) {

        const latitude = Number(item.latitude);
        const longitude = Number(item.longitude);

        if (
            !Number.isFinite(latitude) ||
            !Number.isFinite(longitude)
        ) {
            return;
        }

        bounds.push([latitude, longitude]);

        let foto = '';

        if (item.foto) {
            foto = `
                <img
                    src="/storage/${encodeURI(item.foto)}"
                    alt="${escapeHtml(item.nama)}"
                    style="
                        width:260px;
                        height:150px;
                        object-fit:cover;
                        border-radius:10px;
                        margin-bottom:10px;
                    "
                >
            `;
        }

        const marker = L.marker(
            [latitude, longitude],
            {
                icon: greenIcon
            }
        );

        marker.bindPopup(`
            <div style="width:260px">

                ${foto}

                <div
                    style="
                        display:inline-block;
                        background:#dcfce7;
                        color:#15803d;
                        padding:5px 10px;
                        border-radius:999px;
                        font-size:12px;
                        font-weight:bold;
                        margin-bottom:8px;
                    "
                >
                    Titik Tempat Sampah
                </div>

                <h3
                    style="
                        margin:4px 0 8px;
                        font-size:18px;
                        font-weight:bold;
                        color:#1e293b;
                    "
                >
                    ${escapeHtml(item.nama)}
                </h3>

                <div
                    style="
                        border-top:1px solid #e2e8f0;
                        margin-bottom:10px;
                    "
                ></div>

                <p style="margin:5px 0">
                    <b>Kode:</b>
                    ${escapeHtml(item.kode)}
                </p>

                <p style="margin:5px 0">
                    <b>Jenis:</b>
                    ${escapeHtml(item.jenis)}
                </p>

                <p style="margin:5px 0">
                    <b>Status:</b>
                    ${escapeHtml(item.status)}
                </p>

                <p style="margin:5px 0">
                    <b>Alamat:</b><br>
                    ${escapeHtml(item.alamat)}
                </p>

                ${
                    item.deskripsi
                        ? `
                            <p style="margin:8px 0">
                                <b>Deskripsi:</b><br>
                                ${escapeHtml(item.deskripsi)}
                            </p>
                        `
                        : ''
                }

                <a
                    href="https://www.google.com/maps?q=${latitude},${longitude}"
                    target="_blank"
                    rel="noopener noreferrer"
                    style="
                        display:block;
                        margin-top:14px;
                        background:#16a34a;
                        color:white;
                        text-align:center;
                        padding:10px;
                        border-radius:8px;
                        text-decoration:none;
                        font-weight:bold;
                    "
                >
                    Petunjuk Arah
                </a>

            </div>
        `);

        marker.addTo(wastePointLayer);
    });

    /*
    |--------------------------------------------------------------------------
    | Tampilkan laporan warga
    |--------------------------------------------------------------------------
    */

    reports.forEach(function (item) {

        const latitude = Number(item.latitude);
        const longitude = Number(item.longitude);

        if (
            !Number.isFinite(latitude) ||
            !Number.isFinite(longitude)
        ) {
            return;
        }

        bounds.push([latitude, longitude]);

        let foto = '';

        if (item.foto) {
            foto = `
                <img
                    src="/storage/${encodeURI(item.foto)}"
                    alt="Foto laporan warga"
                    style="
                        width:260px;
                        height:150px;
                        object-fit:cover;
                        border-radius:10px;
                        margin-bottom:10px;
                    "
                >
            `;
        }

        const statusColor = reportStatusColor(item.status);

        const marker = L.marker(
            [latitude, longitude],
            {
                icon: redIcon
            }
        );

        marker.bindPopup(`
            <div style="width:260px">

                ${foto}

                <div
                    style="
                        display:inline-block;
                        background:#fee2e2;
                        color:#dc2626;
                        padding:5px 10px;
                        border-radius:999px;
                        font-size:12px;
                        font-weight:bold;
                        margin-bottom:8px;
                    "
                >
                    Laporan Warga
                </div>

                <h3
                    style="
                        margin:4px 0 8px;
                        font-size:18px;
                        font-weight:bold;
                        color:#1e293b;
                    "
                >
                    Laporan Sampah
                </h3>

                <div
                    style="
                        border-top:1px solid #e2e8f0;
                        margin-bottom:10px;
                    "
                ></div>

                <p style="margin:5px 0">
                    <b>Pelapor:</b>
                    ${escapeHtml(item.nama)}
                </p>

                <p style="margin:5px 0">
                    <b>Wilayah:</b>
                    RT ${escapeHtml(item.rt)}
                    /
                    RW ${escapeHtml(item.rw)}
                </p>

                <p style="margin:5px 0">
                    <b>Lokasi:</b><br>
                    ${escapeHtml(item.lokasi)}
                </p>

                <p style="margin:5px 0">
                    <b>Deskripsi:</b><br>
                    ${escapeHtml(item.deskripsi)}
                </p>

                <p style="margin:8px 0">
                    <b>Status:</b>

                    <span
                        style="
                            display:inline-block;
                            background:${statusColor};
                            color:white;
                            padding:3px 8px;
                            border-radius:999px;
                            font-size:12px;
                            font-weight:bold;
                        "
                    >
                        ${escapeHtml(item.status)}
                    </span>
                </p>

                <a
                    href="https://www.google.com/maps?q=${latitude},${longitude}"
                    target="_blank"
                    rel="noopener noreferrer"
                    style="
                        display:block;
                        margin-top:14px;
                        background:#dc2626;
                        color:white;
                        text-align:center;
                        padding:10px;
                        border-radius:8px;
                        text-decoration:none;
                        font-weight:bold;
                    "
                >
                    Lihat Lokasi
                </a>

            </div>
        `);

        marker.addTo(reportLayer);
    });

    /*
    |--------------------------------------------------------------------------
    | Kontrol layer
    |--------------------------------------------------------------------------
    */

    const overlayMaps = {
        '♻️ Titik Tempat Sampah': wastePointLayer,
        '📢 Laporan Warga': reportLayer
    };

    L.control.layers(
        null,
        overlayMaps,
        {
            collapsed: false,
            position: 'topright'
        }
    ).addTo(map);

    /*
    |--------------------------------------------------------------------------
    | Sesuaikan area peta berdasarkan seluruh marker
    |--------------------------------------------------------------------------
    */

    if (bounds.length > 0) {
        map.fitBounds(
            bounds,
            {
                padding: [40, 40],
                maxZoom: 16
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Memperbaiki ukuran peta setelah AOS/rendering
    |--------------------------------------------------------------------------
    */

    setTimeout(function () {
        map.invalidateSize();
    }, 300);

});
</script>

@endpush
