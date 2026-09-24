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
        Schema::create('relaciones_laborales', function (Blueprint $table) {
            $table->id('id_relacion_laboral');
            $table->foreignId('id_persona')
            ->constrained('personas', 'id_persona')
            ->onDelete('restrict');

            $table->enum('tipo_relacion', ['funcionario', 'consultor']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();

            $table->tinyInteger('estado')->default(1);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_actualizacion')->nullable();
            $table->timestamp('fecha_eliminacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relaciones_laborales');
    }
};
