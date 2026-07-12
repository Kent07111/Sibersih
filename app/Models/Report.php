<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [

        'processed_at' => 'datetime',

    ];

    public function wastePoint()
    {
        return $this->belongsTo(WastePoint::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class,'processed_by');
    }

}