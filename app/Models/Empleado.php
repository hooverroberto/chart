<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function fechas() {
        return $this->belongsToMany(Fecha::class, "empleado_rendimientos", "empleado_id", "fecha_id", "id", "id")->withPivot("rendimiento");
    }
}
