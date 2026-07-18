<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityImage;
use App\Models\ActivityVideo;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
public function index(Request $request)
{
    $images = ActivityImage::with('activity')->latest()->get();

    $videos = ActivityVideo::with('activity')->latest()->get();

    return view('admin.gallery.index', compact(
        'images',
        'videos'
    ));
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
