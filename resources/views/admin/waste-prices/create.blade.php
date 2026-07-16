@extends('layouts.admin')

@section('title','Tambah Harga Sampah')

@section('content')

<div class="mx-auto max-w-3xl">

    <div class="rounded-2xl bg-white p-8 shadow">

        <h1 class="mb-8 text-3xl font-bold">

            Tambah Harga Sampah

        </h1>

        <form
            action="{{ route('waste-prices.store') }}"
            method="POST"
        >

            @include('admin.waste-prices._form')

        </form>

    </div>

</div>

@endsection
