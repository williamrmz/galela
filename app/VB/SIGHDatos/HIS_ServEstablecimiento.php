<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_ServEstablecimiento extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC HIS_ServEstablecimientoAgregar :idEstablecimiento, :idServicio, :idUsuarioAuditoria";

		$params = [
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_ServEstablecimientoModificar :idEstablecimiento, :idServicio, :idUsuarioAuditoria";

		$params = [
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HIS_ServEstablecimientoEliminar :idEstablecimiento, :idServicio, :idUsuarioAuditoria";

		$params = [
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_ServEstablecimientoSeleccionarPorId :idEstablecimiento, :idServicio";

		$params = [
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerListaEstablecimientosMR()
	{
		$query = "
			EXEC HIS_SeleccionarEstablecimientosMR ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerListaServiciosCentroMR()
	{
		$query = "
			EXEC HIS_ServEstablecimientoListaServiciosCentroMR ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaServiciosPorEstablecimiento($ml_IdEstablecimientoActual)
	{
		$query = "
			EXEC HIS_ServEstablecimientoPorEstablecimiento :ml_IdEstablecimientoActual";

		$params = [
			'ml_IdEstablecimientoActual' => $ml_IdEstablecimientoActual, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosIdServicioPorIdServEstablecimiento($idServEstablec)
	{
		$query = "
			EXEC HIS_ServEstablecimientoIdServEstablecimiento :idServEstablec";

		$params = [
			'idServEstablec' => IdServEstablec, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosIdServEstablecimiento($oTabla)
	{
		$query = "
			EXEC HIS_ServEstablecimientoIdEstablecimientoIdServicio :idEstablecimiento, :idServicio";

		$params = [
			'idEstablecimiento' => $oTabla->idEstablecimiento, 
			'idServicio' => $oTabla->idServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarEspecialidadesPorEstablecimiento($idEstablecimiento)
	{
		$query = "
			EXEC HIS_ServEstablecimientoXidEstablecimiento :idEstablecimiento";

		$params = [
			'idEstablecimiento' => IdEstablecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarEspecialidadesEstablecimientosExternos()
	{
		$query = "
			EXEC EspecialidadesEstablecimientosExternos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}