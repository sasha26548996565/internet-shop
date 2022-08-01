<?php

namespace Database\Seeders;

use App\Models\PropertyOption;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PropertyOptionSeeder extends Seeder
{
    public function run()
    {
        PropertyOption::factory(50)->create();
    }
}
