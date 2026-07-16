<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserWallet extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'balance' => 'decimal:2',
        'last_transaction_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pointHistories()
    {
        return $this->hasMany(PointHistory::class, 'wallet_id');
    }

    public function balanceHistories()
    {
        return $this->hasMany(BalanceHistory::class, 'wallet_id');
    }
}
