<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory;
    protected $table = 'educations';
    protected $fillable = [

        'judul',

        'slug',
        'excerpt',
        'kategori',

        'thumbnail',

        'isi',

        'video_url',

        'pdf',

        'status',

        'created_by'

    ];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
