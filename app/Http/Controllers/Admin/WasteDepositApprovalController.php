<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasteDeposit;
use App\Models\UserWallet;
use App\Models\WastePrice;
use App\Models\PointHistory;
use App\Models\BalanceHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WasteDepositApprovalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $deposits = WasteDeposit::with('user')

            ->when($search,function($query) use($search){

                $query->where('invoice_number','like',"%{$search}%")

                ->orWhereHas('user',function($q) use($search){

                    $q->where('name','like',"%{$search}%");

                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view(
            'admin.waste-deposits.index',
            compact(
                'deposits',
                'search'
            )
        );
    }
public function show(WasteDeposit $deposit)
{
    $deposit->load([
        'user',
        'details.category'
    ]);

    $totalPrice = 0;
    $totalPoint = 0;

    foreach ($deposit->details as $detail) {

        $price = WastePrice::where('category_id', $detail->category_id)
            ->where('is_active', true)
            ->first();

        $detail->estimated_price = $price?->price_per_kg ?? 0;

        $detail->estimated_point = $price?->point_per_kg ?? 0;

        $detail->estimated_subtotal_price =
            $detail->weight * $detail->estimated_price;

        $detail->estimated_subtotal_point =
            $detail->weight * $detail->estimated_point;

        $totalPrice += $detail->estimated_subtotal_price;

        $totalPoint += $detail->estimated_subtotal_point;
    }

    return view(
        'admin.waste-deposits.show',
        compact(
            'deposit',
            'totalPrice',
            'totalPoint'
        )
    );
}
    public function approve(WasteDeposit $deposit)
    {
        DB::transaction(function () use ($deposit) {

            $deposit->load('details');

$wallet = UserWallet::firstOrCreate(
    [
        'user_id' => $deposit->user_id
    ],
    [
        'point' => 0,
        'balance' => 0
    ]
);

            $totalWeight = 0;
            $totalPrice = 0;
            $totalPoint = 0;

            foreach ($deposit->details as $detail) {

                $price = WastePrice::where('category_id', $detail->category_id)
                    ->where('is_active', true)
                    ->first();

                if (!$price) {
                    throw new \Exception(
                        'Harga sampah belum tersedia.'
                    );
                }

                $subtotalPrice = $detail->weight * $price->price_per_kg;

                $subtotalPoint = $detail->weight * $price->point_per_kg;

                $detail->update([

                    'price_per_kg' => $price->price_per_kg,

                    'point_per_kg' => $price->point_per_kg,

                    'subtotal_price' => $subtotalPrice,

                    'subtotal_point' => $subtotalPoint,

                ]);

                $totalWeight += $detail->weight;

                $totalPrice += $subtotalPrice;

                $totalPoint += $subtotalPoint;
            }

$pointBefore = $wallet->point;

$balanceBefore = $wallet->balance;

$wallet->increment('point', $totalPoint);

$wallet->increment('balance', $totalPrice);

$wallet->update([
    'last_transaction_at' => now(),
]);

            $wallet->refresh();

            $deposit->update([

                'admin_id' => Auth::id(),

                'total_weight' => $totalWeight,

                'total_price' => $totalPrice,

                'total_point' => $totalPoint,

                'status' => 'Diterima',

                'validated_at' => now(),

            ]);

            PointHistory::create([

                'wallet_id' => $wallet->id,

                'deposit_id' => $deposit->id,

                'type' => 'Masuk',

                'point' => $totalPoint,

                'balance_before' => $pointBefore,

                'balance_after' => $wallet->point,

                'description' => 'Setoran Sampah ' . $deposit->invoice_number,

            ]);

            BalanceHistory::create([

                'wallet_id' => $wallet->id,

                'deposit_id' => $deposit->id,

                'type' => 'Masuk',

                'amount' => $totalPrice,

                'balance_before' => $balanceBefore,

                'balance_after' => $wallet->balance,

                'description' => 'Setoran Sampah ' . $deposit->invoice_number,

            ]);

        });

        return back()->with(
            'success',
            'Setoran berhasil divalidasi.'
        );
    }
}