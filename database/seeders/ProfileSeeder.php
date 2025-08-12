<?php

namespace Database\Seeders;

use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserProfile::create([
            'first_name' => 'Admin',
            'user_id' => 1,
            'last_name' => 'dashboard',
            'address' => 'nowhere',
        ]);
    }
}
