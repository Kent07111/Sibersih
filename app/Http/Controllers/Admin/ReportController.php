<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\WastePoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::with([
            'wastePoint',
            'processor'
        ]);

        if($request->search){

            $query->where('nama','like','%'.$request->search.'%');

        }

        if($request->status){

            $query->where('status',$request->status);

        }

        if($request->rt){

            $query->where('rt',$request->rt);

        }

        if($request->rw){

            $query->where('rw',$request->rw);

        }

        $reports = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $total = Report::count();

        $menunggu = Report::where(
            'status',
            'Menunggu'
        )->count();

        $diproses = Report::where(
            'status',
            'Diproses'
        )->count();

        $selesai = Report::where(
            'status',
            'Selesai'
        )->count();

        $ditolak = Report::where(
            'status',
            'Ditolak'
        )->count();

        return view(
            'admin.report.index',
            compact(
                'reports',
                'total',
                'menunggu',
                'diproses',
                'selesai',
                'ditolak'
            )
        );
    }

public function show(Report $report)
{
    $wastePoints = WastePoint::orderBy('nama')->get();

    return view(
        'admin.report.show',
        compact(
            'report',
            'wastePoints'
        )
    );
}

public function update(Request $request, Report $report)
{
    $request->validate([

        'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',

        'waste_point_id' => 'nullable|exists:waste_points,id',

        'catatan_admin' => 'nullable|string'

    ]);

    $report->update([

        'status' => $request->status,

        'waste_point_id' => $request->waste_point_id,

        'catatan_admin' => $request->catatan_admin,

        'processed_by' => Auth::id(),

        'processed_at' => now()

    ]);

    return redirect()
        ->route('report.show', $report)
        ->with(
            'success',
            'Laporan berhasil diperbarui.'
        );
}

public function destroy(Report $report)
{
    if (
        $report->foto &&
        Storage::disk('public')->exists($report->foto)
    ) {

        Storage::disk('public')->delete($report->foto);

    }

    $report->delete();

    return redirect()
        ->route('report.index')
        ->with(
            'success',
            'Laporan berhasil dihapus.'
        );
}
}
