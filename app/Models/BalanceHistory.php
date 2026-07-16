<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function wallet()
    {
        return $this->belongsTo(UserWallet::class, 'wallet_id');
    }

    public function deposit()
    {
        return $this->belongsTo(WasteDeposit::class, 'deposit_id');
    }

    public function redemption()
    {
        return $this->belongsTo(RewardRedemption::class, 'redemption_id');
    }
}
