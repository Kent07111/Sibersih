@csrf

<div class="space-y-6">

    <div>

        <label class="mb-2 block font-semibold">

            Kategori

        </label>

        <select
            name="category_id"
            class="w-full rounded-xl border p-3"
            required
        >

            <option value="">

                -- Pilih Kategori --

            </option>

            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    @selected(old('category_id',$price->category_id ?? '')==$category->id)
                >

                    {{ $category->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div>

        <label class="mb-2 block font-semibold">

            Harga / Kg

        </label>

        <input
            type="number"
            name="price_per_kg"
            value="{{ old('price_per_kg',$price->price_per_kg ?? '') }}"
            class="w-full rounded-xl border p-3"
            required
        >

    </div>

    <div>

        <label class="mb-2 block font-semibold">

            Point / Kg

        </label>

        <input
            type="number"
            name="point_per_kg"
            value="{{ old('point_per_kg',$price->point_per_kg ?? '') }}"
            class="w-full rounded-xl border p-3"
            required
        >

    </div>

    <div>

        <label class="mb-2 block font-semibold">

            Mulai Berlaku

        </label>

        <input
            type="date"
            name="effective_date"
            value="{{ old('effective_date',$price->effective_date ?? now()->toDateString()) }}"
            class="w-full rounded-xl border p-3"
        >

    </div>

    <div>

        <label class="mb-2 block font-semibold">

            Status

        </label>

        <select
            name="is_active"
            class="w-full rounded-xl border p-3"
        >

            <option value="1">Aktif</option>

            <option value="0">Nonaktif</option>

        </select>

    </div>

</div>

<div class="mt-8 flex gap-3">

    <button
        class="rounded-xl bg-green-600 px-6 py-3 text-white"
    >

        Simpan

    </button>

    <a
        href="{{ route('waste-prices.index') }}"
        class="rounded-xl bg-gray-200 px-6 py-3"
    >

        Kembali

    </a>

</div>
