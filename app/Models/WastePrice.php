<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WastePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'price_per_kg',
        'point_per_kg',
        'effective_date',
        'expired_date',
        'is_active',
    ];

    protected $casts = [
        'price_per_kg' => 'decimal:2',
        'effective_date' => 'date',
        'expired_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(WasteCategory::class, 'category_id');
    }
}
