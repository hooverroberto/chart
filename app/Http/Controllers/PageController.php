<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function charts()
    {
        $reportes = Reporte::all();

        $data = [];

        foreach ($reportes as $reporte) {
            $data['label'][] = $reporte->nom_empleado;
            $data['data'][] = $reporte->rendimiento;
        }
        $data['data'] = json_encode($data);
        return view('pages.charts', $data);
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
