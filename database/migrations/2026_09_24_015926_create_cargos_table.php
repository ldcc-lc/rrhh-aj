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
        Schema::create('cargos', function (Blueprint $table) {
            $table->id('id_cargo');
            $table->foreignId('id_unidad')
            ->constrained('unidades_organizacionales', 'id_unidad')
            ->onDelete('cascade');

            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_actualizacion')->nullable();
            $table->timestamp('fecha_eliminacion')->nullable();

            //restricciones
            $table->unique(['id_unidad', 'nombre'], 'uk_cargo_unidad_nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
