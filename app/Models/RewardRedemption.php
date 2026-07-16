<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardRedemption extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'redeemed_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // User yang menukar
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Reward yang dipilih
    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }

    // Admin yang menyetujui
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Riwayat point
    public function pointHistories()
    {
        return $this->hasMany(PointHistory::class, 'redemption_id');
    }

    // Riwayat saldo
    public function balanceHistories()
    {
        return $this->hasMany(BalanceHistory::class, 'redemption_id');
    }
}