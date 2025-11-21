<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (!User::where("role", "developer")->exists()) {
            User::create([
                'name' => 'Developer',
                'email' => 'dev123@gmail.com',
                'password' => Hash::make('dev123'),
                'role' => 'developer', 
            ]);
        }
    }
}
