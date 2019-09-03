<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class SubclasificacionDiagnosticos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idSubclasificacionDx AS Int = :idSubclasificacionDx
			SET NOCOUNT ON 
			EXEC SubclasificacionDiagnosticosAgregar :idTipoServicio, :idClasificacionDx, :descripcion, :codigo, @idSubclasificacionDx OUTPUT, :idUsuarioAuditoria
			SELECT @idSubclasificacionDx AS idSubclasificacionDx";

		$params = [
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'idClasificacionDx' => ($oTabla->idClasificacionDx == 0)? Null: $oTabla->idClasificacionDx, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idSubclasificacionDx' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC SubclasificacionDiagnosticosModificar :idTipoServicio, :idClasificacionDx, :descripcion, :codigo, :idSubclasificacionDx, :idUsuarioAuditoria";

		$params = [
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'idClasificacionDx' => ($oTabla->idClasificacionDx == 0)? Null: $oTabla->idClasificacionDx, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC SubclasificacionDiagnosticosEliminar :idSubclasificacionDx, :idUsuarioAuditoria";

		$params = [
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarPorId :idSubclasificacionDx";

		$params = [
			'idSubclasificacionDx' => $oTabla->idSubClasificacionDX, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDxHospitalizacionIngresoE()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxHospIngreso ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDxHospitalizacionEgresoE()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxHospEgresoE ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarOrdenDx()
	{
		$query = "
			EXEC SeleccionarOrdenDiagnosticosSeleccionar ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDxConsultaExterna()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxConsultaExterna ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDxHospitalizacionIngreso()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxHospIngreso ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDxHospitalizacionEgreso()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxHospEgreso ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDxHospitalizacionMortalidad()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxHospMortalidad ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDxHospitalizacionMuerteFetal()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxHospMuerteFetal ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDxHospitalizacionComplicaciones()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxHospComplicaciones ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDxInterconsultas()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxInterconsultas ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarIdorden($sCodigo)
	{
		$query = "
			EXEC SeleccionarOrdenDiagnosticosSeleccionarDx :codigo";

		$params = [
			'codigo' => $sCodigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarIdPorCodigoYClasificacion($sCodigo, $lIdClasificacionDx)
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarIdPorCodigoYClasificacion :codigo, :idClasificacionDx";

		$params = [
			'codigo' => $sCodigo, 
			'idClasificacionDx' => $lIdClasificacionDx, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}