<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermisoProgramacion extends Model
{
    protected $table = 'PermisoProgramacion';
    public $timestamps = false;
    protected $primaryKey = "IdPermiso";
    protected $fillable =
        [
            "IdPermiso",
            "Codigo",
            "Descripcion",
        ];
}
