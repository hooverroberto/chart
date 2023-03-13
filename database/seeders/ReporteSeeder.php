<?php

namespace Database\Seeders;

use App\Models\Reporte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ReporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            array('nom_empleado'=>'Juan', 'rendimiento'=>3),
            array('nom_empleado'=>'Luis', 'rendimiento'=>5),
            array('nom_empleado'=>'Carlos', 'rendimiento'=>3),
            array('nom_empleado'=>'Monica', 'rendimiento'=>4),
            array('nom_empleado'=>'Rafael', 'rendimiento'=>2),
            array('nom_empleado'=>'Estela', 'rendimiento'=>3),
        ];
        Reporte::insert($data);
    }
}
