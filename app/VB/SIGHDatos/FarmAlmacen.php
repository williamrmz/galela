<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmAlmacen extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC farmAlmacenAgregar :idAlmacen, :descripcion, :idTipoLocales, :idTipoSuministro, :idEstado, :codigoSISMED, :regenerarDias, :regenerarHora, :regenerarEstado, :idUsuarioAuditoria";

		$params = [
			'idAlmacen' => $oTabla->idAlmacen, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoLocales' => ($oTabla->idTipoLocales == "")? Null: $oTabla->idTipoLocales, 
			'idTipoSuministro' => ($oTabla->idTipoSuministro == "")? Null: $oTabla->idTipoSuministro, 
			'idEstado' => $oTabla->idEstado, 
			'codigoSISMED' => $oTabla->codigoSISMED, 
			'regenerarDias' => $oTabla->regenerarDias, 
			'regenerarHora' => $oTabla->regenerarHora, 
			'regenerarEstado' => (Trim($oTabla->regenerarEstado) == "")? Null: $oTabla->regenerarEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmAlmacenModificar :idAlmacen, :descripcion, :idTipoLocales, :idTipoSuministro, :idEstado, :codigoSISMED, :regenerarDias, :regenerarHora, :regenerarEstado, :idUsuarioAuditoria";

		$params = [
			'idAlmacen' => ($oTabla->idAlmacen == 0)? Null: $oTabla->idAlmacen, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoLocales' => ($oTabla->idTipoLocales == "")? Null: $oTabla->idTipoLocales, 
			'idTipoSuministro' => ($oTabla->idTipoSuministro == "")? Null: $oTabla->idTipoSuministro, 
			'idEstado' => $oTabla->idEstado, 
			'codigoSISMED' => $oTabla->codigoSISMED, 
			'regenerarDias' => $oTabla->regenerarDias, 
			'regenerarHora' => $oTabla->regenerarHora, 
			'regenerarEstado' => (Trim($oTabla->regenerarEstado) == "")? Null: $oTabla->regenerarEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmAlmacenEliminar :idAlmacen, :idUsuarioAuditoria";

		$params = [
			'idAlmacen' => $oTabla->idAlmacen, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmAlmacenSeleccionarPorId :idAlmacen";

		$params = [
			'idAlmacen' => $oTabla->idAlmacen, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC FarmAlmacenSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosMenosExternos()
	{
		$query = "
			EXEC farmAlmacenSeleccionarTodosMenosExternos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarFarmaciaCE()
	{
		$query = "
			EXEC FarmAlmacenServicio ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarFarmacia($ml_IdTipoServicios, $ml_TipoServicio)
	{
		$query = "
			EXEC LitarFarmxTipoSErvicioyServicio :idTipoSErvicio, :idservicio";

		$params = [
			'idTipoSErvicio' => $ml_IdTipoServicios, 
			'idservicio' => $ml_TipoServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarSegunFiltro($lcFiltro)
	{
		$query = "
			EXEC FarmAlmacenFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => $lcFiltro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarFarmaciaPorDefecto()
	{
		$query = "
			EXEC FarmAlmacenPorDefecto ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarFarmaciaPorDefectoEmergencia()
	{
		$query = "
			EXEC FarmAlmacenPorDefectoEmergencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CargaUltimoCorrelativoIdAlmacen()
	{
		$query = "
			EXEC FarmAlmacenUltimoAlmacen ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarFarmacia()
	{
		$query = "
			EXEC ListarFarmacias ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteICI($mf_Fecha)
	{
		$query = "
			EXEC ICIFARMACIA :mES";

		$params = [
			'mES' => $mf_Fecha, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}