<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityImage;
use App\Models\ActivityVideo;
use Illuminate\Http\Request;

class GallerygController extends Controller
{
    public function index(Request $request)
    {
        $imageQuery = ActivityImage::with('activity');
        $videoQuery = ActivityVideo::with('activity');

        if ($request->filled('kategori')) {

            $imageQuery->whereHas('activity', function ($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });

            $videoQuery->whereHas('activity', function ($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });

        }

        $images = $imageQuery->latest()->get();

        $videos = $videoQuery->latest()->get();

        $kategori = Activity::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        return view(
            'guest.gallery.index',
            compact(
                'images',
                'videos',
                'kategori'
            )
        );
    }
}
