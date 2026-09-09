<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'id_persona';

    public const CREATED_AT = 'fecha_creacion';
    public const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'carnet',
        'complementario',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'apellido_casado',
        'celular',
        'genero',
        'fecha_nacimiento',
        'estado_civil',
        'email',
        'estado',
    ];
}
