<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesFechaRef extends Model
{
	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencioesFechaReferenciaModificar :idAtencion, :nroReferencia";

		$params = [
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'nroReferencia' => ($oTabla->nroReferencia == "")? Null: $oTabla->nroReferencia, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencioesFechaReferencia AS Int = :idAtencioesFechaReferencia
			SET NOCOUNT ON 
			EXEC AtencioesFechaReferenciaAgregar @idAtencioesFechaReferencia OUTPUT, :idAtencion, :nroReferencia, :motivoFechaReferecia, :fechareferencia, :diasExtension
			SELECT @idAtencioesFechaReferencia AS idAtencioesFechaReferencia";

		$params = [
			'idAtencioesFechaReferencia' => 0, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'nroReferencia' => ($oTabla->nroReferencia == "")? Null: $oTabla->nroReferencia, 
			'motivoFechaReferecia' => ($oTabla->motivoFechaReferecia == "")? Null: $oTabla->motivoFechaReferecia, 
			'fechareferencia' => ($oTabla->fechaReferencia == "")? Null: $oTabla->fechaReferencia, 
			'diasExtension' => ($oTabla->diasExtension == 0)? Null: $oTabla->diasExtension, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencioesFechaReferenciaSeleccionarPorId :idAtencioesFechaReferencia";

		$params = [
			'idAtencioesFechaReferencia' => $oTabla->idAtencioesFechaReferencia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarDiasExtension()
	{
		$query = "
			EXEC ListarDiasExtension ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}