<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Models\ActivityImage;
use Illuminate\Support\Facades\DB;
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
    $activity->load('images');

    return view(
        'admin.activity.edit',
        compact('activity')
    );
}

public function update(Request $request, Activity $activity)
{
    $validated = $request->validate([

        'judul' => [
            'required',
            'string',
            'max:255',
        ],

        'slug' => [
            'required',
            'string',
            'max:255',
            'unique:activities,slug,' . $activity->id,
        ],

        'kategori' => [
            'required',
            'string',
            'max:100',
        ],

        'tanggal' => [
            'required',
            'date',
        ],

        'lokasi' => [
            'required',
            'string',
            'max:255',
        ],

        'isi' => [
            'required',
            'string',
        ],

        'status' => [
            'required',
            'in:Draft,Publish',
        ],

        'thumbnail' => [
            'nullable',
            'file',
            'mimes:jpg,jpeg,png,webp',
            'max:15360',
        ],

        'gallery' => [
            'nullable',
            'array',
            'max:20',
        ],

        'gallery.*' => [
            'file',
            'mimes:jpg,jpeg,png,webp',
            'max:15360',
        ],

    ]);

    $oldThumbnail = $activity->thumbnail;

    $newThumbnail = null;

    $newGalleryPaths = [];

    try {

        DB::beginTransaction();

        $data = [

            'judul' => $validated['judul'],

            'slug' => Str::slug($validated['slug']),

            'kategori' => $validated['kategori'],

            'tanggal' => $validated['tanggal'],

            'lokasi' => $validated['lokasi'],

            'isi' => $validated['isi'],

            'status' => $validated['status'],

        ];

        // ==========================================
        // Upload thumbnail baru
        // ==========================================

        if ($request->hasFile('thumbnail')) {

            $newThumbnail = ImageService::upload(
                $request->file('thumbnail'),
                'activity/thumbnail'
            );

            $data['thumbnail'] = $newThumbnail;

        }

        // ==========================================
        // Update data kegiatan
        // ==========================================

        $activity->update($data);

        // ==========================================
        // Upload gallery baru
        // ==========================================

        if ($request->hasFile('gallery')) {

            foreach ($request->file('gallery') as $image) {

                $path = ImageService::upload(
                    $image,
                    'activity/gallery'
                );

                $newGalleryPaths[] = $path;

                ActivityImage::create([

                    'activity_id' => $activity->id,

                    'gambar' => $path,

                ]);

            }

        }

        DB::commit();

        // Hapus thumbnail lama setelah update berhasil
        if (
            $newThumbnail &&
            $oldThumbnail &&
            Storage::disk('public')->exists($oldThumbnail)
        ) {

            Storage::disk('public')->delete($oldThumbnail);

        }

        return redirect()
            ->route('activity.index')
            ->with(
                'success',
                'Kegiatan berhasil diperbarui.'
            );

    } catch (\Throwable $error) {

        DB::rollBack();

        // Hapus thumbnail baru jika database gagal
        if (
            $newThumbnail &&
            Storage::disk('public')->exists($newThumbnail)
        ) {

            Storage::disk('public')->delete($newThumbnail);

        }

        // Hapus gallery baru jika database gagal
        foreach ($newGalleryPaths as $path) {

            if (Storage::disk('public')->exists($path)) {

                Storage::disk('public')->delete($path);

            }

        }

        report($error);

        return back()
            ->withInput()
            ->with(
                'error',
                'Kegiatan gagal diperbarui. Silakan coba kembali.'
            );

    }
}

public function destroyImage(ActivityImage $image)
{
    try {

        DB::beginTransaction();

        $imagePath = $image->gambar;

        $image->delete();

        DB::commit();

        if (
            $imagePath &&
            Storage::disk('public')->exists($imagePath)
        ) {

            Storage::disk('public')->delete($imagePath);

        }

        return back()->with(
            'success',
            'Dokumentasi berhasil dihapus.'
        );

    } catch (\Throwable $error) {

        DB::rollBack();

        report($error);

        return back()->with(
            'error',
            'Dokumentasi gagal dihapus.'
        );

    }
}

public function destroy(Activity $activity)
{
    try {

        DB::beginTransaction();

        $thumbnailPath = $activity->thumbnail;

        $galleryPaths = $activity
            ->images()
            ->pluck('gambar')
            ->toArray();

        $activity->delete();

        DB::commit();

        if (
            $thumbnailPath &&
            Storage::disk('public')->exists($thumbnailPath)
        ) {

            Storage::disk('public')->delete($thumbnailPath);

        }

        foreach ($galleryPaths as $path) {

            if (
                $path &&
                Storage::disk('public')->exists($path)
            ) {

                Storage::disk('public')->delete($path);

            }

        }

        return redirect()
            ->route('activity.index')
            ->with(
                'success',
                'Kegiatan berhasil dihapus.'
            );

    } catch (\Throwable $error) {

        DB::rollBack();

        report($error);

        return back()->with(
            'error',
            'Kegiatan gagal dihapus.'
        );

    }
}
}