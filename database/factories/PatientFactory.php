<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'date_of_birth' => $this->faker->date(),
            'owner_id' => Owner::factory(),
            'type' => $this->faker->randomElement(['Dog', 'Cat', 'Rabbit']),
        ];
    }
}
