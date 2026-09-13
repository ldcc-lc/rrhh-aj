<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;
    protected $table = 'personas';
    protected $primaryKey = 'id_persona';

    public const CREATED_AT = 'fecha_creacion';
    public const UPDATED_AT = 'fecha_actualizacion';
    public const DELETED_AT = 'fecha_eliminacion';

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
