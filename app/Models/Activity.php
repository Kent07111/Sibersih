<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [

        'judul',

        'slug',

        'thumbnail',

        'kategori',

        'tanggal',

        'lokasi',

        'isi',

        'status',

        'created_by'

    ];

    protected $casts = [

        'tanggal' => 'date',

    ];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function images()
    {
        return $this->hasMany(ActivityImage::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
