<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\factura>
 */
class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nitVendedor' => $this->faker->numerify('##########'),
            'nombreVendedor' => $this->faker->name(),
            'nitComprador' => $this->faker->numerify('##########'),
            'nombreComprador' => $this->faker->name(),
            'price' => 10.000,
            'iva' => 1.900,
            'total' => 11.900,
            'estado' => 'F'
        ];
    }
}
