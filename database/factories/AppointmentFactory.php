<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::first()->id,
            'patient_id' => Patient::inRandomOrder()->first()->id,
            'date' => Carbon::createFromTimestamp(
                $this->faker->dateTimeBetween('2025-01-01', now())->getTimestamp()
            )->toDateString(),
            'time' => $this->faker->time(),
            'duration' => $this->faker->numberBetween(15, 60),
            'status' => $this->faker->randomElement(['Future', 'In the waiting room', 'In progress', 'Seen', 'Canceled', 'Not honored']),
        ];
    }
}
