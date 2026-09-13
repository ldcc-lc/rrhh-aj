<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Persona;
use App\Rules\UniqueCarnet;
use Illuminate\Validation\Rule;


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
            'carnet' => ['required', 'string', 'max:10', new UniqueCarnet],
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


    public function update(Request $request, Persona $persona)
    {
        $validated = $request->validate([
            'carnet' => ['required', 'string', 'max:20', new UniqueCarnet($persona->id_persona)],
            'complementario' => ['nullable', 'string', 'max:10'],
            'nombres' => ['required', 'string', 'max:50'],
            'apellido_paterno' => [ 'nullable', 'string', 'max:20', 'required_without:apellido_materno',],
            'apellido_materno' => [ 'nullable', 'string', 'max:20', 'required_without:apellido_paterno',],
            'apellido_casado' => ['nullable', 'string', 'max:10'],
            'celular' => ['nullable', 'string', 'max:20'],
            'genero' => ['nullable', 'in:femenino,masculino'],
            'fecha_nacimiento' => ['nullable', 'date'],
            'estado_civil' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],
        ]);

        $persona->update($validated);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Persona actualizada correctamente.',
        ]);

        return to_route('personas.index');
    }

    public function inactivate(Persona $persona)
    {
        $persona->update([
        'estado' => 0,
        ]);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Persona inactivada correctamente.',
        ]);

        return to_route('personas.index');
    }

    public function activate(Persona $persona)
    {
        $persona->update([
        'estado' => 1,
        ]);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Persona activada correctamente.',
        ]);

        return to_route('personas.index');
    }
}
