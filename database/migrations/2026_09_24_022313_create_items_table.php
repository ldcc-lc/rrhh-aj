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
        Schema::create('items', function (Blueprint $table) {
            $table->id('id_item');
            $table->foreignId('id_cargo')
            ->constrained('cargos','id_cargo')
            ->onDelete('cascade');
            $table->string('codigo',50);
            $table->decimal('salario_base', 12,2);
            $table->tinyInteger('estado')->default(1);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_actualizacion')->nullable();
            $table->timestamp('fecha_eliminacion')->nullable();

            //restricciones
            $table->unique('codigo', 'uk_item_codigo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
