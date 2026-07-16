<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\WastePriceRequest;
use App\Models\WasteCategory;
use App\Models\WastePrice;
use Illuminate\Support\Facades\DB;

class WastePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $prices = WastePrice::with('category')

            ->when($search, function ($query) use ($search) {

                $query->whereHas('category', function ($q) use ($search) {

                    $q->where('code', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%");

                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view(
            'admin.waste-prices.index',
            compact(
                'prices',
                'search'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    $categories = WasteCategory::where('is_active', true)
        ->orderBy('name')
        ->get();

    return view(
        'admin.waste-prices.create',
        compact('categories')
    );
}

    /**
     * Store a newly created resource in storage.
     */
public function store(WastePriceRequest $request)
{
    DB::transaction(function () use ($request) {

        $data = $request->validated();

        // Jika harga baru aktif,
        // nonaktifkan harga aktif sebelumnya
        if ($data['is_active']) {

            WastePrice::where('category_id', $data['category_id'])
                ->update([
                    'is_active' => false,
                    'expired_date' => now(),
                ]);

        }

        WastePrice::create($data);

    });

    return redirect()
        ->route('waste-prices.index')
        ->with('success', 'Harga sampah berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(WastePrice $wastePrice)
{
    $categories = WasteCategory::where('is_active', true)
        ->orderBy('name')
        ->get();

    return view(
        'admin.waste-prices.edit',
        [
            'price' => $wastePrice,
            'categories' => $categories,
        ]
    );
}

    /**
     * Update the specified resource in storage.
     */
public function update(
    WastePriceRequest $request,
    WastePrice $wastePrice
)
{
    DB::transaction(function () use ($request, $wastePrice) {

        $data = $request->validated();

        if ($data['is_active']) {

            WastePrice::where('category_id', $data['category_id'])
                ->where('id', '!=', $wastePrice->id)
                ->update([
                    'is_active' => false,
                    'expired_date' => now(),
                ]);

            $data['expired_date'] = null;
        }

        $wastePrice->update($data);

    });

    return redirect()
        ->route('waste-prices.index')
        ->with('success', 'Harga sampah berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(WastePrice $wastePrice)
{
    $wastePrice->delete();

    return back()->with(
        'success',
        'Harga sampah berhasil dihapus.'
    );
}
}
