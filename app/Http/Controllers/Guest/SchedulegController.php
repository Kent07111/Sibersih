<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class SchedulegController extends Controller
{
public function index(Request $request)
{
    $query = Schedule::query();

    if ($request->filled('status')) {

        $query->where(
            'status',
            $request->status
        );

    }

    $schedules = $query
        ->orderByRaw("
            CASE status
                WHEN 'Comming Soon' THEN 1
                WHEN 'Aktif' THEN 2
                WHEN 'Progress' THEN 3
                WHEN 'Selesai' THEN 4
                WHEN 'Dibatalkan' THEN 5
                ELSE 6
            END
        ")
        ->orderBy('tanggal')
        ->orderBy('jam')
        ->paginate(10)
        ->withQueryString();

    return view(
        'guest.schedule.index',
        compact('schedules')
    );
}
}