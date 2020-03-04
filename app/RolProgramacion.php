<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolProgramacion extends Model
{
    protected $table = 'RolProgramacion';
    public $timestamps = false;
    protected $primaryKey = "IdRol";
    protected $fillable =
        [
            "IdRol",
            "Codigo",
            "Descripcion",
        ];
}
