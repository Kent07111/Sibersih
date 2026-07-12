<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GallerygController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('kategori')) {

            $query->where(
                'kategori',
                $request->kategori
            );

        }

        $galleries = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $kategori = Gallery::select('kategori')
            ->distinct()
            ->pluck('kategori');

        return view(
            'guest.gallery.index',
            compact(
                'galleries',
                'kategori'
            )
        );
    }
}
