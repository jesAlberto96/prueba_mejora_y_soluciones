<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\producto::factory()->create([
                'nombre' => "Producto $i",
                'price' => 30.000,
                'estado' => true,
            ]);
        }
    }
}
