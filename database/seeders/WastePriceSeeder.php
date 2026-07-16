<?php

namespace Database\Seeders;

use App\Models\WasteCategory;
use App\Models\WastePrice;
use Illuminate\Database\Seeder;

class WastePriceSeeder extends Seeder
{
    public function run(): void
    {
        $prices = [

            'ORG' => [1000,10],
            'PLS' => [2500,25],
            'KRT' => [1800,18],
            'KLG' => [5000,50],
            'KCA' => [1500,15],
            'BSI' => [6000,60],

        ];

        foreach ($prices as $code => $value) {

            $category = WasteCategory::where('code',$code)->first();

            WastePrice::create([

                'category_id' => $category->id,

                'price_per_kg' => $value[0],

                'point_per_kg' => $value[1],

                'effective_date' => now(),

                'is_active' => true,

            ]);

        }
    }
}
