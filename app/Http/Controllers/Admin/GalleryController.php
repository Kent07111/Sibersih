<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityImage;
use App\Models\ActivityVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GalleryController extends Controller
{
public function index(Request $request)
{
    $activities = Activity::orderBy('judul')->get();

    $images = ActivityImage::with('activity')
        ->get()
        ->map(function ($item) {

            return (object)[
                'id' => $item->id,
                'type' => 'image',
                'path' => $item->gambar,
                'activity' => $item->activity,
                'created_at' => $item->created_at,
            ];

        });

    $videos = ActivityVideo::with('activity')
        ->get()
        ->map(function ($item) {

            return (object)[
                'id' => $item->id,
                'type' => 'video',
                'path' => $item->video,
                'activity' => $item->activity,
                'created_at' => $item->created_at,
            ];

        });

    $gallery = $images
        ->concat($videos)
        ->sortByDesc('created_at')
        ->values();

    return view('admin.gallery.index', compact(
        'activities',
        'gallery'
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
    public function create()
    {
        $activities = Activity::where('status', 'Publish')
            ->orderByDesc('tanggal')
            ->get();

        return view('admin.gallery.create', compact('activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'images.*'    => 'nullable|image|max:10240',
            'videos.*'    => 'nullable|mimes:mp4,mov,avi,webm,mkv|max:51200',
        ]);

        DB::transaction(function () use ($request) {

            $manager = new ImageManager(new Driver());

            // Upload Gambar
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $img = $manager->read($image);

                    if ($img->width() > 1920) {
                        $img->scaleDown(width: 1920);
                    }

                    $filename = Str::uuid() . '.webp';

                    Storage::disk('public')->put(
                        'gallery/images/' . $filename,
                        $img->toWebp(80)->toString()
                    );

                    ActivityImage::create([
                        'activity_id' => $request->activity_id,
                        'gambar'      => 'gallery/images/' . $filename,
                    ]);
                }
            }

            // Upload Video
            if ($request->hasFile('videos')) {

                foreach ($request->file('videos') as $video) {

                    $filename = Str::uuid() . '.' . $video->getClientOriginalExtension();

                    $path = $video->storeAs(
                        'gallery/videos',
                        $filename,
                        'public'
                    );

                    ActivityVideo::create([
                        'activity_id' => $request->activity_id,
                        'video'       => $path,
                    ]);
                }
            }
        });

        return redirect()
            ->route('gallery.index')
            ->with('success', 'Gallery berhasil ditambahkan.');
    }

public function destroyImage(ActivityImage $image)
{
    if ($image->gambar && Storage::disk('public')->exists($image->gambar)) {
        Storage::disk('public')->delete($image->gambar);
    }

    $image->delete();

    return back()->with(
        'success',
        'Foto berhasil dihapus.'
    );
}

public function destroyVideo(ActivityVideo $video)
{
    if ($video->video && Storage::disk('public')->exists($video->video)) {
        Storage::disk('public')->delete($video->video);
    }

    $video->delete();

    return back()->with(
        'success',
        'Video berhasil dihapus.'
    );
}
}