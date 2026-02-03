<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ClearSeederDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    \App\Models\Product::truncate();
    \App\Models\Category::truncate();
    \App\Models\Store::truncate();


    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
