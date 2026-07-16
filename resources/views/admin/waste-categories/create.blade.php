@extends('layouts.admin')

@section('title','Tambah Kategori Sampah')

@section('content')

<div class="mx-auto max-w-3xl">

    <div class="rounded-2xl bg-white p-8 shadow">

        <h1 class="mb-8 text-3xl font-bold">
            Tambah Kategori Sampah
        </h1>

        <form
            action="{{ route('waste-categories.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @include('admin.waste-categories._form')

        </form>

    </div>

</div>

@endsection
