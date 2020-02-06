<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposProgramacion extends Model
{
    protected $table = "TiposProgramacion";
    protected $primaryKey = "IdTipoProgramacion";
    public $timestamps = false;
    protected $fillable =
        [
            "IdTipoProgramacion",
            "Descripcion"
        ];

	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoProgramacion AS Int = :idTipoProgramacion
			SET NOCOUNT ON 
			EXEC TiposProgramacionAgregar :descripcion, @idTipoProgramacion OUTPUT, :idUsuarioAuditoria
			SELECT @idTipoProgramacion AS idTipoProgramacion";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoProgramacion' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposProgramacionModificar :descripcion, :idTipoProgramacion, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoProgramacion' => ($oTabla->idTipoProgramacion == "")? Null: $oTabla->idTipoProgramacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposProgramacionEliminar :idTipoProgramacion, :idUsuarioAuditoria";

		$params = [
			'idTipoProgramacion' => ($oTabla->idTipoProgramacion == "")? Null: $oTabla->idTipoProgramacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposProgramacionSeleccionarPorId :idTipoProgramacion";

		$params = [
			'idTipoProgramacion' => $oTabla->idTipoProgramacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public static function SeleccionarTodos()
	{
		$query = "
			EXEC TiposProgramacionSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}