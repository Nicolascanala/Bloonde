<?php

namespace Database\Factories;

use App\Models\Hobbie;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerHobbie>
 */
class CustomerHobbieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'hobbie_id' => Hobbie::inRandomOrder()->first()->id
        ];
    }
}
