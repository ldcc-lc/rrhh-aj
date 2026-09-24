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
        Schema::create('contratos_consultorias', function (Blueprint $table) {
            $table->id('id_contrato_consultoria');

            $table->foreignId('id_relacion_laboral')
            ->constrained('relaciones_laborales', 'id_relacion_laboral')
                ->onDelete('restrict');

            $table->string('numero_contrato', 50);
            $table->text('objeto_contrato')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('monto_total', 12, 2);
            $table->decimal('honorario_mensual', 12, 2)->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_actualizacion')->nullable();
            $table->timestamp('fecha_eliminacion')->nullable();
            //restricciones
            $table->unique('numero_contrato','uk_contrato_consultoria_numero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos_consultorias');
    }
};
