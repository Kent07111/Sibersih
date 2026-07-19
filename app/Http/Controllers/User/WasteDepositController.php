<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Requests\WasteDepositRequest;
use App\Models\WasteCategory;
use App\Models\WasteDeposit;
use App\Models\WasteDepositDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class WasteDepositController extends Controller
{
    public function create()
    {
        $categories = WasteCategory::where('is_active', true)
            ->with(['activePrice'])
            ->orderBy('name')
            ->get();

        $latestDeposits = WasteDeposit::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        return view('user.deposits.create', compact(
            'categories',
            'latestDeposits'
        ));
    }
    public function index()
    {
        $deposits = WasteDeposit::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->paginate(10);

        return view(
            'user.deposits.index',
            compact('deposits')
        );
    }
public function store(WasteDepositRequest $request)
{
    DB::transaction(function () use ($request) {

        // Simpan transaksi utama
        $deposit = WasteDeposit::create([

            'invoice_number' => 'DEP-' . now()->format('YmdHis'),

            'user_id' => Auth::id(),

            'deposit_date' => now()->toDateString(),

            'total_weight' => array_sum($request->weight),

            'total_price' => 0,

            'total_point' => 0,

            'status' => 'Menunggu',

            'note' => $request->note,

        ]);

        // Simpan detail setoran
        foreach ($request->category_id as $index => $categoryId) {

            WasteDepositDetail::create([

                'deposit_id' => $deposit->id,

                'category_id' => $categoryId,

                'category_name' => WasteCategory::find($categoryId)->name,

                'weight' => $request->weight[$index],

                'price_per_kg' => 0,

                'point_per_kg' => 0,

                'subtotal_price' => 0,

                'subtotal_point' => 0,

            ]);

        }

    });

    return redirect()
        ->route('my-deposits.index')
        ->with('success', 'Setoran berhasil diajukan dan menunggu validasi admin.');
}
}
