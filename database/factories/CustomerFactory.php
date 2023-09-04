<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => substr($this->faker->name(), 1, 15),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => 'Calle 63D #30-67',
            'cellphone' => $this->faker->numerify('000000000'),
        ];
    }
}
