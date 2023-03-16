<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\Fecha;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Empleado::factory(5)->create();
        Fecha::factory(5)->create();

        $this->call([
            UsersTableSeeder::class,
            ReporteSeeder::class,
            EmpleadoRendimientoSeeder::class
        ]);
    }
}
