<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Persona;


class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::all();

        return Inertia::render('Personas/Index', [
            'personas' => $personas,
        ]);
    }

    public function store(Request $request)
    {
        //Validacion
        $validated = $request->validate([
            'carnet' => ['required', 'string', 'max:10'],
            'complementario' => ['nullable', 'string', 'max:5'],

            'nombres' => ['required', 'string', 'max:50'],

            'apellido_paterno' => ['nullable', 'string', 'max:20', 'required_without:apellido_materno'],
            'apellido_materno' => ['nullable', 'string', 'max:20', 'required_without:apellido_paterno'],
            'apellido_casado' => ['nullable', 'string', 'max:10'],

            'celular' => ['nullable', 'string', 'max:20'],

            'genero' => ['required', 'in:femenino,masculino'],

            'fecha_nacimiento' => ['required', 'date'],

            'estado_civil' => ['nullable', 'string', 'max:20'],

            'email' => ['nullable', 'email', 'max:100'],
        ]);

        //Creacion
        Persona::create($validated);

        //Mensaje
        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Persona registrada correctamente.',
        ]);

        //Redireccionar al listado
        return to_route('personas.index');
    }


}
