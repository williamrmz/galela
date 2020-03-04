<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'vw_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function empleado()
    {
        return $this->belongsTo('App\Model\Empleados', 'id_empleado', 'IdEmpleado');
    }


    public function image()
    {
        return url('/storage/images/users/USER_DEFAULT.PNG');
    }


    public function tieneRol($nombreRol)
    {
        $data = \DB::table('UsuariosRoles as ur')
            ->leftJoin('roles as r', 'r.idRol', 'ur.idRol')
            ->where('ur.idEmpleado', $this->id_empleado)
            ->where('r.nombre', trim($nombreRol))
            ->count();
        return $data;
    }

    public function tieneAccion($nombreAccion, $nombreItem)
    {
        $response = 0;
        $accion = strtoupper($nombreAccion);
        if( $accion=='AGREGAR' || $accion=='MODIFICAR' || $accion=='ELIMINAR' || $accion=='CONSULTAR'){
            $query = \DB::table('rolesItems as ri')
                ->leftJoin('listBarItems as bi', 'bi.idListItem', 'ri.idListItem')
                ->whereRaw("ri.idRol IN (SELECT idRol from usuariosRoles where idEmpleado = $this->id_empleado)")
                ->whereRaw("bi.Texto COLLATE Latin1_General_CI_AI = '$nombreItem' COLLATE Latin1_General_CI_AI");

            if($accion=='AGREGAR') $query->where('ri.agregar', 1);
            if($accion=='MODIFICAR') $query->where('ri.modificar', 1);
            if($accion=='ELIMINAR') $query->where('ri.eliminar', 1);
            if($accion=='CONSULTAR') $query->where('ri.agregar', 1);
            // dd($query->get());
            $response = $query->count()? 1: 0;
        }
        return $response;
    }

    public function tieneCargo($nombreCargo)
    {
        $data = \DB::table('EmpleadosCargos as ec')
            ->leftJoin('TiposCargo as tc', 'tc.idTipoCargo', 'ec.idCargo')
            ->where('ec.idEmpleado', $this->id_empleado)
            ->where('tc.cargo', trim($nombreCargo))
            ->count();
        return $data;
    }

    public function menu()
    {
        $data = \DB::table('RolesItems as ri')
            ->leftJoin('ListBarItems as bi', 'bi.idListItem', 'ri.idListItem')
            ->leftJoin('ListBarGrupos as bg', 'bg.idListGrupo', 'bi.idListGrupo')
            ->whereRaw("ri.idRol IN (SELECT IdRol FROM UsuariosRoles WHERE IdEmpleado=$this->id_empleado)")
            ->select(
                'bg.idListGrupo as grupoId', 'bg.controller as grupoController','bg.Texto as grupoNombre'
                , 'bg.Indice as grupoIndice', 'bg.Clave as grupoClave'
                ,'bi.IdListItem as itemId', 'bi.controller as itemController', 'bi.Texto as itemNombre'
                , 'bi.Indice as itemIndice', 'bi.Clave as itemClave', 'bi.KeyIcon as itemIcon', 'bi.iconWeb')
            ->groupBy('bg.idListGrupo', 'bg.controller', 'bg.Texto', 'bg.Indice', 'bg.Clave', 'bi.IdListItem'
                , 'bi.controller', 'bi.Texto', 'bi.Indice', 'bi.Clave', 'bi.KeyIcon', 'bi.iconWeb')
            ->orderBy('bg.Indice', 'asc')
            ->orderBy('bi.Indice', 'asc')
            ->get();

        $items = [];
        foreach ($data as $row)
        {

            $items[$row->grupoClave]['id'] = $row->grupoId;
            $items[$row->grupoClave]['key'] = $row->grupoClave;
            $items[$row->grupoClave]['index'] = $row->grupoIndice;
            $items[$row->grupoClave]['label'] = $row->grupoNombre;
            $items[$row->grupoClave]['url'] = '/'.camelToMiddledash($row->grupoController);
            $items[$row->grupoClave]['icon'] = 'fa fa-th-large';
            $items[$row->grupoClave]['items'][] = [
                'id' => $row->itemId,
                'key' => $row->grupoClave.'.'.$row->itemClave,
                'index' => $row->itemIndice,
                'label' => $row->itemNombre,
                'icon' => $row->iconWeb,
                'url' => '/'.camelToMiddledash($row->grupoController).'/'.camelToMiddledash($row->itemController),
            ];
        }
        // dd($items);
        return $items;
    }


    public function mapMenuLaravel()
    {

    }
}
