<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\RewardRedemption;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class RewarduController extends Controller
{
    public function index()
    {
        $wallet = UserWallet::where(
            'user_id',
            Auth::id()
        )->first();

        $rewards = Reward::where(
            'is_active',
            true
        )
        // ->orderBy('point_required')
        ->orderBy('required_point')
        ->get();

        $histories = RewardRedemption::with('reward')
            ->where(
                'user_id',
                Auth::id()
            )
            ->latest()
            ->take(5)
            ->get();

        return view(
            'user.rewards.index',
            [

                'wallet'=>$wallet,

                'rewards'=>$rewards,

                'histories'=>$histories

            ]
        );
    }

    public function redeem(Reward $reward)
    {

        $wallet = UserWallet::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        if($$wallet->point < $reward->required_point){

            return back()->with(
                'error',
                'Poin Anda tidak mencukupi.'
            );

        }

        DB::transaction(function() use(
            $wallet,
            $reward
        ){

            RewardRedemption::create([

                'redemption_number'=>'RWD-'.now()->format('YmdHis').Str::random(4),

                'user_id'=>Auth::id(),

                'reward_id'=>$reward->id,

                // 'used_point'=>$reward->point_required,
                'used_point'=>$reward->required_point,

                'status'=>'Menunggu',

                'redeemed_at'=>now()

            ]);

            $wallet->decrement(
                'point',
                // $reward->point_required
                $reward->required_point
            );

        });

        return back()->with(
            'success',
            'Penukaran reward berhasil.'
        );

    }

    public function history()
    {

        $histories = RewardRedemption::with('reward')
            ->where(
                'user_id',
                Auth::id()
            )
            ->latest()
            ->paginate(10);

        return view(
            'user.rewards.history',
            compact('histories')
        );

    }
}
