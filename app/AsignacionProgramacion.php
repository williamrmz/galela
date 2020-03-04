<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionProgramacion extends Model
{
    protected $table = 'AsignacionProgramacion';
    public $timestamps = false;
    protected $primaryKey = "IdAsignacion";
    protected $fillable =
        [
            "IdAsignacion",
            "IdRol",
            "IdEmpleado",
            "IdMedico",
            "IdDepartamento",
            "IdServicio",
            "FechaCreacion",
            "FechaModificacion",
            "FechaBajaRegistro",
            "Vigencia",
        ];
}
