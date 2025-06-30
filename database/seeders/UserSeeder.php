<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => '00000000000@uniku.ac.id'],
            [
                'name' => 'Mahasiswa Baru',
                'password' => Hash::make(value: '00000000'),
                'role' => 'student',
            ]
        );
    }
}
