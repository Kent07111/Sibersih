<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class EducationController extends Controller
{
public function index(Request $request)
{
    $query = Education::query();

    if ($request->search) {

        $query->where('judul', 'like', '%' . $request->search . '%');

    }

    if ($request->kategori) {

        $query->where('kategori', $request->kategori);

    }

    if ($request->status) {

        $query->where('status', $request->status);

    }

    $educations = $query
        ->latest()
        ->paginate(12)
        ->withQueryString();

    return view(
        'admin.education.index',
        compact('educations')
    );
}

    public function create()
    {
        return view(
            'admin.education.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|max:255',
            'slug'       => 'required|unique:educations,slug',
            'excerpt'    => 'required|max:250',
            'kategori'   => 'required',
            'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'isi'        => 'required',
            'video_url'  => 'nullable|url',
            'pdf'        => 'nullable|mimes:pdf|max:10240',
            'status'     => 'required',
        ]);

        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request
                ->file('thumbnail')
                ->store('education/thumbnail', 'public');

        }

        $pdf = null;

        if ($request->hasFile('pdf')) {

            $pdf = $request
                ->file('pdf')
                ->store('education/pdf', 'public');

        }

        Education::create([

            'judul'      => $request->judul,

            'slug'       => Str::slug($request->slug),

            'excerpt'    => $request->excerpt,

            'kategori'   => $request->kategori,

            'thumbnail'  => $thumbnail,

            'isi'        => $request->isi,

            'video_url'  => $request->video_url,

            'pdf'        => $pdf,

            'status'     => $request->status,

            'created_by' => auth()->id(),

        ]);

        return redirect()
            ->route('education.index')
            ->with('success', 'Artikel edukasi berhasil ditambahkan.');
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
    public function edit(Education $education)
    {
        return view(
            'admin.education.edit',
            compact('education')
        );
    }


    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Education $education)
{
    $request->validate([
        'judul'      => 'required|max:255',
        'slug'       => 'required|unique:educations,slug,' . $education->id,
        'excerpt'    => 'required|max:250',
        'kategori'   => 'required',
        'isi'        => 'required',
        'video_url'  => 'nullable|url',
        'status'     => 'required',
        'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'pdf'        => 'nullable|mimes:pdf|max:10240',
    ]);

    $data = [

        'judul'      => $request->judul,

        'slug'       => Str::slug($request->slug),

        'excerpt'    => $request->excerpt,

        'kategori'   => $request->kategori,

        'isi'        => $request->isi,

        'video_url'  => $request->video_url,

        'status'     => $request->status,

    ];

    // Update Thumbnail
    if ($request->hasFile('thumbnail')) {

        if (
            $education->thumbnail &&
            Storage::disk('public')->exists($education->thumbnail)
        ) {

            Storage::disk('public')->delete($education->thumbnail);

        }

        $data['thumbnail'] = $request
            ->file('thumbnail')
            ->store('education/thumbnail', 'public');

    }

    // Update PDF
    if ($request->hasFile('pdf')) {

        if (
            $education->pdf &&
            Storage::disk('public')->exists($education->pdf)
        ) {

            Storage::disk('public')->delete($education->pdf);

        }

        $data['pdf'] = $request
            ->file('pdf')
            ->store('education/pdf', 'public');

    }

    $education->update($data);

    return redirect()
        ->route('education.index')
        ->with('success', 'Artikel berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Education $education)
{
    if (
        $education->thumbnail &&
        Storage::disk('public')->exists($education->thumbnail)
    ) {

        Storage::disk('public')->delete($education->thumbnail);

    }

    if (
        $education->pdf &&
        Storage::disk('public')->exists($education->pdf)
    ) {

        Storage::disk('public')->delete($education->pdf);

    }

    $education->delete();

    return redirect()
        ->route('education.index')
        ->with('success', 'Artikel berhasil dihapus.');
}
}