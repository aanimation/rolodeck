<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\{Brand, User};

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'Default Brand',
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            // 'password' => Hash::make('admin123--'),
            'brand_id' => 1,
            'is_admin' => true
        ]);
    }
}
