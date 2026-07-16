@extends('layouts.admin')

@section('title','Edit Kategori Sampah')

@section('content')

<div class="mx-auto max-w-3xl">

    <div class="rounded-2xl bg-white p-8 shadow">

        <h1 class="mb-8 text-3xl font-bold">

            Edit Kategori Sampah

        </h1>

        <form
            action="{{ route('waste-categories.update',$category) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')

            @include('admin.waste-categories._form')

        </form>

    </div>

</div>

@endsection
