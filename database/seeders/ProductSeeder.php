<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $json = file_get_contents(base_path('database/seeders/products.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            \App\Models\Product::create((array)$item);
        }
    }
}
