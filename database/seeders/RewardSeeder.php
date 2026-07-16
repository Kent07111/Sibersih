<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    public function run(): void
    {

        Reward::insert([

            [

                'code'=>'RWD001',

                'name'=>'Pulsa Rp10.000',

                'type'=>'Pulsa',

                'required_point'=>100,

                'nominal'=>10000,

                'stock'=>100,

                'is_active'=>true,

                'created_at'=>now(),

                'updated_at'=>now(),

            ],

            [

                'code'=>'RWD002',

                'name'=>'Voucher Belanja',

                'type'=>'Voucher',

                'required_point'=>200,

                'nominal'=>20000,

                'stock'=>50,

                'is_active'=>true,

                'created_at'=>now(),

                'updated_at'=>now(),

            ],

            [

                'code'=>'RWD003',

                'name'=>'Uang Tunai',

                'type'=>'Uang',

                'required_point'=>500,

                'nominal'=>50000,

                'stock'=>999,

                'is_active'=>true,

                'created_at'=>now(),

                'updated_at'=>now(),

            ],

        ]);

    }
}
