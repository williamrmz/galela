<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaCaja extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCaja AS Int = :idCaja
			SET NOCOUNT ON 
			EXEC CajaCajaAgregar :descripcion, :codigo, @idCaja OUTPUT, :loginPc, :impresoraDefault, :impresora2, :serieImpresoraDefault, :serieImpresora2, :idTipoComprobante, :idUsuarioAuditoria
			SELECT @idCaja AS idCaja";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idCaja' => 0, 
			'loginPc' => ($oTabla->loginPc == "")? Null: $oTabla->loginPc, 
			'impresoraDefault' => ($oTabla->impresoraDefault == "")? Null: $oTabla->impresoraDefault, 
			'impresora2' => ($oTabla->impresora2 == "")? Null: $oTabla->impresora2, 
			'serieImpresoraDefault' => ($oTabla->serieImpresoraDefault == "")? Null: $oTabla->serieImpresoraDefault, 
			'serieImpresora2' => ($oTabla->serieImpresora2 == "")? Null: $oTabla->serieImpresora2, 
			'idTipoComprobante' => ($oTabla->idTipoComprobante == 0)? Null: $oTabla->idTipoComprobante, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaCajaModificar :descripcion, :codigo, :idCaja, :loginPc, :impresoraDefault, :impresora2, :serieImpresoraDefault, :serieImpresora2, :idTipoComprobante, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'loginPc' => ($oTabla->loginPc == "")? Null: $oTabla->loginPc, 
			'impresoraDefault' => ($oTabla->impresoraDefault == "")? Null: $oTabla->impresoraDefault, 
			'impresora2' => ($oTabla->impresora2 == "")? Null: $oTabla->impresora2, 
			'serieImpresoraDefault' => ($oTabla->serieImpresoraDefault == "")? Null: $oTabla->serieImpresoraDefault, 
			'serieImpresora2' => ($oTabla->serieImpresora2 == "")? Null: $oTabla->serieImpresora2, 
			'idTipoComprobante' => ($oTabla->idTipoComprobante == 0)? Null: $oTabla->idTipoComprobante, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaCajaEliminar :idCaja, :idUsuarioAuditoria";

		$params = [
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaCajaSeleccionarPorId :idCaja";

		$params = [
			'idCaja' => $oTabla->idCaja, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerSiguienteNumeroDocumento($oTabla)
	{
		$query = "
			EXEC CajaNroDocumentoXidCajaTipoComprobante :idCaja, :idTipoComprobante";

		$params = [
			'idCaja' => $oTabla->idCaja, 
			'idTipoComprobante' => $oTabla->idTipoComprobante, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerSiguienteNumeroDocumentoYgrabarlo($oTabla)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RealizarFiltro($lcFiltro)
	{
		$query = "
			EXEC CajaCajaSegunFiltro :lcFiltro ";

		$params = [
			'lcFiltro' => $lcFiltro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosParaLista()
	{
		$query = "
			EXEC CajaCajaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}