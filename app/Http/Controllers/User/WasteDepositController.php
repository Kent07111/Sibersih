<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserWallet;
use Illuminate\Http\Request;


use App\Http\Requests\WasteDepositRequest;
use App\Models\User;
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

public function index(Request $request)
{
    $query = WasteDeposit::where('user_id', Auth::id());

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('search')) {
        $query->where('invoice_number', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('start_date')) {
        $query->whereDate('deposit_date', '>=', $request->start_date);
    }

    if ($request->filled('end_date')) {
        $query->whereDate('deposit_date', '<=', $request->end_date);
    }

    $deposits = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $stats = WasteDeposit::where('user_id', Auth::id());

    $totalTransaction = $stats->count();

    $totalWeight = $stats->sum('total_weight');

    $wallet = UserWallet::where('user_id', Auth::id())->first();

    $totalAmount = $wallet?->balance ?? 0;

    $average = $totalTransaction > 0
        ? $totalAmount / $totalTransaction
        : 0;

    return view('user.deposits.index', compact(
        'deposits',
        'totalTransaction',
        'totalWeight',
        'totalAmount',
        'average'
    ));
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
