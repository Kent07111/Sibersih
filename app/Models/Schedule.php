<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [

        'judul',

        'tanggal',

        'jam',

        'lokasi',

        'keterangan',

        'status'

    ];

    protected $casts = [

        'tanggal' => 'date',

        'jam' => 'datetime:H:i'

    ];

    public function getHariAttribute()
    {
        return Carbon::parse($this->tanggal)
            ->translatedFormat('l');
    }
}
