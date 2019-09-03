<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesDiagnosticos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencionDiagnostico AS Int = :idAtencionDiagnostico
			SET NOCOUNT ON 
			EXEC AtencionesDiagnosticosAgregar :idSubclasificacionDx, :idClasificacionDx, :idDiagnostico, @idAtencionDiagnostico OUTPUT, :idAtencion, :labConfHIS, :grupoHIS, :subGrupoHIS, :idUsuarioAuditoria, :idordenDx
			SELECT @idAtencionDiagnostico AS idAtencionDiagnostico";

		$params = [
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'idClasificacionDx' => ($oTabla->idClasificacionDx == 0)? Null: $oTabla->idClasificacionDx, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idAtencionDiagnostico' => 0, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'labConfHIS' => ($oTabla->labConfHIS == "")? Null: $oTabla->labConfHIS, 
			'grupoHIS' => $oTabla->grupoHIS, 
			'subGrupoHIS' => $oTabla->subGrupoHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idordenDx' => ($oTabla->idordenDx == 0)? Null: $oTabla->idordenDx, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesDiagnosticosModificar :idSubclasificacionDx, :idClasificacionDx, :idDiagnostico, :idAtencionDiagnostico, :idAtencion, :grupoHIS, :subGrupoHIS, :idUsuarioAuditoria, :idordenDx";

		$params = [
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'idClasificacionDx' => ($oTabla->idClasificacionDx == 0)? Null: $oTabla->idClasificacionDx, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idAtencionDiagnostico' => ($oTabla->idAtencionDiagnostico == 0)? Null: $oTabla->idAtencionDiagnostico, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'grupoHIS' => $oTabla->grupoHIS, 
			'subGrupoHIS' => $oTabla->subGrupoHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idordenDx' => ($oTabla->idordenDx == 0)? Null: $oTabla->idordenDx, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesDiagnosticosEliminar :idAtencionDiagnostico, :idUsuarioAuditoria";

		$params = [
			'idAtencionDiagnostico' => ($oTabla->idAtencionDiagnostico == 0)? Null: $oTabla->idAtencionDiagnostico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesDiagnosticosSeleccionarPorId :idAtencionDiagnostico";

		$params = [
			'idAtencionDiagnostico' => $oTabla->idAtencionDiagnostico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarDiagnosticosPorAtencion($lIdAtencion)
	{
		$query = "
			EXEC AtencionesDiagnosticosEliminarXIdAtencion :lIdAtencion";

		$params = [
			'lIdAtencion' => $lIdAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorAtencion($lIdAtencion, $lIdTipoDiagnostico)
	{
		$query = "
			EXEC AtencionesDiagnosticosSeleccionarPorAtencion :idAtencion, :tipodiagnostico";

		$params = [
			'idAtencion' => $lIdAtencion, 
			'tipodiagnostico' => $lIdTipoDiagnostico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosDiagnosticosPorAtencion($lIdAtencion, $lIdTipoDiagnostico)
	{
		$query = "
			EXEC AtencionesDiagnosticosSeleccionarTodosPorAtencion :idAtencion, :tipodiagnostico";

		$params = [
			'idAtencion' => $lIdAtencion, 
			'tipodiagnostico' => $lIdTipoDiagnostico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarComplicaciones($lIdAtencion)
	{
		$query = "
			EXEC AtencionesDiagnosticosSeleccionarComplicaciones :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarComplicaciones($oComplicaciones, $lIdAtencion)
	{
		$query = "
			EXEC AtencionesDiagnosticosEliminarPorIdAtencion :lIdAtencion";

		$params = [
			'lIdAtencion' => $lIdAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarComplicaciones($lIdAtencion)
	{
		$query = "
			EXEC AtencionesDiagnosticosEliminarPorIdAtencion :lIdAtencion";

		$params = [
			'lIdAtencion' => $lIdAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ActualizarDiagnosticosAtencion($oDiagnosticos, $lIdAtencion)
	{
		$query = "
			EXEC AtencionesDiagnosticosEliminarXIdAtencion :lIdAtencion";

		$params = [
			'lIdAtencion' => $lIdAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarDiagnosticosDeAtencion($lIdAtencion)
	{
		$query = "
			EXEC AtencionesDiagnosticosEliminarXIdAtencion :lIdAtencion";

		$params = [
			'lIdAtencion' => $lIdAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarDiagnosticosDeEgreso($lIdAtencion)
	{
		$query = "
			EXEC AtencionesDiagnosticosEgresoSeleccionarPorAtencion :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosPorIdAtencion($lnIdAtencion)
	{
		$query = "
			EXEC AtencionesDiagnosticosSeleccionarTodosPorIdAtencion :lnIdAtencion";

		$params = [
			'lnIdAtencion' => $lnIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdAtencionIdDx($oTabla)
	{
		$query = "
			EXEC AtencionesDiagnosticosSeleccionarPorIdAtencionIdDx :idAtencion, :idDiagnostico";

		$params = [
			'idAtencion' => $oTabla->idatencion, 
			'idDiagnostico' => $oTabla->idDiagnostico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarTodosCampos($oTabla)
	{
		$query = "
			EXEC AtencionesDiagnosticosModificarTodosCampos :idSubclasificacionDx, :idClasificacionDx, :idDiagnostico, :idAtencionDiagnostico, :idAtencion, :labConfHIS, :idUsuarioAuditoria, :idordenDx";

		$params = [
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'idClasificacionDx' => ($oTabla->idClasificacionDx == 0)? Null: $oTabla->idClasificacionDx, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idAtencionDiagnostico' => ($oTabla->idAtencionDiagnostico == 0)? Null: $oTabla->idAtencionDiagnostico, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'labConfHIS' => ($oTabla->labConfHIS == "")? Null: $oTabla->labConfHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idordenDx' => ($oTabla->idordenDx == 0)? Null: $oTabla->idordenDx, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionPorIdAtencionDiagnosticoLab($oTabla)
	{
		$query = "
			EXEC AtencionesDiagnosticosSeleccionPorIdAtencionDiagnosticoLab :idDiagnostico, :idAtencion, :labConfHIS";

		$params = [
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'labConfHIS' => ($oTabla->labConfHIS == "")? Null: Trim($oTabla->labConfHIS), 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}