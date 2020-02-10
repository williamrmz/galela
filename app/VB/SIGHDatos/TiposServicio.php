<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposServicio extends Model
{
    protected $table = "TiposServicio";
    protected $primaryKey = "IdTipoServicio";
    protected $fillable = [
        "IdTipoServicio",
        "Descripcion"
    ];

    protected $appends = ["descripcion_larga"];

    public function getDescripcionLargaAttribute()
    {
        return $this->IdTipoServicio." = "." ".$this->Descripcion;
    }

    public static function SeleccionarProgramacionTurno()
    {
        return self::whereIn('IdTipoServicio', [1,2,3,4])->get();
    }

    public static function listadoParaTurno()
    {
        return self::whereIn('IdTipoServicio', [1,2,3,4])->get()->pluck('descripcion_larga', 'IdTipoServicio');
    }

    public static function listado()
    {
        return self::get()->pluck('descripcion_larga', 'IdTipoServicio');
    }

    public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposServicioAgregar :descripcion, :idTipoServicio, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idTipoServicio' => $oTabla->idTipoServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposServicioModificar :descripcion, :idTipoServicio, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idTipoServicio' => $oTabla->idTipoServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposServicioEliminar :idTipoServicio, :idUsuarioAuditoria";

		$params = [
			'idTipoServicio' => $oTabla->idTipoServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposServicioSeleccionarPorId :idTipoServicio";

		$params = [
			'idTipoServicio' => $oTabla->idTipoServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public static function SeleccionarTodos()
	{
		$query = "
			EXEC TiposServicioSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarAsistenciales()
	{
		$query = "
			EXEC TiposServicioSeleccionarAsistenciales ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDeEmergencia()
	{
		$query = "
			EXEC TiposServicioSeleccionarDeEmergencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarCQ()
	{
		$query = "
			EXEC TiposServicioSeleccionarCQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarInterconsultaHosp()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxInterconsultasH ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarInterconsultaEmerg()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxInterconsultasE ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}