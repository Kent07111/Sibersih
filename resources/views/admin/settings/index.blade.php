@extends('layouts.admin')

@section('title','General Setting')

@section('content')

@if(session('success'))

<script>

Swal.fire({

    icon:'success',

    title:'Berhasil',

    text:'{{ session('success') }}',

    confirmButtonColor:'#16a34a'

});

</script>

@endif

<form
    action="{{ $setting ? route('settings.update',$setting) : route('settings.store') }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf

    @if($setting)

        @method('PUT')

    @endif

    <div class="grid gap-6 lg:grid-cols-3">

        {{-- LEFT --}}

        <div class="space-y-6 lg:col-span-2">

            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-xl font-bold text-slate-800">

                    Informasi Desa

                </h2>

                <div class="grid gap-5">

                    <div>

                        <label class="mb-2 block font-medium">

                            Nama Desa

                        </label>

                        <input
                            type="text"
                            name="nama_desa"
                            value="{{ old('nama_desa',$setting->nama_desa ?? '') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:outline-none"
                        >

                    </div>

                    <div>

                        <label class="mb-2 block font-medium">
                            Nama Website
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name',$setting->name ?? '') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:outline-none"
                        >

                    </div>
                    <div>

                        <label class="mb-2 block font-medium">

                            Alamat

                        </label>

                        <textarea
                            name="alamat"
                            rows="3"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:outline-none"
                        >{{ old('alamat',$setting->alamat ?? '') }}</textarea>

                    </div>

                    <div>

                        <label class="mb-2 block font-medium">

                            Tentang

                        </label>

                        <textarea
                            name="tentang"
                            rows="8"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:outline-none"
                        >{{ old('tentang',$setting->tentang ?? '') }}</textarea>

                    </div>

                </div>

            </div>
            {{-- Kontak --}}

            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-xl font-bold text-slate-800">

                    Kontak

                </h2>

                <div class="grid gap-5 md:grid-cols-2">

                    <div>

                        <label class="mb-2 block font-medium">

                            Nomor Telepon

                        </label>

                        <input
                            type="text"
                            name="telepon"
                            value="{{ old('telepon',$setting->telepon ?? '') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:outline-none"
                        >

                    </div>

                    <div>

                        <label class="mb-2 block font-medium">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email',$setting->email ?? '') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:outline-none"
                        >

                    </div>

                </div>

            </div>

            {{-- Sosial Media --}}

            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-xl font-bold text-slate-800">

                    Sosial Media

                </h2>

                <div class="grid gap-5">

                    <div>

                        <label class="mb-2 block font-medium">

                            Facebook

                        </label>

                        <input
                            type="text"
                            name="facebook"
                            value="{{ old('facebook',$setting->facebook ?? '') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:outline-none"
                        >

                    </div>

                    <div>

                        <label class="mb-2 block font-medium">

                            Instagram

                        </label>

                        <input
                            type="text"
                            name="instagram"
                            value="{{ old('instagram',$setting->instagram ?? '') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:outline-none"
                        >

                    </div>

                    <div>

                        <label class="mb-2 block font-medium">

                            YouTube

                        </label>

                        <input
                            type="text"
                            name="youtube"
                            value="{{ old('youtube',$setting->youtube ?? '') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:outline-none"
                        >

                    </div>

                </div>

            </div>

            {{-- Google Maps --}}

            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-xl font-bold text-slate-800">

                    Google Maps

                </h2>

                <textarea
                    name="maps_embed"
                    rows="6"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-green-500 focus:outline-none"
                >{{ old('maps_embed',$setting->maps_embed ?? '') }}</textarea>

                <p class="mt-2 text-sm text-slate-500">

                    Tempelkan kode <strong>iframe</strong> dari Google Maps.

                </p>

            </div>

        </div>

        {{-- RIGHT SIDE --}}

        {{-- RIGHT SIDE --}}

        <div class="space-y-6">

            {{-- Logo Website --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-xl font-bold text-slate-800">
                    Logo Website
                </h2>

                <div class="flex justify-center">
                    @if(!empty($setting?->logo))
                        <img
                            id="logoPreview"
                            src="{{ asset('storage/'.$setting->logo) }}"
                            class="h-40 w-40 rounded-2xl border object-contain"
                        >
                    @else
                        <img
                            id="logoPreview"
                            src="https://placehold.co/200x200?text=Logo"
                            class="h-40 w-40 rounded-2xl border object-contain"
                        >
                    @endif
                </div>

                <input
                    type="file"
                    id="logo"
                    name="logo"
                    accept="image/*,.heic,.heif"
                    class="mt-6 w-full rounded-xl border border-slate-300 p-3"
                >

            </div>

            {{-- Favicon --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-xl font-bold text-slate-800">
                    Favicon
                </h2>

                <div class="flex justify-center">

                    @if(!empty($setting?->favicon))
                        <img
                            id="faviconPreview"
                            src="{{ asset('storage/'.$setting->favicon) }}"
                            class="h-20 w-20 rounded-xl border object-contain"
                        >
                    @else
                        <img
                            id="faviconPreview"
                            src="https://placehold.co/80x80?text=Icon"
                            class="h-20 w-20 rounded-xl border object-contain"
                        >
                    @endif

                </div>

                <input
                    type="file"
                    id="favicon"
                    name="favicon"
                    class="mt-6 w-full rounded-xl border border-slate-300 p-3"
                >

            </div>

            {{-- Banner --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-xl font-bold text-slate-800">
                    Banner
                </h2>

                <div class="flex justify-center">

                    @if(!empty($setting?->banner))
                        <img
                            id="bannerPreview"
                            src="{{ asset('storage/'.$setting->banner) }}"
                            class="rounded-xl border w-full h-40 object-cover"
                        >
                    @else
                        <img
                            id="bannerPreview"
                            src="https://placehold.co/600x250?text=Banner"
                            class="rounded-xl border w-full h-40 object-cover"
                        >
                    @endif

                </div>

                <input
                    type="file"
                    id="banner"
                    name="banner"
                    class="mt-6 w-full rounded-xl border border-slate-300 p-3"
                >

            </div>

            {{-- Hero Image --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-xl font-bold text-slate-800">
                    Hero Image
                </h2>

                <div class="flex justify-center">

                    @if(!empty($setting?->hero_image))
                        <img
                            id="heroPreview"
                            src="{{ asset('storage/'.$setting->hero_image) }}"
                            class="rounded-xl border w-full h-48 object-cover"
                        >
                    @else
                        <img
                            id="heroPreview"
                            src="https://placehold.co/700x350?text=Hero+Image"
                            class="rounded-xl border w-full h-48 object-cover"
                        >
                    @endif

                </div>

                <input
                    type="file"
                    id="hero_image"
                    name="hero_image"
                    class="mt-6 w-full rounded-xl border border-slate-300 p-3"
                >

            </div>

            {{-- Tombol Simpan --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <button
                    type="submit"
                    class="w-full rounded-xl bg-green-600 py-4 text-lg font-semibold text-white hover:bg-green-700"
                >
                    💾 Simpan Setting
                </button>

            </div>

        </div>

    </div>

</form>

@endsection

@push('scripts')

<script type="module">

async function convertAndPreview(input, previewId){

    if(!input.files.length) return;

    let file = input.files[0];

    let ext = file.name.split('.').pop().toLowerCase();

    if(ext === 'heic' || ext === 'heif'){

        try{

            const converted = await window.heic2any({

                blob:file,

                toType:'image/jpeg',

                quality:0.9

            });

            file = new File(

                [converted],

                file.name.replace(/\.(heic|heif)$/i,'.jpg'),

                {

                    type:'image/jpeg'

                }

            );

            const dt = new DataTransfer();

            dt.items.add(file);

            input.files = dt.files;

        }catch(e){

            Swal.fire({

                icon:'error',

                title:'Gagal',

                text:'File HEIC tidak dapat dikonversi.'

            });

            return;

        }

    }

    const reader = new FileReader();

    reader.onload = function(e){

        document.getElementById(previewId).src = e.target.result;

    }

    reader.readAsDataURL(file);

}

document.getElementById('logo').addEventListener('change',function(){

    convertAndPreview(this,'logoPreview');

});

document.getElementById('favicon').addEventListener('change',function(){

    convertAndPreview(this,'faviconPreview');

});

document.getElementById('banner').addEventListener('change',function(){

    convertAndPreview(this,'bannerPreview');

});

document.getElementById('hero_image').addEventListener('change',function(){

    convertAndPreview(this,'heroPreview');

});

</script>

@endpush
