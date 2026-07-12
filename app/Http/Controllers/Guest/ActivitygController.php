<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivitygController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::where('status', 'Publish');

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');

            });

        }

        $activities = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view(
            'guest.activity.index',
            compact('activities')
        );
    }

    public function show(Activity $activity)
    {
        $related = Activity::where('id', '!=', $activity->id)
            ->where('status', 'Publish')
            ->latest()
            ->take(3)
            ->get();

        return view(
            'guest.activity.show',
            compact(
                'activity',
                'related'
            )
        );
    }
}
