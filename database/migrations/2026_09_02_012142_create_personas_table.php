<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id('id_persona');
            $table->string('carnet', 20);
            $table->string('complementario', 10)->nullable();
            $table->string('nombres', 50);
            $table->string('apellido_paterno', 20)->nullable();
            $table->string('apellido_materno', 20)->nullable();
            $table->string('apellido_casado', 10)->nullable();
            $table->string('celular', 20)->nullable();
            $table->enum('genero', ['femenino','masculino']);
            $table->date('fecha_nacimiento');
            $table->string('estado_civil', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->integer('estado')->default(1);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_actualizacion')->nullable();

            //restricciones
            $table->unique(['carnet', 'complementario'],'uk_persona_carnet_complementario');
        });

        DB::statement('
        ALTER TABLE personas
        ADD CONSTRAINT ck_personas_apellido
        CHECK (apellido_paterno IS NOT NULL OR apellido_materno IS NOT NULL)
        ');

        DB::statement('
            CREATE UNIQUE INDEX uk_personas_carnet_sin_complementario
            ON personas (carnet)
            WHERE complementario IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
