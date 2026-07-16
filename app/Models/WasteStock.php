<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WasteStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'current_weight',
        'last_updated_at',
    ];

    protected $casts = [
        'current_weight' => 'decimal:2',
        'last_updated_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(WasteCategory::class, 'category_id');
    }
}
