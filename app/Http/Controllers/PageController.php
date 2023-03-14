<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display icons page
     *
     * @return \Illuminate\View\View
     */
    public function icons()
    {
        return view('pages.icons');
    }

    /**
     * Display maps page
     *
     * @return \Illuminate\View\View
     */
    public function maps()
    {
        return view('pages.maps');
    }

    /**
     * Display tables page
     *
     * @return \Illuminate\View\View
     */
    public function tables()
    {
        return view('pages.tables');
    }

    /**
     * Display notifications page
     *
     * @return \Illuminate\View\View
     */
    public function notifications()
    {
        return view('pages.notifications');
    }

    /**
     * Display rtl page
     *
     * @return \Illuminate\View\View
     */
    public function rtl()
    {
        return view('pages.rtl');
    }

    /**
     * Display typography page
     *
     * @return \Illuminate\View\View
     */
    public function typography()
    {
        return view('pages.typography');
    }

    /**
     * Display upgrade page
     *
     * @return \Illuminate\View\View
     */
    public function upgrade()
    {
        return view('pages.upgrade');
    }

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
