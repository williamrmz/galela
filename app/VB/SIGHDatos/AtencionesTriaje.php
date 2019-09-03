<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesTriaje extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC AtencionesTriajeAgregar :idAtencion, :presion, :temperatura, :peso, :talla, :fechaTriaje, :idUsuarioCreo, :fechaModifico, :idUsuarioModifico, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'presion' => ($oTabla->presion == "")? Null: $oTabla->presion, 
			'temperatura' => ($oTabla->temperatura == "")? Null: $oTabla->temperatura, 
			'peso' => ($oTabla->peso == "")? Null: $oTabla->peso, 
			'talla' => ($oTabla->talla == "")? Null: $oTabla->talla, 
			'fechaTriaje' => ($oTabla->fechaTriaje == 0)? Null: $oTabla->fechaTriaje, 
			'idUsuarioCreo' => ($oTabla->idUsuarioCreo == 0)? Null: $oTabla->idUsuarioCreo, 
			'fechaModifico' => ($oTabla->fechaModifico == 0)? Null: $oTabla->fechaModifico, 
			'idUsuarioModifico' => ($oTabla->idUsuarioModifico == 0)? Null: $oTabla->idUsuarioModifico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesTriajeModificar :idAtencion, :presion, :temperatura, :peso, :talla, :fechaTriaje, :idUsuarioCreo, :fechaModifico, :idUsuarioModifico, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'presion' => ($oTabla->presion == "")? Null: $oTabla->presion, 
			'temperatura' => ($oTabla->temperatura == "")? Null: $oTabla->temperatura, 
			'peso' => ($oTabla->peso == "")? Null: $oTabla->peso, 
			'talla' => ($oTabla->talla == "")? Null: $oTabla->talla, 
			'fechaTriaje' => ($oTabla->fechaTriaje == 0)? Null: $oTabla->fechaTriaje, 
			'idUsuarioCreo' => ($oTabla->idUsuarioCreo == 0)? Null: $oTabla->idUsuarioCreo, 
			'fechaModifico' => ($oTabla->fechaModifico == 0)? Null: $oTabla->fechaModifico, 
			'idUsuarioModifico' => ($oTabla->idUsuarioModifico == 0)? Null: $oTabla->idUsuarioModifico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesTriajeEliminar :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesTriajeSeleccionarPorId :idAtencion";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}