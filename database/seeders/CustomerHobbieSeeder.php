<?php

namespace Database\Seeders;

use App\Models\CustomerHobbie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerHobbieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerHobbie::factory()
            ->count(20)
            ->create();
    }
}
