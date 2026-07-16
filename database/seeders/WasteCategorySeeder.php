<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WasteCategory;

class WasteCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            [
                'code' => 'ORG',
                'name' => 'Organik',
                'description' => 'Sampah organik',
            ],

            [
                'code' => 'PLS',
                'name' => 'Plastik',
                'description' => 'Botol, gelas, plastik',
            ],

            [
                'code' => 'KRT',
                'name' => 'Kertas',
                'description' => 'Kertas dan kardus',
            ],

            [
                'code' => 'KLG',
                'name' => 'Kaleng',
                'description' => 'Kaleng aluminium',
            ],

            [
                'code' => 'KCA',
                'name' => 'Kaca',
                'description' => 'Botol kaca',
            ],

            [
                'code' => 'BSI',
                'name' => 'Besi',
                'description' => 'Besi tua',
            ],

        ];

        foreach ($categories as $category) {

            WasteCategory::create([
                ...$category,
                'is_active' => true,
            ]);

        }
    }
}
