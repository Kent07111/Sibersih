@extends('guest.layouts.guest')

@section('title','SIBERSIH')

@section('content')

<!-- ================= HERO ================= -->

<section class="relative overflow-hidden bg-[#f8faf8]">

    <!-- Blur Background -->

    <div class="absolute -left-52 top-32 h-96 w-96 rounded-full bg-green-200/40 blur-3xl"></div>

    <div class="absolute -right-60 bottom-0 h-[500px] w-[500px] rounded-full bg-green-100 blur-3xl"></div>
    <!-- HERO -->

    <div class="mx-auto max-w-7xl px-8 pt-44 pb-32">

        <div class="grid items-center gap-16 lg:grid-cols-2">

            <!-- LEFT -->

            <div>

                <img
                    src="{{ asset('images/leaf.png') }}"
                    class="mb-6 h-10">

                <h1
                    class="text-6xl font-black leading-tight text-gray-900">

                    Kelola Sampah,

                    <br>

                    Jaga Lingkungan,

                    <br>

                    <span class="text-green-600">

                        Raih Manfaat!

                    </span>

                </h1>

                <p
                    class="mt-8 max-w-xl text-xl leading-9 text-gray-600">

                    Setiap sampah yang kita kelola dengan baik adalah langkah
                    kecil untuk bumi yang lebih bersih dan masa depan yang
                    lebih baik.

                </p>

                <!-- Button -->

                <div class="mt-10 flex gap-5">

                    <a
                        href="{{ route('my-deposits.create') }}"
                        class="inline-flex items-center rounded-2xl bg-green-600 px-8 py-5 text-lg font-bold text-white shadow-xl transition hover:bg-green-700">

                        🌿 Setor Sampah Sekarang

                    </a>

                    <button
                        class="rounded-2xl border border-green-600 bg-white px-8 py-5 text-lg font-bold text-green-700">

                        🎁 Tukar Poin

                    </button>

                </div>

                <!-- User -->

                <div class="mt-10 flex items-center gap-5">

                    <div class="flex -space-x-4">

                        <img src="https://i.pravatar.cc/80?img=1"
                            class="h-14 w-14 rounded-full border-4 border-white">

                        <img src="https://i.pravatar.cc/80?img=2"
                            class="h-14 w-14 rounded-full border-4 border-white">

                        <img src="https://i.pravatar.cc/80?img=3"
                            class="h-14 w-14 rounded-full border-4 border-white">

                        <img src="https://i.pravatar.cc/80?img=4"
                            class="h-14 w-14 rounded-full border-4 border-white">

                    </div>

                    <div>

                        <h3 class="text-xl font-bold">

                            10.000+

                        </h3>

                        <p class="text-gray-500">

                            pengguna telah bergabung

                        </p>

                    </div>

                </div>

            </div>





            <!-- RIGHT -->

            <div class="relative">

                <div
                    class="overflow-hidden rounded-[45px] shadow-[0_30px_80px_rgba(0,0,0,.15)]">

                    <img
                        src="{{ asset('images/bank-sampah.jpg') }}"
                        class="h-[620px] w-full object-cover">

                </div>

                <!-- Floating Card -->

                <div
                    class="absolute bottom-6 left-1/2 w-[92%] -translate-x-1/2 rounded-[30px] bg-white shadow-2xl">

                    <div class="grid grid-cols-3 divide-x">

                        <div class="p-8 text-center">

                            <div
                                class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-xl bg-green-100">

                                ♻️

                            </div>

                            <p class="text-gray-500">

                                Total Setoran

                            </p>

                            <h2 class="mt-2 text-3xl font-black">

                                12.560 kg

                            </h2>

                        </div>

                        <div class="p-8 text-center">

                            <div
                                class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-xl bg-green-100">

                                👥

                            </div>

                            <p class="text-gray-500">

                                Pengguna Aktif

                            </p>

                            <h2 class="mt-2 text-3xl font-black">

                                10.000+

                            </h2>

                        </div>

                        <div class="p-8 text-center">

                            <div
                                class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-xl bg-green-100">

                                ⭐

                            </div>

                            <p class="text-gray-500">

                                Poin

                            </p>

                            <h2 class="mt-2 text-3xl font-black">

                                250.000+

                            </h2>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- ===================================================== -->
