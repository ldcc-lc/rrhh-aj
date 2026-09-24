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
        Schema::create('asignaciones_items', function (Blueprint $table) {
            $table->id('id_asignacion_item');

            $table->foreignId('id_relacion_laboral')
            ->constrained('relaciones_laborales', 'id_relacion_laboral')
            ->onDelete('restrict');

            $table->foreignId('id_item')
            ->constrained('items', 'id_item')
            ->onDelete('restrict');

            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->decimal('salario_mensual', 12, 2)->nullable();

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
        Schema::dropIfExists('asignaciones_items');
    }
};
