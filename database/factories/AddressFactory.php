<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // database/factories/AddressFactory.php

    public function definition(): array
    {
        return [
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'post_code' => $this->faker->postcode(),
            'street' => $this->faker->streetAddress(),
        ];
    }

}
