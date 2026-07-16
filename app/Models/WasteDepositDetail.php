<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteDepositDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'deposit_id',
        'category_id',
        'category_name',
        'weight',
        'price_per_kg',
        'point_per_kg',
        'subtotal_price',
        'subtotal_point',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'price_per_kg' => 'decimal:2',
        'subtotal_price' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function deposit()
    {
        return $this->belongsTo(WasteDeposit::class, 'deposit_id');
    }

    public function category()
    {
        return $this->belongsTo(WasteCategory::class, 'category_id');
    }
}
