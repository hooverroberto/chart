<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\EmpleadoRendimiento;
use App\Models\Fecha;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function charts()
    {
        // $reportes = Reporte::all();


        return view('pages.charts');
        // return $empleadosFiltrado;
    }

    public function add(Request $data)
    {
        $data->validate([
            'name' => 'required',
            'performance' => 'required'
        ]);

        $newEmployee = new Reporte();
        $newEmployee->nom_empleado = $data->name;
        $newEmployee->rendimiento = $data->performance;
        $newEmployee->save();

        return redirect()->route("pages.charts")->with("success", "¡Subido satisfactoriamente!");
    }
}
