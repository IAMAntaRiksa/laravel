<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::create([
            'username' => 'admin@gmail.com',
            'name' => 'Administrator',
            'password' => bcrypt('password'),
            'api_token' => Hash::make(Str::random(40)),
        ]);
        return $user;
    }
}
