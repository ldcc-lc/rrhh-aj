<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;

class PersonaSeeder extends Seeder
{

    public function run(): void
    {
        Persona::create([
            'carnet' => '123456',
            'nombres' => 'Juan',
            'apellido_paterno' => 'Perez',
            'genero' => 'masculino',
            'fecha_nacimiento' => '1986-08-23',
            'estado_civil' => 'soltero',
            'estado' => 1,
        ]);

        Persona::create([
            'carnet' => '654321',
            'nombres' => 'Maria',
            'apellido_paterno' => 'Cabrera',
            'genero' => 'femenino',
            'fecha_nacimiento' => '1999-08-02',
            'estado_civil' => 'casado',
            'estado' => 1,
        ]);

    }
}
