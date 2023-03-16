<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\Fecha;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadoRendimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fechas = Fecha::all();

        $idsFechas = [];

        for ($i = 0; $i < count($fechas); $i++) {
            $idsFechas[$i] = $fechas[$i]->id;
        }

        $empleados = Empleado::all();

        $idsEmpleados = [];

        for ($i = 0; $i < count($empleados); $i++) {
            $idsEmpleados[$i] = $empleados[$i]->id;
        }

        foreach ($idsFechas as $idFecha) {
            foreach ($idsEmpleados as $idEmpleado) {
                DB::table('empleado_rendimientos')->insert([
                    'empleado_id' => $idEmpleado,
                    'fecha_id' => $idFecha,
                    'rendimiento' => fake()->numberBetween(0, 100)
                ]);
            }
        }
    }
}
