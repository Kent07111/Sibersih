@extends('layouts.admin')

@section('title','Tambah Jadwal')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Tambah Jadwal

            </h1>

            <p class="mt-2 text-slate-500">

                Tambahkan agenda kegiatan SIBERSIH.

            </p>

        </div>

        <a
            href="{{ route('schedule.index') }}"
            class="rounded-xl border px-5 py-3 hover:bg-slate-100"
        >

            Kembali

        </a>

    </div>

    <form
        action="{{ route('schedule.store') }}"
        method="POST"
    >

        @csrf

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- LEFT --}}
            <div class="space-y-6">

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold">

                        Informasi Jadwal

                    </h2>

                    <div class="space-y-5">

                        <div>

                            <label class="mb-2 block font-medium">

                                Judul Kegiatan

                            </label>

                            <input
                                type="text"
                                name="judul"
                                value="{{ old('judul') }}"
                                class="w-full rounded-xl border p-3"
                                required
                            >

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">

                                Tanggal

                            </label>

                            <input
                                type="date"
                                name="tanggal"
                                value="{{ old('tanggal') }}"
                                class="w-full rounded-xl border p-3"
                                required
                            >

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">

                                Jam

                            </label>

                            <input
                                type="time"
                                name="jam"
                                value="{{ old('jam') }}"
                                class="w-full rounded-xl border p-3"
                                required
                            >

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">

                                Lokasi

                            </label>

                            <input
                                type="text"
                                name="lokasi"
                                value="{{ old('lokasi') }}"
                                class="w-full rounded-xl border p-3"
                                required
                            >

                        </div>

                        <div>

                            <label class="mb-2 block font-medium">

                                Status

                            </label>

                            <select
                                name="status"
                                class="w-full rounded-xl border p-3"
                            >

                                <option value="Aktif">

                                    Aktif

                                </option>
                                <option value="progress">

                                    progress

                                </option>
                                <option value="Selesai">

                                    Selesai

                                </option>
                                <option value="Comming Soon">

                                    Comming Soon

                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="lg:col-span-2">

                <div class="rounded-2xl bg-white p-6 shadow">

                    <h2 class="mb-5 text-lg font-bold">

                        Keterangan

                    </h2>

                    <textarea
                        name="keterangan"
                        id="editor"
                        rows="12"
                    >{{ old('keterangan') }}</textarea>

                </div>

                <div class="mt-6 flex justify-end gap-3">

                    <a
                        href="{{ route('schedule.index') }}"
                        class="rounded-xl border px-6 py-3 hover:bg-slate-100"
                    >

                        Batal

                    </a>

                    <button
                        class="rounded-xl bg-green-600 px-8 py-3 font-semibold text-white hover:bg-green-700"
                    >

                        Simpan Jadwal

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script src="https://cdn.tiny.cloud/1/4jrzzsgk6khdvn5i43u7wbrxotg20bhraoc2697y5s60qcr9/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script>

tinymce.init({

    selector:'#editor',

    height:600,

    menubar:true,

    plugins:'image link table lists media code fullscreen preview wordcount',

    toolbar:'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | image media link table | code fullscreen preview',

    automatic_uploads:true,

    file_picker_types:'image',

    file_picker_callback:function(callback){

        const input=document.createElement('input');

        input.type='file';

        input.accept='image/*';

        input.onchange=function(){

            let file=this.files[0];

            let formData=new FormData();

            formData.append('file',file);

            fetch("{{ route('education.upload-image') }}",{

                method:'POST',

                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                },

                body:formData

            })

            .then(res=>res.json())

            .then(data=>{

                callback(data.location);

            })

            .catch(err=>{

                console.error(err);

                alert('Upload gagal');

            });

        };

        input.click();

    }

});

// Auto Slug
// Preview Thumbnail
document.getElementById("thumbnail").addEventListener("change", function (e) {

    const file = e.target.files[0];

    if (!file) return;

    const reader = new FileReader();

    reader.onload = function (ev) {

        const img = document.getElementById("preview");

        img.src = ev.target.result;

        img.classList.remove("hidden");

    }

    reader.readAsDataURL(file);

});
document.getElementById("judul").addEventListener("input", function () {

    let slug = this.value
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');

    document.getElementById("slug").value = slug;

});
</script>

@endpush


