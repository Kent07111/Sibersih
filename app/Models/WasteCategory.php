<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WasteCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function prices()
    {
        return $this->hasMany(WastePrice::class, 'category_id');
    }
public function activePrice()
{
    return $this->hasOne(WastePrice::class, 'category_id')
        ->where('is_active', true);
}
    public function stock()
    {
        return $this->hasOne(WasteStock::class, 'category_id');
    }

    public function depositDetails()
    {
        return $this->hasMany(WasteDepositDetail::class, 'category_id');
    }
}