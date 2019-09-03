<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    
    protected $table = "Empleados";

    protected $primaryKey = 'IdEmpleado';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'IdEmpleado');
    }


    public function tipoEmpleado()
    {
        return $this->belongsTo('App\Model\TiposEmpleado', 'IdTipoEmpleado', 'IdTipoEmpleado');
    }


    public function Fullname()
    {
        return $this->Nombres . " ". $this->ApellidoPaterno . " " . $this->ApellidoMaterno;
    }

    public function scopeFiltro($query, $filtro)
    {
        $filtro = str_replace(' ', '', $filtro);
        if( $filtro != null)
        {
            $query->whereRaw("REPLACE(Nombres+ApellidoPaterno+ApellidoMaterno, ' ', '') LIKE '%$filtro%' ");
            $query->orWhere("DNI", "LIKE", "%$filtro%");
        }
    }


    public function cargos()
    {
        //Empleados //
        return $this->hasManyThrough(
            'App\Model\TiposCargo',  //idTipoCargo (posts)
            'App\Model\EmpleadosCargos', //idEmpleado, idCargo (users)
            'idEmpleado', // Foreign key on EmpleadosCargos table...
            'idTipoCargo', // Foreign key on TiposCargo table...
            'IdEmpleado', // Local key on Empleados table...
            'idCargo' // Local key on EmpleadosCargos table...
        );
    }

    public function roles()
    {
        return $this->hasManyThrough(
            'App\Model\Roles',
            'App\Model\UsuariosRoles',
            'IdEmpleado',
            'IdRol',
            'IdEmpleado',
            'IdRol'
        );
    }

    public function laboraSubAreas()
    {
        return $this->hasManyThrough(
            'App\Model\Roles',
            'App\Model\EmpleadosLugarDeTrabajo',
            'IdEmpleado',
            'IdRol',
            'IdEmpleado',
            'IdRol'
        );
    }

    public function getPathFirma()
    {
        return base_path('storage/images/firmas/'.$this->Firma);
    }

    public function getFoto()
    {
        return url('/storage/images/users/USER_DEFAULT.PNG');
    }
}
