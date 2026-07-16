<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ==========================
        // ADMIN
        // ==========================
        $admin = User::create([
            'name'       => 'test',
            'username'   => 'test',
            'email'      => 'test@sibersih.com',
            'role'       => 'admin',
            'password'   => Hash::make('password'),
            'last_login' => now(),
        ]);

        UserProfile::create([
            'user_id'       => $admin->id,
            'member_number' => 'ADM0001',
            'nik'           => '3201000000000001',
            'phone'         => '081234567890',
            'gender'        => 'Laki-laki',
            'birth_date'    => '1995-01-01',
            'address'       => 'Kantor Bank Sampah',
            'status'        => 'Aktif',
        ]);

        // ==========================
        // USER 1
        // ==========================
        $user1 = User::create([
            'name'     => 'Budi Santoso',
            'username' => 'budi',
            'email'    => 'budi@example.com',
            'role'     => 'user',
            'password' => Hash::make('password'),
        ]);

        UserProfile::create([
            'user_id'       => $user1->id,
            'member_number' => 'AGT0001',
            'nik'           => '3201000000000002',
            'phone'         => '081111111111',
            'gender'        => 'Laki-laki',
            'birth_date'    => '1998-05-10',
            'address'       => 'Karawang',
            'status'        => 'Aktif',
        ]);

        // ==========================
        // USER 2
        // ==========================
        $user2 = User::create([
            'name'     => 'Siti Aisyah',
            'username' => 'siti',
            'email'    => 'siti@example.com',
            'role'     => 'user',
            'password' => Hash::make('password'),
        ]);

        UserProfile::create([
            'user_id'       => $user2->id,
            'member_number' => 'AGT0002',
            'nik'           => '3201000000000003',
            'phone'         => '082222222222',
            'gender'        => 'Perempuan',
            'birth_date'    => '2000-08-15',
            'address'       => 'Karawang',
            'status'        => 'Aktif',
        ]);
    }
}