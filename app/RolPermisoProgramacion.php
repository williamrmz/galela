<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolPermisoProgramacion extends Model
{
    protected $table = 'RolPermisoProgramacion';
    public $timestamps = false;
    protected $primaryKey = "IdRolPermiso";
    protected $fillable =
        [
            "IdRolPermiso",
            "IdPermiso",
            "IdRol",
            "Vigencia",
        ];
}
