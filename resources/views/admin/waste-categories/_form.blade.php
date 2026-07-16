@csrf

<div class="space-y-6">

    <div>

        <label class="mb-2 block font-semibold">
            Kode
        </label>

        <input
            type="text"
            name="code"
            value="{{ old('code', $category->code ?? '') }}"
            class="w-full rounded-xl border p-3"
            required
        >

        @error('code')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>

    <div>

        <label class="mb-2 block font-semibold">
            Nama
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $category->name ?? '') }}"
            class="w-full rounded-xl border p-3"
            required
        >

        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>

    <div>

        <label class="mb-2 block font-semibold">
            Deskripsi
        </label>

        <textarea
            name="description"
            rows="4"
            class="w-full rounded-xl border p-3"
        >{{ old('description', $category->description ?? '') }}</textarea>

    </div>

    <div>

        <label class="mb-2 block font-semibold">
            Gambar
        </label>

        <input
            type="file"
            name="image"
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

            <option value="1"
                @selected(old('is_active', $category->is_active ?? 1) == 1)>
                Aktif
            </option>

            <option value="0"
                @selected(old('is_active', $category->is_active ?? 1) == 0)>
                Nonaktif
            </option>

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
        href="{{ route('waste-categories.index') }}"
        class="rounded-xl bg-gray-200 px-6 py-3"
    >
        Kembali
    </a>

</div>
