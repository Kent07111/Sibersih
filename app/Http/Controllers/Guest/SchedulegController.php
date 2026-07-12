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
