<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WastePoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WastePointController extends Controller
{
    public function index()
    {
        $wastePoints = WastePoint::latest()->get();

        return view('admin.waste-point.index', compact('wastePoints'));
    }
    public function create()
    {
        $wastePoints = WastePoint::all();

        return view('admin.waste-point.create', compact('wastePoints'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|max:255',
            'jenis'       => 'required',
            'alamat'      => 'required',
            'latitude'    => 'required',
            'longitude'   => 'required',
            'deskripsi'   => 'nullable',
            'foto'        => 'nullable|image|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {

            $foto = $request
                ->file('foto')
                ->store('waste-point', 'public');
        }

        WastePoint::create([

            'kode' => 'TPS-' . strtoupper(Str::random(6)),

            'nama' => $request->nama,

            'jenis' => $request->jenis,

            'alamat' => $request->alamat,

            'latitude' => $request->latitude,

            'longitude' => $request->longitude,

            'deskripsi' => $request->deskripsi,

            'foto' => $foto,

            'status' => 'Aktif',

            'created_by' => Auth::id(),

        ]);

        return redirect()
            ->route('waste-point.index')
            ->with('success', 'Titik sampah berhasil ditambahkan.');
    }

    public function edit(WastePoint $wastePoint)
    {
        return view('admin.waste-point.edit', compact('wastePoint'));
    }

    public function update(Request $request, WastePoint $wastePoint)
    {
        $request->validate([
            'nama'       => 'required|max:255',
            'jenis'      => 'required',
            'alamat'     => 'required',
            'latitude'   => 'required|numeric',
            'longitude'  => 'required|numeric',
            'deskripsi'  => 'nullable',
            'status'     => 'required',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [

            'nama'       => $request->nama,

            'jenis'      => $request->jenis,

            'alamat'     => $request->alamat,

            'latitude'   => $request->latitude,

            'longitude'  => $request->longitude,

            'deskripsi'  => $request->deskripsi,

            'status'     => $request->status,

        ];

        if ($request->hasFile('foto')) {

            if ($wastePoint->foto && Storage::disk('public')->exists($wastePoint->foto)) {

                Storage::disk('public')->delete($wastePoint->foto);

            }

            $data['foto'] = $request
                ->file('foto')
                ->store('waste-point', 'public');

        }

        $wastePoint->update($data);

        return redirect()
            ->route('waste-point.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(WastePoint $wastePoint)
    {
        if ($wastePoint->foto && Storage::disk('public')->exists($wastePoint->foto)) {

            Storage::disk('public')->delete($wastePoint->foto);

        }

        $wastePoint->delete();

        return redirect()
            ->route('waste-point.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}