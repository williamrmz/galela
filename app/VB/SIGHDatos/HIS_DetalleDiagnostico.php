<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_DetalleDiagnostico extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idHisDetalleDiagnostico AS Int = :idHisDetalleDiagnostico
			SET NOCOUNT ON 
			EXEC HIS_DetalleDiagnosticoAgregar @idHisDetalleDiagnostico OUTPUT, :idHisDetalle, :idCIE, :idSubClasificacionDX, :codLAB, :idUsuarioAuditoria
			SELECT @idHisDetalleDiagnostico AS idHisDetalleDiagnostico";

		$params = [
			'idHisDetalleDiagnostico' => 0, 
			'idHisDetalle' => ($oTabla->idHisDetalle == 0)? Null: $oTabla->idHisDetalle, 
			'idCIE' => ($oTabla->idCIE == 0)? Null: $oTabla->idCIE, 
			'idSubClasificacionDX' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'codLAB' => ($oTabla->codLAB == "")? Null: $oTabla->codLAB, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_DetalleDiagnosticoModificar :idHisDetalleDiagnostico, :idHisDetalle, :idCIE, :idSubClasificacionDX, :codLAB, :idUsuarioAuditoria";

		$params = [
			'idHisDetalleDiagnostico' => ($oTabla->idHisDetalleDiagnostico == 0)? Null: $oTabla->idHisDetalleDiagnostico, 
			'idHisDetalle' => ($oTabla->idHisDetalle == 0)? Null: $oTabla->idHisDetalle, 
			'idCIE' => ($oTabla->idCIE == 0)? Null: $oTabla->idCIE, 
			'idSubClasificacionDX' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'codLAB' => ($oTabla->codLAB == "")? Null: $oTabla->codLAB, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($lnIdHisDetalle)
	{
		$query = "
			EXEC HIS_DetalleDiagnosticoEliminar :idHisDetalleDiagnostico, :idUsuarioAuditoria";

		$params = [
			'idHisDetalleDiagnostico' => $lnIdHisDetalle, 
			'idUsuarioAuditoria' => 0, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_DetalleDiagnosticoSeleccionarPorId :idHisDetalleDiagnostico";

		$params = [
			'idHisDetalleDiagnostico' => $oTabla->idHisDetalleDiagnostico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaIdsDiagnosticosPorIdCabecera()
	{
		$query = "
			EXEC HisDetalleDiagnosticoListaIdsDiagnosticosPorIdCabecera :idHisCabecera";

		$params = [
			'idHisCabecera' => RegCabeceraHIS->idHisCabecera, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosDetalleDiagnostico($ml_IdCabeceraHIS)
	{
		$query = "
			EXEC HIS_DetalleDiagnosticoObtenerDatosDetalleDiagnostico :ml_IdCabeceraHIS";

		$params = [
			'ml_IdCabeceraHIS' => $ml_IdCabeceraHIS, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosDetalleDiagnosticoPorIdDetalle($ml_IdDetalleHIS)
	{
		$query = "
			EXEC HIS_DetalleDiagnosticoObtenerDatosDetalleDiagnosticoPorIdDetalle :ml_IdDetalleHIS";

		$params = [
			'ml_IdDetalleHIS' => $ml_IdDetalleHIS, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ExportacionHIS_Diagnosticos($idUsuario, $ml_Mes, $mi_anio)
	{
		$query = "
			EXEC CommandText = sSq ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}