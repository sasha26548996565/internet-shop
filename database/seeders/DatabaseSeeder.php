<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(PropertyOptionSeeder::class);
        $this->call(UserSeeder::class);
    }
}
