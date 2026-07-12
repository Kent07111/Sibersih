@extends('guest.layouts.guest')

@section('title','SIBERSIH')

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
                    href="#edukasi"
                    class="rounded-xl bg-white px-8 py-4 font-semibold text-green-700 transition hover:scale-105"
                >

                    📚 Jelajahi Edukasi

                </a>

                <a
                    href="#lapor"
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

                Tentang Kami

            </span>

            <h2
                class="mt-6 text-4xl font-bold text-slate-800"
            >

                Bersama Menjaga Lingkungan Lebih Bersih

            </h2>

            <p
                class="mt-6 leading-8 text-slate-600"
            >

                <strong>SIBERSIH</strong> merupakan Sistem Informasi Bank Sampah
                yang membantu masyarakat memperoleh informasi mengenai
                pengelolaan sampah, menemukan lokasi titik sampah,
                mengikuti kegiatan lingkungan,
                serta melaporkan permasalahan sampah secara cepat.

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

<section
    id="peta"
    class="bg-slate-100 py-24"
>

    <div
        class="mx-auto max-w-7xl px-6"
    >

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

            <h2
                class="mt-6 text-4xl font-bold text-slate-800"
            >

                Sebaran Titik Sampah

            </h2>

            <p
                class="mt-5 leading-8 text-slate-600"
            >

                Temukan lokasi Bank Sampah,
                TPS,
                maupun tempat pengelolaan sampah
                yang tersedia di wilayah Anda.

            </p>

        </div>

        {{-- Statistik kecil --}}

        <div
            class="mt-12 grid gap-6 md:grid-cols-3"
        >

            <div
                class="rounded-2xl bg-white p-6 shadow"
            >

                <div class="text-3xl">

                    📍

                </div>

                <h3
                    class="mt-3 text-3xl font-bold text-green-600"
                >

                    {{ $wastePoints->count() }}

                </h3>

                <p
                    class="mt-2 text-slate-500"
                >

                    Total Titik Sampah

                </p>

            </div>

            <div
                class="rounded-2xl bg-white p-6 shadow"
            >

                <div class="text-3xl">

                    ♻️

                </div>

                <h3
                    class="mt-3 text-3xl font-bold text-blue-600"
                >

                    {{ $wastePoints->where('status','Aktif')->count() }}

                </h3>

                <p
                    class="mt-2 text-slate-500"
                >

                    Titik Aktif

                </p>

            </div>

            <div
                class="rounded-2xl bg-white p-6 shadow"
            >

                <div class="text-3xl">

                    🌱

                </div>

                <h3
                    class="mt-3 text-3xl font-bold text-yellow-500"
                >

                    {{ $wastePoints->pluck('jenis')->unique()->count() }}

                </h3>

                <p
                    class="mt-2 text-slate-500"
                >

                    Jenis Titik

                </p>

            </div>

        </div>

        {{-- MAP --}}

        <div
            class="mt-12 overflow-hidden rounded-3xl bg-white shadow-xl"
            data-aos="zoom-in"
        >

            <div
                id="landingMap"
                class="h-[650px]"
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
                                href="#"
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
                href="#"
                class="inline-flex items-center rounded-xl bg-green-600 px-8 py-4 font-semibold text-white transition hover:bg-green-700"
            >

                Lihat Semua Edukasi

            </a>

        </div>

    </div>

</section>









@push('scripts')

<script>

const wastePoints=@json($wastePoints);

const map=L.map("landingMap").setView(

    [-6.3235,107.3375],

    13

);

L.tileLayer(

'https://tile.openstreetmap.org/{z}/{x}/{y}.png',

{

attribution:'© OpenStreetMap'

}

).addTo(map);

const greenIcon=new L.Icon({

iconUrl:'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',

shadowUrl:'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',

iconSize:[25,41],

iconAnchor:[12,41],

popupAnchor:[1,-34],

shadowSize:[41,41]

});

let bounds=[];

wastePoints.forEach(function(item){

    bounds.push([

        item.latitude,

        item.longitude

    ]);

    let foto='';

    if(item.foto){

        foto=`
            <img
                src="/storage/${item.foto}"
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

    L.marker(

        [

            item.latitude,

            item.longitude

        ],

        {

            icon:greenIcon

        }

    )

    .addTo(map)

    .bindPopup(`

        ${foto}

        <h3 style="font-size:18px;font-weight:bold">

            ${item.nama}

        </h3>

        <hr>

        <p>

            <b>Jenis :</b>

            ${item.jenis}

        </p>

        <p>

            <b>Status :</b>

            ${item.status}

        </p>

        <p>

            ${item.alamat}

        </p>

        <br>

        <a
            href="https://www.google.com/maps?q=${item.latitude},${item.longitude}"
            target="_blank"
            style="
                display:block;
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

    `);

});

if(bounds.length){

    map.fitBounds(

        bounds,

        {

            padding:[40,40]

        }

    );

}

</script>


@endpush
