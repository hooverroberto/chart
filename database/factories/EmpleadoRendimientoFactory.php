<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\Fecha;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmpleadoRendimiento>
 */
class EmpleadoRendimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechas = Fecha::all();

        $ids = [];
        
        for ($i=0; $i < count($fechas); $i++) { 
            $ids[$i] = $fechas[$i]->id;
        }
        
        
        return [
            'empleado_id' => Empleado::all()->random()->id,
            'fecha_id' => Fecha::all()->random()->id,
            'rendimiento' => fake()->numberBetween(0, 100)
        ];
    }
}
