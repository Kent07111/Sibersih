<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            'nama_desa' => 'Desa Talagasari',
            'name' => 'Web Edukasi',
            'alamat' => 'Talagasari, Kec. Talagasari, Karawang, Jawa Barat 41381',
            'telepon' => '089533922669',
            'email' => 'test@gmail.com',
            'logo' => 'settings/DuC5s1ctAuvsH3jMFJlnsYGsc5ZcGfKGjSqe1gwB.png',
            'favicon' => 'settings/0xD4fOwJrjYYhmxPHvRqNirddLvH5QOKqod9BFdH.png',
            'banner' => 'settings/JseXtnamVrLlXGvI4wu9t9MnaJKnbBT32NZsmfNE.jpg',
            'hero_image' => 'settings/lmQnnPKM2AKH8L8dQX1mLv2JSY2p6b4VOWafKbFX.jpg',
            'tentang' => 'aszxdadasa',
            'facebook' => '-',
            'instagram' => '-',
            'youtube' => '-',
            'maps_embed' => '<iframe src="https://www.google.com/maps/embed?..."></iframe>',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}