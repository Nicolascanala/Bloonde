<?php

namespace Database\Seeders;

use App\Models\Hobbie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HobbieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hobbie::factory()
            ->count(10)
            ->create();
    }
}
