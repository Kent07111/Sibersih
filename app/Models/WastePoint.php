<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WastePoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'jenis',
        'alamat',
        'latitude',
        'longitude',
        'deskripsi',
        'foto',
        'status',
        'created_by',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
