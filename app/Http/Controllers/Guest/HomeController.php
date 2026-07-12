<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Education;
use App\Models\Report;
use App\Models\Schedule;
use App\Models\WastePoint;

class HomeController extends Controller
{
    public function index()
    {
        return view('guest.home',[

            'educations' => Education::where('status', 'Publish')
                ->latest()
                ->take(6)
                ->get(),

            'activities'=>Activity::where('status','Publish')
                ->latest()
                ->take(3)
                ->get(),

            'schedules'=>Schedule::where('status','Aktif')
                ->orderBy('tanggal')
                ->take(3)
                ->get(),

            'wastePoints'=>WastePoint::all(),

            'reportCount'=>Report::count(),

            'educationCount'=>Education::count(),

            'activityCount'=>Activity::count(),

            'wastePointCount'=>WastePoint::count()

        ]);
    }
}
