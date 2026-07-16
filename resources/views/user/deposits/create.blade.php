@extends('layouts.user')

@section('title', 'Setor Sampah')

@section('content')

<div
    x-data="depositForm()"
    class="max-w-5xl mx-auto space-y-6"
>

    <div class="bg-white rounded-2xl shadow p-6">

        <h1 class="text-3xl font-bold mb-2">

            Setor Sampah

        </h1>

        <p class="text-slate-500">

            Tambahkan jenis sampah yang akan disetor.

        </p>

    </div>
@if ($errors->any())
    <div class="mb-6 rounded-xl bg-red-100 border border-red-300 p-4">
        <ul class="list-disc pl-5 text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form
        action="{{ route('my-deposits.store') }}"
        method="POST"
        class="space-y-6"
    >

        @csrf

        <div class="bg-white rounded-2xl shadow p-6">

            <label class="font-semibold">

                Tanggal

            </label>

            <input
                type="text"
                class="mt-2 w-full rounded-xl border p-3 bg-gray-100"
                value="{{ now()->format('d F Y') }}"
                readonly
            >

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <template
                x-for="(item,index) in items"
                :key="index"
            >

                <div
                    class="grid grid-cols-12 gap-4 mb-4"
                >

                    <div class="col-span-6">

                        <label class="font-semibold">

                            Kategori

                        </label>

                        <select
                            :name="'category_id[]'"
                            x-model="item.category"
                            class="mt-2 w-full rounded-xl border p-3"
                        >

                            <option value="">

                                Pilih

                            </option>

                            @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                            >

                                {{ $category->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-span-4">

                        <label class="font-semibold">

                            Berat (Kg)

                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0.1"
                            :name="'weight[]'"
                            x-model="item.weight"
                            class="mt-2 w-full rounded-xl border p-3"
                        >

                    </div>

                    <div class="col-span-2 flex items-end">

                        <button
                            type="button"
                            @click="remove(index)"
                            class="w-full rounded-xl bg-red-500 py-3 text-white"
                        >

                            Hapus

                        </button>

                    </div>

                </div>

            </template>

            <button
                type="button"
                @click="add()"
                class="rounded-xl bg-green-600 px-5 py-3 text-white"
            >

                + Tambah Baris

            </button>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <label class="font-semibold">

                Keterangan

            </label>

            <textarea
                name="note"
                rows="4"
                class="mt-2 w-full rounded-xl border p-3"
            >{{ old('note') }}</textarea>

        </div>

        <div>

            <button
                class="rounded-xl bg-blue-600 px-8 py-3 text-white"
            >

                Simpan Setoran

            </button>

        </div>

    </form>

</div>

<script>

function depositForm(){

    return{

        items:[

            {

                category:'',
                weight:''

            }

        ],

        add(){

            this.items.push({

                category:'',
                weight:''

            })

        },

        remove(index){

            if(this.items.length==1) return;

            this.items.splice(index,1)

        }

    }

}

</script>

@endsection
