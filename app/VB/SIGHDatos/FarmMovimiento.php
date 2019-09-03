<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmMovimiento extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC farmMovimientoAgregar :movNumero, :movTipo, :idAlmacenOrigen, :idAlmacenDestino, :idTipoConcepto, :documentoIdtipo, :documentoNumero, :observaciones, :total, :idMotivoAnulacion, :fechaAnulacion, :idUsuarioAnulacion, :fechaCreacion, :idUsuario, :idEstadoMovimiento, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idAlmacenOrigen' => $oTabla->idAlmacenOrigen, 
			'idAlmacenDestino' => $oTabla->idAlmacenDestino, 
			'idTipoConcepto' => ($oTabla->idTipoConcepto == 0)? Null: $oTabla->idTipoConcepto, 
			'documentoIdtipo' => ($oTabla->documentoIdtipo == 0)? Null: $oTabla->documentoIdtipo, 
			'documentoNumero' => ($oTabla->documentoNumero == "")? Null: $oTabla->documentoNumero, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'total' => $oTabla->total, 
			'idMotivoAnulacion' => ($oTabla->idMotivoAnulacion == 0)? Null: $oTabla->idMotivoAnulacion, 
			'fechaAnulacion' => ($oTabla->fechaAnulacion == 0)? Null: $oTabla->fechaAnulacion, 
			'idUsuarioAnulacion' => ($oTabla->idUsuarioAnulacion == 0)? Null: $oTabla->idUsuarioAnulacion, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstadoMovimiento' => $oTabla->idEstadoMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmMovimientoModificar :movNumero, :movTipo, :idAlmacenOrigen, :idAlmacenDestino, :idTipoConcepto, :documentoIdtipo, :documentoNumero, :observaciones, :total, :idMotivoAnulacion, :fechaAnulacion, :idUsuarioAnulacion, :fechaCreacion, :idUsuario, :idEstadoMovimiento, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idAlmacenOrigen' => $oTabla->idAlmacenOrigen, 
			'idAlmacenDestino' => $oTabla->idAlmacenDestino, 
			'idTipoConcepto' => ($oTabla->idTipoConcepto == 0)? Null: $oTabla->idTipoConcepto, 
			'documentoIdtipo' => ($oTabla->documentoIdtipo == 0)? Null: $oTabla->documentoIdtipo, 
			'documentoNumero' => ($oTabla->documentoNumero == "")? Null: $oTabla->documentoNumero, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'total' => $oTabla->total, 
			'idMotivoAnulacion' => ($oTabla->idMotivoAnulacion == 0)? Null: $oTabla->idMotivoAnulacion, 
			'fechaAnulacion' => ($oTabla->fechaAnulacion == 0)? Null: $oTabla->fechaAnulacion, 
			'idUsuarioAnulacion' => ($oTabla->idUsuarioAnulacion == 0)? Null: $oTabla->idUsuarioAnulacion, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstadoMovimiento' => $oTabla->idEstadoMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmMovimientoEliminar :movNumero, :idUsuarioAuditoria";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmMovimientoSeleccionarPorId :movNumero, :movTipo";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => $oTabla->movTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveYactualizaCorrelativosDeDocumentosES($lnIdTipoDocumento)
	{
		$query = "
			DECLARE @newCorrelativo AS Int = :newCorrelativo
			SET NOCOUNT ON 
			EXEC FarmDevuelveYactualizaCorrelativosDeDocumentosES :idTipoDocumento, @newCorrelativo OUTPUT
			SELECT @newCorrelativo AS newCorrelativo";

		$params = [
			'idTipoDocumento' => $lnIdTipoDocumento, 
			'newCorrelativo' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

}