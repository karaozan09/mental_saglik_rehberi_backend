<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'full_name' => 'Büşra Karaozan Çelik',
                'email' => 'busrakaraozanb@gmail.com',
                'phone_number' => '0532 382 01 73',
                'password' => Hash::make('123456'),
            ],
        ]);
    }
}
