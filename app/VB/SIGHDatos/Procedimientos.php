<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Procedimientos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idProcedimiento AS Int = :idProcedimiento
			SET NOCOUNT ON 
			EXEC ProcedimientosAgregar :edadMinDias, :idProducto, :idTipoSexo, :descripcionOPCS, :codigoOPCS, :edadMaxDias, :restriccion, :codigoCPT2004, :codigoCPT99, :descripcion, @idProcedimiento OUTPUT, :idUsuarioAuditoria
			SELECT @idProcedimiento AS idProcedimiento";

		$params = [
			'edadMinDias' => ($oTabla->edadMinDias == 0)? Null: $oTabla->edadMinDias, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'descripcionOPCS' => ($oTabla->descripcionOPCS == "")? Null: $oTabla->descripcionOPCS, 
			'codigoOPCS' => ($oTabla->codigoOPCS == "")? Null: $oTabla->codigoOPCS, 
			'edadMaxDias' => ($oTabla->edadMaxDias == 0)? Null: $oTabla->edadMaxDias, 
			'restriccion' => ($oTabla->restriccion == 0)? Null: $oTabla->restriccion, 
			'codigoCPT2004' => ($oTabla->codigoCPT2004 == "")? Null: $oTabla->codigoCPT2004, 
			'codigoCPT99' => ($oTabla->codigoCPT99 == "")? Null: $oTabla->codigoCPT99, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idProcedimiento' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProcedimientosModificar :edadMinDias, :idProducto, :idTipoSexo, :descripcionOPCS, :codigoOPCS, :edadMaxDias, :restriccion, :codigoCPT2004, :codigoCPT99, :descripcion, :idProcedimiento, :idUsuarioAuditoria";

		$params = [
			'edadMinDias' => ($oTabla->edadMinDias == 0)? Null: $oTabla->edadMinDias, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'descripcionOPCS' => ($oTabla->descripcionOPCS == "")? Null: $oTabla->descripcionOPCS, 
			'codigoOPCS' => ($oTabla->codigoOPCS == "")? Null: $oTabla->codigoOPCS, 
			'edadMaxDias' => ($oTabla->edadMaxDias == 0)? Null: $oTabla->edadMaxDias, 
			'restriccion' => ($oTabla->restriccion == 0)? Null: $oTabla->restriccion, 
			'codigoCPT2004' => ($oTabla->codigoCPT2004 == "")? Null: $oTabla->codigoCPT2004, 
			'codigoCPT99' => ($oTabla->codigoCPT99 == "")? Null: $oTabla->codigoCPT99, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idProcedimiento' => ($oTabla->idProcedimiento == 0)? Null: $oTabla->idProcedimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProcedimientosEliminar :idProcedimiento, :idUsuarioAuditoria";

		$params = [
			'idProcedimiento' => ($oTabla->idProcedimiento == 0)? Null: $oTabla->idProcedimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ProcedimientosSeleccionarPorId :idProcedimiento";

		$params = [
			'idProcedimiento' => $oTabla->idProcedimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC ProcedimientosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigoCPT($oTabla)
	{
		$query = "
			EXEC ProcedimientosXCodigo :codigoCPT2004";

		$params = [
			'codigoCPT2004' => $oTabla->codigoCPT2004, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOProcedimiento)
	{
		$query = "
			EXEC ProcedimientosFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CPTSeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CPTProcedimientosSeleccionarPorCodigo :codigoCpt";

		$params = [
			'codigoCpt' => $oTabla->idProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}