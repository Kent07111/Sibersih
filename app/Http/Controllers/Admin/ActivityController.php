<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Models\ActivityImage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::query();

        if($request->search){

            $query->where(
                'judul',
                'like',
                '%'.$request->search.'%'
            );

        }

        if($request->kategori){

            $query->where(
                'kategori',
                $request->kategori
            );

        }

        if($request->status){

            $query->where(
                'status',
                $request->status
            );

        }

        $activities = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $total = Activity::count();

        $publish = Activity::where(
            'status',
            'Publish'
        )->count();

        $draft = Activity::where(
            'status',
            'Draft'
        )->count();

        return view(
            'admin.activity.index',
            compact(
                'activities',
                'total',
                'publish',
                'draft'
            )
        );
    }

    public function create()
    {
        return view(
            'admin.activity.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'judul'      => 'required|max:255',

            'slug'       => 'required|unique:activities,slug',

            'kategori'   => 'required|max:100',

            'tanggal'    => 'required|date',

            'lokasi'     => 'required|max:255',

            'isi'        => 'required',

            'status'     => 'required',

            'thumbnail' => 'nullable|file|max:15360',
            'gallery.*' => 'nullable|file|max:15360',

        ]);

        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {

        $thumbnail = ImageService::upload(
            $request->file('thumbnail'),
            'activity/thumbnail'
        );

        }

        $activity = Activity::create([

            'judul'       => $request->judul,

            'slug'        => Str::slug($request->slug),

            'thumbnail'   => $thumbnail,

            'kategori'    => $request->kategori,

            'tanggal'     => $request->tanggal,

            'lokasi'      => $request->lokasi,

            'isi'         => $request->isi,

            'status'      => $request->status,

            'created_by'  => auth()->id(),

        ]);

        // ============================
        // Upload Dokumentasi
        // ============================

        if ($request->hasFile('gallery')) {

            foreach ($request->file('gallery') as $image) {

                ActivityImage::create([

                    'activity_id' => $activity->id,

                    'gambar' => ImageService::upload(
                        $image,
                        'activity/gallery'
                    )

                ]);

            }

        }

        return redirect()
            ->route('activity.index')
            ->with(
                'success',
                'Kegiatan berhasil ditambahkan.'
            );
    }

    public function edit(Activity $activity)
    {
        return view(
            'admin.activity.edit',
            compact('activity')
        );
    }
public function destroyImage(ActivityImage $image)
{
    if (
        $image->gambar &&
        Storage::disk('public')->exists($image->gambar)
    ) {

        Storage::disk('public')->delete($image->gambar);

    }

    $image->delete();

    return back()->with(
        'success',
        'Dokumentasi berhasil dihapus.'
    );
}
public function update(Request $request, Activity $activity)
{
    $request->validate([

        'judul'      => 'required|max:255',

        'slug'       => 'required|unique:activities,slug,' . $activity->id,

        'kategori'   => 'required|max:100',

        'tanggal'    => 'required|date',

        'lokasi'     => 'required|max:255',

        'isi'        => 'required',

        'status'     => 'required',

        'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'gallery.*'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

    ]);

    $data = [

        'judul'      => $request->judul,

        'slug'       => Str::slug($request->slug),

        'kategori'   => $request->kategori,

        'tanggal'    => $request->tanggal,

        'lokasi'     => $request->lokasi,

        'isi'        => $request->isi,

        'status'     => $request->status,

    ];

    if ($request->hasFile('thumbnail')) {

        if (
            $activity->thumbnail &&
            Storage::disk('public')->exists($activity->thumbnail)
        ) {

            Storage::disk('public')->delete($activity->thumbnail);

        }

        $data['thumbnail'] = $request
            ->file('thumbnail')
            ->store('activity/thumbnail', 'public');

    }

    $activity->update($data);

    if ($request->hasFile('gallery')) {

        foreach ($request->file('gallery') as $image) {

            $path = $image
                ->store('activity/gallery', 'public');

            ActivityImage::create([

                'activity_id' => $activity->id,

                'gambar'      => $path

            ]);

        }

    }

    return redirect()
        ->route('activity.index')
        ->with(
            'success',
            'Kegiatan berhasil diperbarui.'
        );
}

public function destroy(Activity $activity)
{
    if (
        $activity->thumbnail &&
        Storage::disk('public')->exists($activity->thumbnail)
    ) {

        Storage::disk('public')->delete($activity->thumbnail);

    }

    foreach ($activity->images as $image) {

        if (
            $image->gambar &&
            Storage::disk('public')->exists($image->gambar)
        ) {

            Storage::disk('public')->delete($image->gambar);

        }

        $image->delete();

    }

    $activity->delete();

    return redirect()
        ->route('activity.index')
        ->with(
            'success',
            'Kegiatan berhasil dihapus.'
        );
}
}
