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
        return view('guest.home', [

            'educations' => Education::where('status', 'Publish')
                ->latest()
                ->take(6)
                ->get(),

            'activities' => Activity::where('status', 'Publish')
                ->orderByDesc('tanggal')
                ->take(3)
                ->get(),

            'schedules' => Schedule::where('status', 'Aktif')
                ->orderBy('tanggal')
                ->orderBy('jam')
                ->take(3)
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Titik tempat sampah
            |--------------------------------------------------------------------------
            */

            'wastePoints' => WastePoint::query()
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Laporan warga
            |--------------------------------------------------------------------------
            |
            | Laporan ditolak tidak ditampilkan di peta publik.
            |
            */

            'reports' => Report::query()
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->whereIn('status', [
                    'Menunggu',
                    'Diproses',
                    'Selesai',
                ])
                ->latest()
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Statistik
            |--------------------------------------------------------------------------
            */

            'reportCount' => Report::count(),

            'educationCount' => Education::where('status', 'Publish')
                ->count(),

            'activityCount' => Activity::where('status', 'Publish')
                ->count(),

            'wastePointCount' => WastePoint::count(),
        ]);
    }
}
