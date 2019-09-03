<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposFinanciamiento extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposFinanciamientoAgregar :descripcion, :idTipoFinanciamiento, :esOficina, :esSalida, :seIngresPrecios, :esFarmacia, :idCajaTiposComprobante, :tipoVenta, :seImprimeComprobante, :esFuenteFinanciamiento, :generaPago, :idTipoConcepto, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoFinanciamiento' => $oTabla->idTipoFinanciamiento, 
			'esOficina' => $oTabla->esOficina, 
			'esSalida' => $oTabla->esSalida, 
			'seIngresPrecios' => $oTabla->seIngresPrecios, 
			'esFarmacia' => $oTabla->esFArmacia, 
			'idCajaTiposComprobante' => ($oTabla->idCajaTiposComprobante == 0)? Null: $oTabla->idCajaTiposComprobante, 
			'tipoVenta' => ($oTabla->tipoVenta == "")? Null: $oTabla->tipoVenta, 
			'seImprimeComprobante' => ($oTabla->seImprimeComprobante == 0)? Null: $oTabla->seImprimeComprobante, 
			'esFuenteFinanciamiento' => $oTabla->esFuenteFinanciamiento, 
			'generaPago' => $oTabla->generaPago, 
			'idTipoConcepto' => ($oTabla->idTipoConcepto == 0)? Null: $oTabla->idTipoConcepto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposFinanciamientoModificar :descripcion, :idTipoFinanciamiento, :esOficina, :esSalida, :seIngresPrecios, :esFarmacia, :idCajaTiposComprobante, :tipoVenta, :seImprimeComprobante, :esFuenteFinanciamiento, :generaPago, :idTipoConcepto, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'esOficina' => $oTabla->esOficina, 
			'esSalida' => $oTabla->esSalida, 
			'seIngresPrecios' => $oTabla->seIngresPrecios, 
			'esFarmacia' => $oTabla->esFArmacia, 
			'idCajaTiposComprobante' => ($oTabla->idCajaTiposComprobante == 0)? Null: $oTabla->idCajaTiposComprobante, 
			'tipoVenta' => ($oTabla->tipoVenta == "")? Null: $oTabla->tipoVenta, 
			'seImprimeComprobante' => ($oTabla->seImprimeComprobante == 0)? Null: $oTabla->seImprimeComprobante, 
			'esFuenteFinanciamiento' => $oTabla->esFuenteFinanciamiento, 
			'generaPago' => $oTabla->generaPago, 
			'idTipoConcepto' => ($oTabla->idTipoConcepto == 0)? Null: $oTabla->idTipoConcepto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposFinanciamientoEliminar :idTipoFinanciamiento, :idUsuarioAuditoria";

		$params = [
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposFinanciamientoSeleccionarPorId :idTipoFinanciamiento";

		$params = [
			'idTipoFinanciamiento' => $oTabla->idTipoFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposFinanciamientoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarParaCaja()
	{
		$query = "
			EXEC TiposFinanciamientoSeleccionarParaCaja ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdentificador($lnIdTipoFinanciamiento)
	{
		$query = "
			EXEC TiposFinanciamientoSeleccionarPorId :idTipoFinanciamiento";

		$params = [
			'idTipoFinanciamiento' => LnIdTipoFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function TiposFinanciamientoSegunFiltro($lcFiltro)
	{
		$query = "
			EXEC TiposFinanciamientoSegunFiltro :lcFiltro";

		$params = [
			'lcFiltro' => $lcFiltro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarProductoPorTipoFinanciamiento($lnIdProducto, $lnIdTipoFinanciamiento)
	{
		$query = "
			EXEC consultarCatalogoSISIndependiente :p_idProducto, :p_tipoFinanciamiento";

		$params = [
			'p_idProducto' => $lnIdProducto, 
			'p_tipoFinanciamiento' => LnIdTipoFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarAseguradoraporFinancimiento($lcFiltro)
	{
		$query = "
			EXEC ListarAseguradoras :lcFiltro";

		$params = [
			'lcFiltro' => $lcFiltro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarAseguradoraporxIdFuenteFinancimiento($ml_IdFuenteFinanciamiento)
	{
		$query = "
			EXEC ListarAseguradorasXidFuenteFinanciamiento :idFuenteFinanciamiento";

		$params = [
			'idFuenteFinanciamiento' => $ml_IdFuenteFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarAseguradoraporAtencion($idAtencion)
	{
		$query = "
			EXEC ListarAseguradoraxAtencion :idCuenta";

		$params = [
			'idCuenta' => $idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AseguradoraporAtencionAgregar($idAseguradora, $idAtencion)
	{
		$query = "
			EXEC guaradarAseguradoraxAtencion :idaseguradora , :idCuenta ";

		$params = [
			'idaseguradora ' => $idAseguradora, 
			'idCuenta ' => $idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ScoreApacheSofaTiss_Agregar($idCuentaAtencion, $apache, $sofa, $tiss)
	{
		$query = "
			EXEC scoreApacheSofaTiss_Registrar :idcuentaAtencion, :apache , :sofa , :tiss ";

		$params = [
			'idcuentaAtencion' => IdCuentaAtencion, 
			'apache ' => $apache, 
			'sofa ' => $sofa, 
			'tiss ' => $tiss, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarScoreApacheSofaTiss($idCuentaAtencion)
	{
		$query = "
			EXEC ListarScoreApcheSofaTiss :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => IdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarProductoFinanciadoPorElSIS($lnIdProducto)
	{
		$query = "
			EXEC SeleccionarProductoFinanciadoPorElSIS :idProducto";

		$params = [
			'idProducto' => $lnIdProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}