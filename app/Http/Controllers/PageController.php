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
        $fechas = Fecha::all();

        if (isset($_GET["fecha"])) {
            $fechaId = $_GET["fecha"];
            $empleadosFiltrado = DB::table("empleado_rendimientos")
                ->where("fecha_id", $fechaId)
                ->join("empleados", "empleado_rendimientos.empleado_id", "=", "empleados.id")
                ->join("fechas", "empleado_rendimientos.fecha_id", "=", "fechas.id")
                ->get();
        } else {
            $ultimaFecha = count($fechas);
            $empleadosFiltrado = DB::table("empleado_rendimientos")
                ->where("fecha_id", $ultimaFecha)
                ->join("empleados", "empleado_rendimientos.empleado_id", "=", "empleados.id")
                ->join("fechas", "empleado_rendimientos.fecha_id", "=", "fechas.id")
                ->get();
        }

        $data = [];

        foreach ($empleadosFiltrado as $reporte) {
            $data['label'][] = $reporte->nombre;
            $data['data'][] = $reporte->rendimiento;
        }

        $dataJson = json_encode($data);

        return view('pages.charts', [
            "data" => $data,
            'dataJson' => $dataJson,
            "empleadosFiltrado" => $empleadosFiltrado,
            "fechas" => $fechas,
            "empleados" => Empleado::all()
        ]);
    }

    public function addEmployee(Request $data)
    {
        $data->validate([
            'name' => 'required',
        ]);

        $newEmployee = new Empleado();
        $newEmployee->nombre = $data->name;
        $newEmployee->save();

        return redirect()->route("pages.charts")->with("success", "¡Subido satisfactoriamente!");
    }

    public function deleteEmployee(Request $data)
    {
        $empleado = Empleado::find($data->id);

        $empleado->delete();


        return redirect()->route("pages.charts")->with("deleted", "¡Eliminado satisfactoriamente!");
    }

    public function addChart(Request $data)
    {
        $data->validate([
            "fecha" => 'required',
        ]);

        $nuevaFecha = new Fecha();
        $nuevaFecha->fecha = $data->fecha;
        $nuevaFecha->save();

        $fechaCreada = Fecha::where("fecha", $data->fecha)->first();
        $idFechaCreada = $fechaCreada->id;

        for ($i = 0; $i < count($data->empleados); $i++) {
            $nuevoEmpleadoRendimientos = new EmpleadoRendimiento();
            $nuevoEmpleadoRendimientos->empleado_id = $data->empleados[$i]["ID"];
            $nuevoEmpleadoRendimientos->fecha_id = $idFechaCreada;
            $nuevoEmpleadoRendimientos->rendimiento = $data->empleados[$i]["rendimiento"];
            $nuevoEmpleadoRendimientos->save();
        }

        $_GET["fecha"] = $idFechaCreada;

        return redirect()->route("pages.charts")->with("successChart", "¡Gráfico creado satisfactoriamente!");
    }
}
