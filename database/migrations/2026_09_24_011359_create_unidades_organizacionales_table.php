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
        Schema::create('unidades_organizacionales', function (Blueprint $table) {
            $table->id('id_unidad');

            $table->foreignId('id_sede')
            ->constrained('sedes', 'id_sede')
            ->onDelete('cascade');

            $table->foreignId('id_unidad_padre')
            ->nullable()
            ->constrained('unidades_organizacionales', 'id_unidad')
            ->onDelete('set null');

            $table->string('nombre', 150);
            $table->string('sigla', 20)->nullable();
            $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('unidades_organizacionales');
    }
};
