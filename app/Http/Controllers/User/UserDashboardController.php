<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\UserWallet;
use App\Models\WasteDeposit;
use App\Models\WasteDepositDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Wallet
        |--------------------------------------------------------------------------
        */

        $wallet = UserWallet::where('user_id', $user->id)->first();

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalWeight = WasteDeposit::where('user_id', $user->id)
            ->where('status', 'Selesai')
            ->sum('total_weight');

        $totalTransaction = WasteDeposit::where('user_id', $user->id)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Riwayat Setoran
        |--------------------------------------------------------------------------
        */

        $latestDeposits = WasteDeposit::with('details.category')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Reward Terbaru
        |--------------------------------------------------------------------------
        */

        $rewards = Reward::latest()
            ->take(4)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Grafik Setoran 6 Bulan
        |--------------------------------------------------------------------------
        */

        $chart = WasteDeposit::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_weight) as total')
            )
            ->where('user_id', $user->id)
            ->where('status', 'Selesai')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Komposisi Sampah
        |--------------------------------------------------------------------------
        */

        $composition = WasteDepositDetail::select(
                'category_id',
                DB::raw('SUM(weight) as total')
            )
            ->whereHas('deposit', function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->where('status', 'Selesai');
            })
            ->with('category')
            ->groupBy('category_id')
            ->get();

        return view('user.dashboard', compact(
            'wallet',
            'totalWeight',
            'totalTransaction',
            'latestDeposits',
            'rewards',
            'chart',
            'composition'
        ));
    }
}
