<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'star' => $this->faker->boolean,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'business_name' => $this->faker->domainName,
        ];
    }
}
