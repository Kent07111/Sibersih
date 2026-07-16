<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteDeposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'user_id',
        'admin_id',
        'deposit_date',
        'total_weight',
        'total_price',
        'total_point',
        'status',
        'note',
        'validated_at',
    ];

    protected $casts = [
        'deposit_date' => 'date',
        'validated_at' => 'datetime',
        'total_weight' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // Nasabah
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Admin Validator
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Detail Setoran
    public function details()
    {
        return $this->hasMany(WasteDepositDetail::class, 'deposit_id');
    }

    // Histori Point
    public function pointHistories()
    {
        return $this->hasMany(PointHistory::class, 'deposit_id');
    }

    // Histori Saldo
    public function balanceHistories()
    {
        return $this->hasMany(BalanceHistory::class, 'deposit_id');
    }
}