<!-- FEATURE -->
<!-- ===================================================== -->

<section class="relative -mt-20 z-20">

    <div class="mx-auto max-w-7xl px-8">

        <div
            class="overflow-hidden rounded-[30px] bg-white shadow-[0_20px_60px_rgba(0,0,0,.10)]">

            <div class="grid divide-y lg:grid-cols-4 lg:divide-x lg:divide-y-0">

                <!-- ITEM -->

                <div
                    class="group flex items-center gap-5 p-8 transition duration-300 hover:bg-green-50">

                    <div
                        class="flex h-20 w-20 items-center justify-center rounded-2xl bg-green-600 shadow-lg transition group-hover:scale-110">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            class="h-10 w-10 text-white">

                            <path d="M7 7h10M7 12h10M7 17h10"/>

                        </svg>

                    </div>

                    <div>

                        <h3
                            class="text-xl font-bold text-gray-900">

                            Setor Sampah

                        </h3>

                        <p
                            class="mt-2 leading-7 text-gray-500">

                            Setorkan sampah terpilah
                            dengan mudah dan praktis.

                        </p>

                    </div>

                </div>





                <!-- ITEM -->

                <div
                    class="group flex items-center gap-5 p-8 transition duration-300 hover:bg-green-50">

                    <div
                        class="flex h-20 w-20 items-center justify-center rounded-2xl bg-green-600 shadow-lg transition group-hover:scale-110">

                        ⭐

                    </div>

                    <div>

                        <h3
                            class="text-xl font-bold">

                            Kumpulkan Poin

                        </h3>

                        <p
                            class="mt-2 leading-7 text-gray-500">

                            Dapatkan poin setiap
                            kali menyetor sampah.

                        </p>

                    </div>

                </div>





                <!-- ITEM -->

                <div
                    class="group flex items-center gap-5 p-8 transition duration-300 hover:bg-green-50">

                    <div
                        class="flex h-20 w-20 items-center justify-center rounded-2xl bg-green-600 text-4xl text-white shadow-lg transition group-hover:scale-110">

                        🎁

                    </div>

                    <div>

                        <h3
                            class="text-xl font-bold">

                            Tukar Poin

                        </h3>

                        <p
                            class="mt-2 leading-7 text-gray-500">

                            Tukarkan poin
                            dengan berbagai hadiah.

                        </p>

                    </div>

                </div>





                <!-- ITEM -->

                <div
                    class="group flex items-center gap-5 p-8 transition duration-300 hover:bg-green-50">

                    <div
                        class="flex h-20 w-20 items-center justify-center rounded-2xl bg-green-600 shadow-lg transition group-hover:scale-110">

                        📊

                    </div>

                    <div>

                        <h3
                            class="text-xl font-bold">

                            Pantau Aktivitas

                        </h3>

                        <p
                            class="mt-2 leading-7 text-gray-500">

                            Pantau seluruh
                            aktivitas penyetoran.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>





<!-- ===================================================== -->
<!-- CARA KERJA -->
<!-- ===================================================== -->

