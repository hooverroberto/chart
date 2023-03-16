<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function empleados() {
        return $this->belongsToMany(Fecha::class, "empleado_rendimientos", "empleado_id", "fecha_id", "id", "id")->withPivot("rendimiento");
    }
}
