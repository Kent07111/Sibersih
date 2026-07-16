<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\WasteCategoryRequest;
use App\Models\WasteCategory;
use Illuminate\Support\Facades\Storage;

class WasteCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $categories = WasteCategory::when($search, function ($query) use ($search) {

            $query->where('code', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");

        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('admin.waste-categories.index', compact(
            'categories',
            'search'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.waste-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WasteCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            $data['image'] = $request
                ->file('image')
                ->store('waste-categories', 'public');

        }

        WasteCategory::create($data);

        return redirect()
            ->route('waste-categories.index')
            ->with('success', 'Kategori sampah berhasil ditambahkan.');
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
public function edit(WasteCategory $wasteCategory)
{
    return view(
        'admin.waste-categories.edit',
        [
            'category' => $wasteCategory
        ]
    );
}

    /**
     * Update the specified resource in storage.
     */
public function update(
    WasteCategoryRequest $request,
    WasteCategory $wasteCategory
)
{
    $data = $request->validated();

    if ($request->hasFile('image')) {

        if (
            $wasteCategory->image &&
            Storage::disk('public')->exists($wasteCategory->image)
        ) {
            Storage::disk('public')->delete($wasteCategory->image);
        }

        $data['image'] = $request
            ->file('image')
            ->store('waste-categories', 'public');
    }

    $wasteCategory->update($data);

    return redirect()
        ->route('waste-categories.index')
        ->with('success', 'Kategori berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(WasteCategory $wasteCategory)
{
    if (
        $wasteCategory->image &&
        Storage::disk('public')->exists($wasteCategory->image)
    ) {
        Storage::disk('public')->delete($wasteCategory->image);
    }

    $wasteCategory->delete();

    return back()
        ->with('success', 'Kategori berhasil dihapus.');
}
}