<section class="bg-white py-28">

    <div class="mx-auto max-w-7xl px-8">

        <div class="text-center">

            <h2
                class="text-5xl font-black text-gray-900">

                Cara Kerja

            </h2>

            <p
                class="mt-5 text-xl text-gray-500">

                4 langkah mudah untuk lingkungan yang lebih bersih

            </p>

        </div>





        <div
            class="relative mt-24">

            <!-- Garis -->

            <div
                class="absolute left-0 right-0 top-12 hidden border-t-2 border-dashed border-gray-300 lg:block">
            </div>

            <div
                class="grid gap-14 lg:grid-cols-4">

                <!-- STEP -->

                <div class="relative text-center">

                    <div
                        class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-green-100 text-5xl">

                        🗑️

                    </div>

                    <div
                        class="-mt-4 mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-green-600 text-white font-bold">

                        1

                    </div>

                    <h3
                        class="mt-8 text-2xl font-bold">

                        Pilah Sampah

                    </h3>

                    <p
                        class="mt-4 leading-8 text-gray-500">

                        Pilah sampah organik dan
                        anorganik dari rumah.

                    </p>

                </div>





                <!-- STEP -->

                <div class="relative text-center">

                    <div
                        class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-green-100 text-5xl">

                        🚚

                    </div>

                    <div
                        class="-mt-4 mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-green-600 text-white font-bold">

                        2

                    </div>

                    <h3
                        class="mt-8 text-2xl font-bold">

                        Setor Sampah

                    </h3>

                    <p
                        class="mt-4 leading-8 text-gray-500">

                        Datang ke Bank Sampah
                        terdekat.

                    </p>

                </div>





                <!-- STEP -->

                <div class="relative text-center">

                    <div
                        class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-green-100 text-5xl">

                        ⭐

                    </div>

                    <div
                        class="-mt-4 mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-green-600 text-white font-bold">

                        3

                    </div>

                    <h3
                        class="mt-8 text-2xl font-bold">

                        Dapatkan Poin

                    </h3>

                    <p
                        class="mt-4 leading-8 text-gray-500">

                        Sampah ditimbang dan
                        poin otomatis masuk.

                    </p>

                </div>





                <!-- STEP -->

                <div class="relative text-center">

                    <div
                        class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-green-100 text-5xl">

                        🎁

                    </div>

                    <div
                        class="-mt-4 mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-green-600 text-white font-bold">

                        4

                    </div>

                    <h3
                        class="mt-8 text-2xl font-bold">

                        Tukar Hadiah

                    </h3>

                    <p
                        class="mt-4 leading-8 text-gray-500">

                        Tukarkan poin
                        menjadi hadiah.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- ===================================================== -->
<!-- TENTANG BANK SAMPAH -->
<!-- ===================================================== -->

<section class="bg-[#f8faf8] py-28">

    <div class="mx-auto max-w-7xl px-8">

        <div class="grid items-center gap-20 lg:grid-cols-2">

            <!-- IMAGE -->

            <div class="relative">

                <img
                    src="{{ asset('images/tentang-bank-sampah.jpg') }}"
                    class="w-full rounded-[40px] shadow-[0_25px_80px_rgba(0,0,0,.15)]">

                <!-- Floating Card -->

                <div
                    class="absolute -bottom-8 left-10 rounded-3xl bg-white p-8 shadow-2xl">

                    <div class="flex items-center gap-5">

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-2xl bg-green-100 text-3xl">

                            🌱

                        </div>

                        <div>

                            <h3
                                class="text-3xl font-black text-green-600">

                                5+

                            </h3>

                            <p class="text-gray-500">

                                Tahun Mengelola
                                Bank Sampah

                            </p>

                        </div>

                    </div>

                </div>

            </div>





            <!-- CONTENT -->

            <div>

                <span
                    class="rounded-full bg-green-100 px-5 py-2 font-semibold text-green-700">

                    Tentang Kami

                </span>

                <h2
                    class="mt-8 text-5xl font-black leading-tight">

                    Bersama Membangun
                    Lingkungan yang
                    Lebih Bersih

                </h2>

                <p
                    class="mt-8 text-xl leading-9 text-gray-600">

                    SIBERSIH merupakan sistem informasi Bank Sampah
                    yang membantu masyarakat dalam mengelola sampah
                    menjadi lebih mudah, praktis, transparan,
                    dan memberikan manfaat ekonomi.

                </p>





                <div class="mt-12 space-y-8">

                    <div class="flex gap-5">

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-2xl bg-green-100 text-3xl">

                            ♻️

                        </div>

                        <div>

                            <h3
                                class="text-2xl font-bold">

                                Ramah Lingkungan

                            </h3>

                            <p
                                class="mt-2 text-gray-500">

                                Mengurangi jumlah sampah yang
                                dibuang ke TPA.

                            </p>

                        </div>

                    </div>





                    <div class="flex gap-5">

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-2xl bg-green-100 text-3xl">

                            ⭐

                        </div>

                        <div>

                            <h3
                                class="text-2xl font-bold">

                                Mendapatkan Poin

                            </h3>

                            <p
                                class="mt-2 text-gray-500">

                                Setiap kilogram sampah
                                memiliki nilai ekonomi.

                            </p>

                        </div>

                    </div>





                    <div class="flex gap-5">

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-2xl bg-green-100 text-3xl">

                            📱

                        </div>

                        <div>

                            <h3
                                class="text-2xl font-bold">

                                Sistem Digital

                            </h3>

                            <p
                                class="mt-2 text-gray-500">

                                Seluruh transaksi tercatat
                                secara otomatis.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>





