<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\WastePoint;
use Illuminate\Http\Request;

class ReportgController extends Controller
{
    public function create()
    {
        $wastePoints = WastePoint::where(
            'status',
            'Aktif'
        )->get();

        return view(
            'guest.report.create',
            compact('wastePoints')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'nama'=>'required|max:100',

            'telepon'=>'nullable|max:20',

            'rt'=>'required|max:5',

            'rw'=>'required|max:5',

            'lokasi'=>'required',

            'latitude'=>'required',

            'longitude'=>'required',

            'deskripsi'=>'required',

            'foto'=>'required|image|max:4096'

        ]);

        $foto = $request->file('foto')
            ->store(
                'reports',
                'public'
            );

        Report::create([

            'waste_point_id'=>$request->waste_point_id,

            'nama'=>$request->nama,

            'telepon'=>$request->telepon,

            'rt'=>$request->rt,

            'rw'=>$request->rw,

            'lokasi'=>$request->lokasi,

            'latitude'=>$request->latitude,

            'longitude'=>$request->longitude,

            'deskripsi'=>$request->deskripsi,

            'foto'=>$foto

        ]);

return redirect()
    ->route('guest.report.create')
    ->with('success', 'Laporan berhasil dikirim. Terima kasih atas partisipasi Anda.');
    }

    public function success()
    {
        return view(
            'guest.report.success'
        );
    }
}