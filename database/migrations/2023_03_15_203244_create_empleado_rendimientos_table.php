<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleado_rendimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("empleado_id")->constrained("empleados")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("fecha_id")->constrained("fechas")->cascadeOnDelete()->cascadeOnUpdate();
            $table->float("rendimiento");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado_rendimientos');
    }
};
