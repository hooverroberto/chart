<?php

namespace App\Http\Livewire;

use App\Models\Fecha;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartIndex extends Component
{
    public $search = 1;

    public function all()
    {
        $empleadosFiltrado = DB::table("empleado_rendimientos")
            ->where("fecha_id", $this->search)
            ->join("empleados", "empleado_rendimientos.empleado_id", "=", "empleados.id")
            ->join("fechas", "empleado_rendimientos.fecha_id", "=", "fechas.id")
            ->get();

        $data = [];

        foreach ($empleadosFiltrado as $reporte) {
            $data['label'][] = $reporte->nombre;
            $data['data'][] = $reporte->rendimiento;
        }

        // $dataJson = json_encode($data);

        return response(json_encode($data), 200)->header('Content-type', 'text/plain');
    }

    public function render()
    {
        $fechas = Fecha::all();

        // if ($this->search !== "#") {
        //     $empleadosFiltrado = DB::table("empleado_rendimientos")
        //         ->where("fecha_id", 1)
        //         ->join("empleados", "empleado_rendimientos.empleado_id", "=", "empleados.id")
        //         ->join("fechas", "empleado_rendimientos.fecha_id", "=", "fechas.id")
        //         ->get();
        // } else {
        // }
        $empleadosFiltrado = DB::table("empleado_rendimientos")
            ->where("fecha_id", $this->search)
            ->join("empleados", "empleado_rendimientos.empleado_id", "=", "empleados.id")
            ->join("fechas", "empleado_rendimientos.fecha_id", "=", "fechas.id")
            ->get();

        $data = [];

        foreach ($empleadosFiltrado as $reporte) {
            $data['label'][] = $reporte->nombre;
            $data['data'][] = $reporte->rendimiento;
        }

        $dataJson = json_encode($data);

        return view('livewire.chart-index', [
            "data" => $data,
            'dataJson' => $dataJson,
            "empleadosFiltrado" => $empleadosFiltrado,
            "fechas" => $fechas,
            "search" => $this->search
        ]);
    }
}
