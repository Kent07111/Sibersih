<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ScheduleController extends Controller
{


public function index(Request $request)
{
    $query = Schedule::query();

    if ($request->filled('search')) {
        $query->where('judul', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $today = Carbon::today()->toDateString();

    $schedules = $query
        ->orderByRaw("
            CASE
                WHEN tanggal >= ? THEN 0
                ELSE 1
            END
        ", [$today])
        ->orderByRaw("
            CASE
                WHEN tanggal >= ? THEN tanggal
            END ASC
        ", [$today])
        ->orderByRaw("
            CASE
                WHEN tanggal < ? THEN tanggal
            END DESC
        ", [$today])
        ->orderBy('jam', 'ASC')
        ->paginate(12)
        ->withQueryString();

    return view('admin.schedule.index', compact('schedules'));
}

    public function create()
    {
        return view('admin.schedule.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'judul' => 'required|max:255',

            'tanggal' => 'required|date',

            'jam' => 'required',

            'lokasi' => 'required|max:255',

            'keterangan' => 'nullable',

            'status' => 'required|in:Aktif,Selesai,Comming Soon,Progress,Dibatalkan'

        ]);

        Schedule::create([

            'judul' => $request->judul,

            'tanggal' => $request->tanggal,

            'jam' => $request->jam,

            'lokasi' => $request->lokasi,

            'keterangan' => $request->keterangan,

            'status' => $request->status

        ]);

        return redirect()
            ->route('schedule.index')
            ->with(
                'success',
                'Jadwal berhasil ditambahkan.'
            );
    }

    public function edit(Schedule $schedule)
    {
        return view(
            'admin.schedule.edit',
            compact('schedule')
        );
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([

            'judul' => 'required|max:255',

            'tanggal' => 'required|date',

            'jam' => 'required',

            'lokasi' => 'required|max:255',

            'keterangan' => 'nullable',

            'status' => 'required|in:Aktif,Selesai,Comming Soon,Progress,Dibatalkan'
        ]);

        $schedule->update([

            'judul' => $request->judul,

            'tanggal' => $request->tanggal,

            'jam' => $request->jam,

            'lokasi' => $request->lokasi,

            'keterangan' => $request->keterangan,

            'status' => $request->status

        ]);

        return redirect()
            ->route('schedule.index')
            ->with(
                'success',
                'Jadwal berhasil diperbarui.'
            );
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()
            ->route('schedule.index')
            ->with(
                'success',
                'Jadwal berhasil dihapus.'
            );
    }
}
