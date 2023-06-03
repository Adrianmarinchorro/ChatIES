<?php

namespace Database\Factories;

use App\Models\History;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $iteracion = $this->faker->randomElement([1, 2, 3, 4]);
        $mensaje = [];

        for ($i = 0; $i <= $iteracion; $i++) {
           $mensaje[] = [
                'request' => $this->faker->sentence(),
                'response' => $this->faker->sentence($iteracion),
            ];
        }

        return [
            'history_id' => History::all()->random()->id,
            'data' => json_encode($mensaje),
        ];
    }
}
