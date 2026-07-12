<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityImage::with('activity');

        if ($request->filled('activity')) {

            $query->where('activity_id', $request->activity);

        }

        if ($request->filled('search')) {

            $query->whereHas('activity', function ($q) use ($request) {

                $q->where('judul', 'like', '%' . $request->search . '%');

            });

        }

        $images = $query
            ->latest()
            ->paginate(24)
            ->withQueryString();

        $activities = Activity::orderBy('judul')->get();

        return view(
            'admin.gallery.index',
            compact(
                'images',
                'activities'
            )
        );
    }

    public function show(ActivityImage $gallery)
    {
        return response()->json([

            'image' => asset('storage/' . $gallery->gambar),

            'judul' => $gallery->activity->judul,

            'tanggal' => $gallery->activity->tanggal->format('d F Y'),

            'lokasi' => $gallery->activity->lokasi,

            'deskripsi' => $gallery->activity->isi

        ]);
    }
}
