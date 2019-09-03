<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_Detalle_Verifica extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC HIS_Detalle_VerificaAgregar :idHisDetalle, :idHisCabecera, :idTipoAtencion, :diaAtencion, :sexo, :idNacionalidad, :nroDocIdentidad, :nroHijo, :idEtnia, :idTipoDocumento, :nroHC_FF, :codigoActividad, :idTipoFinanciamiento, :idDistrito, :idTipoEdad, :edad, :talla, :peso, :idEstadoaEstablec, :idEstadoaServicio, :nroRegistroLote, :nroRegistroHoja, :registrado, :coincide, :idUsuarioAuditoria";

		$params = [
			'idHisDetalle' => ($oTabla->idHisDetalle == 0)? Null: $oTabla->idHisDetalle, 
			'idHisCabecera' => ($oTabla->idHisCabecera == 0)? Null: $oTabla->idHisCabecera, 
			'idTipoAtencion' => ($oTabla->idTipoAtencion == 0)? Null: $oTabla->idTipoAtencion, 
			'diaAtencion' => ($oTabla->diaAtencion == 0)? Null: $oTabla->diaAtencion, 
			'sexo' => ($oTabla->sexo == 0)? Null: $oTabla->sexo, 
			'idNacionalidad' => ($oTabla->idNacionalidad == 0)? Null: $oTabla->idNacionalidad, 
			'nroDocIdentidad' => ($oTabla->nroDocIdentidad == "")? Null: $oTabla->nroDocIdentidad, 
			'nroHijo' => ($oTabla->nroHijo == "")? Null: $oTabla->nroHijo, 
			'idEtnia' => ($oTabla->idEtnia == "")? Null: $oTabla->idEtnia, 
			'idTipoDocumento' => ($oTabla->idTipoDocumento == 0)? Null: $oTabla->idTipoDocumento, 
			'nroHC_FF' => ($oTabla->nroHC_FF == "")? Null: $oTabla->nroHC_FF, 
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
			'registrado' => $oTabla->registrado, 
			'coincide' => $oTabla->coincide, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_Detalle_VerificaModificar :idHisDetalle, :idHisCabecera, :idTipoAtencion, :diaAtencion, :sexo, :idNacionalidad, :nroDocIdentidad, :nroHijo, :idEtnia, :idTipoDocumento, :nroHC_FF, :codigoActividad, :idTipoFinanciamiento, :idDistrito, :idTipoEdad, :edad, :talla, :peso, :idEstadoaEstablec, :idEstadoaServicio, :nroRegistroLote, :nroRegistroHoja, :registrado, :coincide, :idUsuarioAuditoria";

		$params = [
			'idHisDetalle' => ($oTabla->idHisDetalle == 0)? Null: $oTabla->idHisDetalle, 
			'idHisCabecera' => ($oTabla->idHisCabecera == 0)? Null: $oTabla->idHisCabecera, 
			'idTipoAtencion' => ($oTabla->idTipoAtencion == 0)? Null: $oTabla->idTipoAtencion, 
			'diaAtencion' => ($oTabla->diaAtencion == 0)? Null: $oTabla->diaAtencion, 
			'sexo' => ($oTabla->sexo == 0)? Null: $oTabla->sexo, 
			'idNacionalidad' => ($oTabla->idNacionalidad == 0)? Null: $oTabla->idNacionalidad, 
			'nroDocIdentidad' => ($oTabla->nroDocIdentidad == "")? Null: $oTabla->nroDocIdentidad, 
			'nroHijo' => ($oTabla->nroHijo == "")? Null: $oTabla->nroHijo, 
			'idEtnia' => ($oTabla->idEtnia == "")? Null: $oTabla->idEtnia, 
			'idTipoDocumento' => ($oTabla->idTipoDocumento == 0)? Null: $oTabla->idTipoDocumento, 
			'nroHC_FF' => ($oTabla->nroHC_FF == "")? Null: $oTabla->nroHC_FF, 
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
			'registrado' => $oTabla->registrado, 
			'coincide' => $oTabla->coincide, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($ml_IdHisLote)
	{
		$query = "
			EXEC HIS_Detalle_VerificaEliminar :idHisLote, :idUsuarioAuditoria";

		$params = [
			'idHisLote' => $ml_IdHisLote, 
			'idUsuarioAuditoria' => 1, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_Detalle_VerificaSeleccionarPorId :idHisDetalle";

		$params = [
			'idHisDetalle' => $oTabla->idHisDetalle, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function HIS_ConsultarRegistroDetalleHis($lnIdHisDetalle)
	{
		$query = "
			EXEC HIS_ConsultarRegistroDetalleHis :idHisDetalle";

		$params = [
			'idHisDetalle' => $lnIdHisDetalle, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}