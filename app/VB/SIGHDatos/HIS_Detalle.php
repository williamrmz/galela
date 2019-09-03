<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_Detalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idHisDetalle AS Int = :idHisDetalle
			SET NOCOUNT ON 
			EXEC HIS_DetalleAgregar @idHisDetalle OUTPUT, :idHisCabecera, :idTipoAtencion, :diaAtencion, :idHisPaciente, :codigoActividad, :idTipoFinanciamiento, :idDistrito, :idTipoEdad, :edad, :talla, :peso, :idEstadoaEstablec, :idEstadoaServicio, :nroRegistroLote, :nroRegistroHoja, :idUsuarioAuditoria
			SELECT @idHisDetalle AS idHisDetalle";

		$params = [
			'idHisDetalle' => 0, 
			'idHisCabecera' => ($oTabla->idHisCabecera == 0)? Null: $oTabla->idHisCabecera, 
			'idTipoAtencion' => ($oTabla->idTipoAtencion == 0)? Null: $oTabla->idTipoAtencion, 
			'diaAtencion' => ($oTabla->diaAtencion == 0)? Null: $oTabla->diaAtencion, 
			'idHisPaciente' => ($oTabla->idHisPaciente == 0)? Null: $oTabla->idHisPaciente, 
			'codigoActividad' => ($oTabla->codigoActividad == "")? Null: $oTabla->codigoActividad, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idDistrito' => ($oTabla->idDistrito == 0)? Null: $oTabla->idDistrito, 
			'idTipoEdad' => ($oTabla->idTipoEdad == 0)? Null: $oTabla->idTipoEdad, 
			'edad' => ($oTabla->edad == 0)? Null: $oTabla->edad, 
			'talla' => ($oTabla->talla == 0)? 0: $oTabla->talla, 
			'peso' => ($oTabla->peso == 0)? 0: $oTabla->peso, 
			'idEstadoaEstablec' => ($oTabla->idEstadoaEstablec == 0)? Null: $oTabla->idEstadoaEstablec, 
			'idEstadoaServicio' => ($oTabla->idEstadoaServicio == 0)? Null: $oTabla->idEstadoaServicio, 
			'nroRegistroLote' => ($oTabla->nroRegistroLote == 0)? Null: $oTabla->nroRegistroLote, 
			'nroRegistroHoja' => ($oTabla->nroRegistroHoja == 0)? Null: $oTabla->nroRegistroHoja, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_DetalleModificar :idHisDetalle, :idHisCabecera, :idTipoAtencion, :diaAtencion, :idHisPaciente, :codigoActividad, :idTipoFinanciamiento, :idDistrito, :idTipoEdad, :edad, :talla, :peso, :idEstadoaEstablec, :idEstadoaServicio, :nroRegistroLote, :nroRegistroHoja, :idUsuarioAuditoria";

		$params = [
			'idHisDetalle' => ($oTabla->idHisDetalle == 0)? Null: $oTabla->idHisDetalle, 
			'idHisCabecera' => ($oTabla->idHisCabecera == 0)? Null: $oTabla->idHisCabecera, 
			'idTipoAtencion' => ($oTabla->idTipoAtencion == 0)? Null: $oTabla->idTipoAtencion, 
			'diaAtencion' => ($oTabla->diaAtencion == 0)? Null: $oTabla->diaAtencion, 
			'idHisPaciente' => ($oTabla->idHisPaciente == 0)? Null: $oTabla->idHisPaciente, 
			'codigoActividad' => ($oTabla->codigoActividad == "")? Null: $oTabla->codigoActividad, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idDistrito' => ($oTabla->idDistrito == 0)? Null: $oTabla->idDistrito, 
			'idTipoEdad' => ($oTabla->idTipoEdad == 0)? Null: $oTabla->idTipoEdad, 
			'edad' => ($oTabla->edad == 0)? Null: $oTabla->edad, 
			'talla' => ($oTabla->talla == 0)? Null: $oTabla->talla, 
			'peso' => ($oTabla->peso == "")? Null: $oTabla->peso, 
			'idEstadoaEstablec' => ($oTabla->idEstadoaEstablec == 0)? Null: $oTabla->idEstadoaEstablec, 
			'idEstadoaServicio' => ($oTabla->idEstadoaServicio == 0)? Null: $oTabla->idEstadoaServicio, 
			'nroRegistroLote' => ($oTabla->nroRegistroLote == 0)? Null: $oTabla->nroRegistroLote, 
			'nroRegistroHoja' => ($oTabla->nroRegistroHoja == 0)? Null: $oTabla->nroRegistroHoja, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HIS_DetalleEliminar :idHisDetalle, :idUsuarioAuditoria";

		$params = [
			'idHisDetalle' => $oTabla->idHisDetalle, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_DetalleSeleccionarPorId :idHisDetalle";

		$params = [
			'idHisDetalle' => $oTabla->idHisDetalle, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaIdsAtencionesPorIdCabecera($regCabeceraHIS)
	{
		$query = "
			EXEC his_detallePorIdCabecera :idHisCabecera";

		$params = [
			'idHisCabecera' => RegCabeceraHIS->idHisCabecera, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosDetalleAtencion($ml_IdCabeceraHIS)
	{
		$query = "
			EXEC HIS_detalleObtenerDatosDetalleAtencion :ml_IdCabeceraHIS";

		$params = [
			'ml_IdCabeceraHIS' => $ml_IdCabeceraHIS, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ExportacionHIS_Atenciones($idUsuario, $ml_Mes, $mi_anio)
	{
		$query = "
			EXEC CommandText = sSq ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}