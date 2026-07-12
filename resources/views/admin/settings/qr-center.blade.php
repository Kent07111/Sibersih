@extends('layouts.admin')

@section('title','QR Center')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                QR Center

            </h1>

            <p class="mt-2 text-slate-500">

                Generate QR Code untuk seluruh halaman SIBERSIH.

            </p>

        </div>

    </div>

    <form
        action="{{ route('setting.generate-qr') }}"
        method="POST"
    >

        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ========================================= --}}
            {{-- LEFT --}}
            {{-- ========================================= --}}

            <div
                class="bg-white rounded-2xl shadow p-6 space-y-5"
            >

                <h2
                    class="text-xl font-bold"
                >

                    Generate QR

                </h2>

                <div>

                    <label
                        class="block mb-2 font-medium"
                    >

                        Jenis QR

                    </label>

                    <select
                        id="type"
                        name="type"
                        class="w-full rounded-xl border p-3"
                    >

                        <option value="landing">

                            Landing Page

                        </option>

                        <option value="education">

                            Edukasi

                        </option>

                        <option value="activity">

                            Kegiatan

                        </option>

                        <option value="waste-point">

                            Titik Sampah

                        </option>

                        <option value="custom">

                            Custom Link

                        </option>

                    </select>

                </div>

                {{-- ================================= --}}

                <div
                    id="educationBox"
                    class="hidden"
                >

                    <label
                        class="block mb-2 font-medium"
                    >

                        Pilih Edukasi

                    </label>

                    <select
                        name="education"
                        class="w-full rounded-xl border p-3"
                    >

                        @foreach($educations as $education)

                            <option
                                value="{{ $education->id }}"
                            >

                                {{ $education->judul }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- ================================= --}}

                <div
                    id="activityBox"
                    class="hidden"
                >

                    <label
                        class="block mb-2 font-medium"
                    >

                        Pilih Kegiatan

                    </label>

                    <select
                        name="activity"
                        class="w-full rounded-xl border p-3"
                    >

                        @foreach($activities as $activity)

                            <option
                                value="{{ $activity->id }}"
                            >

                                {{ $activity->judul }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- ================================= --}}

                <div
                    id="wasteBox"
                    class="hidden"
                >

                    <label
                        class="block mb-2 font-medium"
                    >

                        Pilih Titik Sampah

                    </label>

                    <select
                        name="waste_point"
                        class="w-full rounded-xl border p-3"
                    >

                        @foreach($wastePoints as $point)

                            <option
                                value="{{ $point->id }}"
                            >

                                {{ $point->nama }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- ================================= --}}

                <div
                    id="customBox"
                    class="hidden"
                >

                    <label
                        class="block mb-2 font-medium"
                    >

                        Custom URL

                    </label>

                    <input
                        type="url"
                        name="custom_url"
                        class="w-full rounded-xl border p-3"
                        placeholder="https://"
                    >

                </div>

                <button
                    class="w-full rounded-xl bg-green-600 py-3 text-white font-semibold hover:bg-green-700"
                >

                    Generate QR

                </button>

            </div>

            {{-- ========================================= --}}
            {{-- RIGHT --}}
            {{-- ========================================= --}}

            <div
                class="lg:col-span-2"
            >

                <div
                    class="bg-white rounded-2xl shadow p-8"
                >

                    <h2
                        class="text-2xl font-bold mb-6"
                    >

                        Preview QR Code

                    </h2>

                    @if($url)

                        <div
                            class="grid lg:grid-cols-2 gap-8"
                        >

                            {{-- QR --}}
                            <div
                                class="flex flex-col items-center justify-center border rounded-2xl p-8"
                            >

                                {!! QrCode::size(280)->generate($url) !!}

                                <p
                                    class="mt-5 text-center text-sm text-slate-500 break-all"
                                >

                                    {{ $url }}

                                </p>

                            </div>

                            {{-- Info --}}
                            <div
                                class="space-y-5"
                            >

                                <div>

                                    <label
                                        class="font-semibold"
                                    >

                                        URL

                                    </label>

                                    <input
                                        id="url"
                                        value="{{ $url }}"
                                        readonly
                                        class="mt-2 w-full rounded-xl border bg-slate-100 p-3"
                                    >

                                </div>

                                <button
                                    type="button"
                                    onclick="copyUrl()"
                                    class="w-full rounded-xl bg-blue-600 py-3 text-white"
                                >

                                    Copy Link

                                </button>
                                <a
                                    href="data:image/svg+xml;utf8,{!! urlencode(QrCode::format('svg')->size(300)->generate($url)) !!}"
                                    download="sibersih-qr.svg"
                                    class="block w-full rounded-xl bg-green-600 py-3 text-center font-semibold text-white hover:bg-green-700"
                                >

                                    Download SVG

                                </a>

                                <button
                                    type="button"
                                    onclick="printQR()"
                                    class="w-full rounded-xl bg-slate-800 py-3 text-white hover:bg-slate-900"
                                >

                                    Print QR

                                </button>

                            </div>

                        </div>

                        <hr class="my-10">

                        {{-- Kartu Cetak --}}

                        <div
                            id="printArea"
                            class="mx-auto max-w-sm rounded-2xl border bg-white p-8 text-center shadow"
                        >

                            @if(isset($settings) && $settings->logo)

                                <img
                                    src="{{ asset('storage/'.$settings->logo) }}"
                                    class="mx-auto mb-4 h-20"
                                >

                            @endif

                            <h2
                                class="text-2xl font-bold"
                            >

                                SIBERSIH

                            </h2>

                            <p
                                class="mb-6 text-slate-500"
                            >

                                Scan QR Code

                            </p>

                            <div
                                class="flex justify-center"
                            >

                                {!! QrCode::size(180)->generate($url) !!}

                            </div>

                            <p
                                class="mt-6 break-all text-xs text-slate-500"
                            >

                                {{ $url }}

                            </p>

                        </div>

                    @else

                        <div
                            class="flex h-[500px] items-center justify-center rounded-2xl border-2 border-dashed border-slate-300"
                        >

                            <div
                                class="text-center"
                            >

                                <div
                                    class="text-7xl"
                                >

                                    📱

                                </div>

                                <h2
                                    class="mt-5 text-2xl font-bold"
                                >

                                    Belum Ada QR

                                </h2>

                                <p
                                    class="mt-2 text-slate-500"
                                >

                                    Pilih jenis QR kemudian klik Generate.

                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script>

const type=document.getElementById("type");

const educationBox=document.getElementById("educationBox");

const activityBox=document.getElementById("activityBox");

const wasteBox=document.getElementById("wasteBox");

const customBox=document.getElementById("customBox");

function toggleBox(){

    educationBox.classList.add("hidden");

    activityBox.classList.add("hidden");

    wasteBox.classList.add("hidden");

    customBox.classList.add("hidden");

    switch(type.value){

        case "education":

            educationBox.classList.remove("hidden");

        break;

        case "activity":

            activityBox.classList.remove("hidden");

        break;

        case "waste-point":

            wasteBox.classList.remove("hidden");

        break;

        case "custom":

            customBox.classList.remove("hidden");

        break;

    }

}

toggleBox();

type.addEventListener("change",toggleBox);

function copyUrl(){

    navigator.clipboard.writeText(

        document.getElementById("url").value

    );

    alert("Link berhasil disalin.");

}

function printQR(){

    let print=document.getElementById("printArea").innerHTML;

    let w=window.open("");

    w.document.write(print);

    w.document.close();

    w.print();

}

</script>

@endpush