<!-- ===================================================== -->
<!-- STATISTIK -->
<!-- ===================================================== -->

<section class="py-24">

    <div class="mx-auto max-w-7xl px-8">

        <div
            class="overflow-hidden rounded-[40px] bg-gradient-to-r from-green-600 to-emerald-500 px-12 py-16 text-white shadow-2xl">

            <div class="text-center">

                <h2
                    class="text-5xl font-black">

                    Dampak yang Telah Dicapai

                </h2>

                <p
                    class="mt-5 text-xl text-green-100">

                    Bersama masyarakat menciptakan lingkungan yang lebih bersih.

                </p>

            </div>





            <div
                class="mt-20 grid gap-10 md:grid-cols-2 lg:grid-cols-4">

                <div class="text-center">

                    <h3 class="text-6xl font-black">

                        10K+

                    </h3>

                    <p class="mt-3 text-lg">

                        Pengguna Aktif

                    </p>

                </div>





                <div class="text-center">

                    <h3 class="text-6xl font-black">

                        12 Ton

                    </h3>

                    <p class="mt-3 text-lg">

                        Sampah Terkumpul

                    </p>

                </div>





                <div class="text-center">

                    <h3 class="text-6xl font-black">

                        250K

                    </h3>

                    <p class="mt-3 text-lg">

                        Total Poin

                    </p>

                </div>





                <div class="text-center">

                    <h3 class="text-6xl font-black">

                        150+

                    </h3>

                    <p class="mt-3 text-lg">

                        Mitra Bank Sampah

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>




<!-- ===================================================== -->
<!-- CTA -->
<!-- ===================================================== -->

<section class="pb-28">

    <div class="mx-auto max-w-7xl px-8">

        <div
            class="overflow-hidden rounded-[40px] bg-gradient-to-r from-green-600 to-green-500 p-20 text-center text-white">

            <h2
                class="text-5xl font-black">

                Siap Menjadi Bagian
                dari Perubahan?

            </h2>

            <p
                class="mx-auto mt-6 max-w-3xl text-xl text-green-100">

                Bergabung bersama ribuan masyarakat
                yang telah peduli terhadap lingkungan.

            </p>

            <div
                class="mt-10 flex flex-wrap justify-center gap-5">

                <button
                    class="rounded-2xl bg-white px-8 py-4 font-bold text-green-700">

                    Daftar Sekarang

                </button>

                <button
                    class="rounded-2xl border border-white px-8 py-4 font-bold">

                    Pelajari Lagi

                </button>

            </div>

        </div>

    </div>

</section>










<!-- Back To Top -->

<button
    onclick="window.scrollTo({top:0,behavior:'smooth'})"
    class="fixed bottom-8 right-8 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-green-600 text-2xl text-white shadow-xl hover:bg-green-700">

    ↑

</button>

@endsection
