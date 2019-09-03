<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_Lotes extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idHisLote AS Int = :idHisLote
			SET NOCOUNT ON 
			EXEC HIS_LotesAgregar @idHisLote OUTPUT, :idEstablecimiento, :lote, :nroHojas, :mes, :anio, :idEstadoLote, :cerrado, :dobleDigitacion, :idUsuarioAuditoria
			SELECT @idHisLote AS idHisLote";

		$params = [
			'idHisLote' => 0, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'lote' => ($oTabla->lote == "")? Null: $oTabla->lote, 
			'nroHojas' => ($oTabla->nroHojas == 0)? 0: $oTabla->nroHojas, 
			'mes' => ($oTabla->mes == 0)? Null: $oTabla->mes, 
			'anio' => ($oTabla->anio == 0)? Null: $oTabla->anio, 
			'idEstadoLote' => 0, 
			'cerrado' => ($oTabla->cerrado == 0)? 0: $oTabla->cerrado, 
			'dobleDigitacion' => ($oTabla->dobleDigitacion == 0)? 0: $oTabla->dobleDigitacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_LotesModificar :idHisLote, :idEstablecimiento, :lote, :nroHojas, :mes, :anio, :idEstadoLote, :cerrado, :dobleDigitacion, :idUsuarioAuditoria";

		$params = [
			'idHisLote' => ($oTabla->idHisLote == 0)? Null: $oTabla->idHisLote, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'lote' => $oTabla->lote, 
			'nroHojas' => ($oTabla->nroHojas == 0)? Null: $oTabla->nroHojas, 
			'mes' => ($oTabla->mes == 0)? Null: $oTabla->mes, 
			'anio' => ($oTabla->anio == 0)? Null: $oTabla->anio, 
			'idEstadoLote' => ($oTabla->idEstadoLote == 0)? 0: $oTabla->idEstadoLote, 
			'cerrado' => ($oTabla->cerrado == 0)? 0: $oTabla->cerrado, 
			'dobleDigitacion' => ($oTabla->dobleDigitacion == 0)? 0: $oTabla->dobleDigitacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ModificarEstadoLote($oTabla)
	{
		$query = "
			EXEC HIS_ModificarEstadoLote :idHisLote, :idEstadoLote";

		$params = [
			'idHisLote' => ($oTabla->idHisLote == 0)? Null: $oTabla->idHisLote, 
			'idEstadoLote' => $oTabla->idEstadoLote, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HIS_LotesEliminar :idHisLote, :idUsuarioAuditoria";

		$params = [
			'idHisLote' => $oTabla->idHisLote, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_LotesSeleccionarPorId :idHisLote";

		$params = [
			'idHisLote' => $oTabla->idHisLote, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ConsultarRegistrosLotesPorIdEstablec($idEstablecimiento)
	{
		$query = "
			EXEC HIS_LotesConsultarRegistrosLotesPorIdEstablec :idEstablecimiento";

		$params = [
			'idEstablecimiento' => IdEstablecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ValidarLoteHIS_LoteExiste($oTablaDOHIS_Lote)
	{
		$query = "
			EXEC HIS_LotesValidarLoteHIS_LoteExiste :idEstablecimiento, :lote, :nroHojas, :mes, :anio";

		$params = [
			'idEstablecimiento' => $oTablaDOHIS_Lote->idEstablecimiento, 
			'lote' => $oTablaDOHIS_Lote->lote, 
			'nroHojas' => $oTablaDOHIS_Lote->nroHojas, 
			'mes' => $oTablaDOHIS_Lote->mes, 
			'anio' => $oTablaDOHIS_Lote->anio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ValidarLoteHIS_UltimoLoteNoCerrado($oTablaDOHIS_Lote)
	{
		$query = "
			EXEC HIS_LotesValidarLoteHIS_UltimoLoteNoCerrado :idEstablecimiento, :anio, :mes";

		$params = [
			'idEstablecimiento' => $oTablaDOHIS_Lote->idEstablecimiento, 
			'anio' => $oTablaDOHIS_Lote->anio, 
			'mes' => $oTablaDOHIS_Lote->mes, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ValidarLoteHIS_UltimoLoteCerrado($ml_IdEstablecimientoActual)
	{
		$query = "
			EXEC HIS_LotesValidarLoteHIS_UltimoLoteCerrado :idEstablecimiento";

		$params = [
			'idEstablecimiento' => $ml_IdEstablecimientoActual, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ValidarLoteHIS_PasoMaximoPaginasPermitido($ml_IdEstablecimientoActual)
	{
		$query = "
			EXEC His_cabeceraXlote :ml_IdEstablecimientoActual, :idLote";

		$params = [
			'ml_IdEstablecimientoActual' => $ml_IdEstablecimientoActual, 
			'idLote' => IdLote, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosLotePorEstablecimiento($ml_IdEstablecimientoActual)
	{
		$query = "
			EXEC HIS_LotesXIdEstablecimiento :ml_IdEstablecimientoActual";

		$params = [
			'ml_IdEstablecimientoActual' => $ml_IdEstablecimientoActual, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosLoteNroHojaLibre($ml_IdLote)
	{
		$query = "
			EXEC HIS_CabeceraObtenerDatosLoteNroHojaLibre :ml_IdLote";

		$params = [
			'ml_IdLote' => $ml_IdLote, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ConsultarRegistroFiltroLotes($idEstablecimiento, $anio, $idMes, $lote, $id)
	{
		$query = "
			EXEC HIS_LotesSegunFiltro :lcFiltro, :idEstablecimiento";

		$params = [
			'lcFiltro' => sSql, 
			'idEstablecimiento' => Trim(Str(IdEstablecimiento)), 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function His_LotesConsultarFiltro($idEstablecimiento, $idEstado)
	{
		$query = "
			EXEC His_LotesConsultarFiltro :idEstablecimiento, :idEstado";

		$params = [
			'idEstablecimiento' => IdEstablecimiento, 
			'idEstado' => IdEstado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosNumeroHojasUtilizadas($idHisLote)
	{
		$query = "
			EXEC HIS_CabeceraNumeroHojasUtilizadas :idHisLote";

		$params = [
			'idHisLote' => IdHisLote, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarRegistroLoteHISAdicionarHoja($ml_IdLote, $numHoja)
	{
		$query = "
			EXEC HIS_LotesActualizarXidLoteYnroHoja :numHoja, :ml_IdLote";

		$params = [
			'numHoja' => NumHoja, 
			'ml_IdLote' => $ml_IdLote, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function DisminuirNroHojaHIS($ml_IdLote)
	{
		$query = "
			EXEC HIS_LotesDisminuirNroHojaHIS :ml_IdLote";

		$params = [
			'ml_IdLote' => $ml_IdLote, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function His_ConsultarHojasRegistradas($idEstablecimiento, $idLote)
	{
		$query = "
			EXEC His_ConsultarHojasRegistradas :idLote, :idEstablecimiento";

		$params = [
			'idLote' => IdLote, 
			'idEstablecimiento' => IdEstablecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function His_ConsultarTotalRegistrosLote($idEstablecimiento, $idLote)
	{
		$query = "
			EXEC His_ConsultarTotalRegistrosLote :idLote, :idEstablecimiento";

		$params = [
			'idLote' => IdLote, 
			'idEstablecimiento' => IdEstablecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function HIS_ConsultarRegMuestraLotes($idLote)
	{
		$query = "
			EXEC HIS_ConsultarRegMuestraLotes :idLote";

		$params = [
			'idLote' => IdLote, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function HisActualizarNroRegistroHisDetalle($ml_IdHisDetalle, $ml_NumReg)
	{
		$query = "
			EXEC His_ActualizarNroRegistroHisDetalle :hisDetalle, :numReg";

		$params = [
			'hisDetalle' => $ml_IdHisDetalle, 
			'numReg' => $ml_NumReg, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function HIS_ConsultarRegistrosTotalesLotes($idLote)
	{
		$query = "
			EXEC HIS_ConsultarRegistrosTotalesLotes :idLote";

		$params = [
			'idLote' => IdLote, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function HIS_ConsultarEstadosLote()
	{
		$query = "
			EXEC HIS_ConsultarEstadosLote ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}