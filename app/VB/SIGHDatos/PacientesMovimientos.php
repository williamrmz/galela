<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PacientesMovimientos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC PacientesMovimientosAgregar :idCuentaAtencion, :peso, :talla, :idDiagnostico, :grafXedadEnMeses, :grafYpercentilTE, :grafYpercentilPT, :grafYpercentilPE, :zetaPT, :zetaTE, :zetaPE, :hemoglobina, :parasitosis, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'peso' => $oTabla->peso, 
			'talla' => $oTabla->talla, 
			'idDiagnostico' => ($oTabla->idDxNutricional == 0)? Null: $oTabla->idDxNutricional, 
			'grafXedadEnMeses' => ($oTabla->grafXedadEnMeses == 0)? Null: $oTabla->grafXedadEnMeses, 
			'grafYpercentilTE' => ($oTabla->grafYpercentilTE == 0)? Null: $oTabla->grafYpercentilTE, 
			'grafYpercentilPT' => ($oTabla->grafYpercentilPT == 0)? Null: $oTabla->grafYpercentilPT, 
			'grafYpercentilPE' => ($oTabla->grafYpercentilPE == 0)? Null: $oTabla->grafYpercentilPE, 
			'zetaPT' => $oTabla->zetaPT, 
			'zetaTE' => $oTabla->zetaTE, 
			'zetaPE' => $oTabla->zetaPE, 
			'hemoglobina' => ($oTabla->hemoglobina == 0)? Null: $oTabla->hemoglobina, 
			'parasitosis' => ($oTabla->parasitosis == "")? Null: $oTabla->parasitosis, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PacientesMovimientosModificar :idCuentaAtencion, :peso, :talla, :idDiagnostico, :grafXedadEnMeses, :grafYpercentilTE, :grafYpercentilPT, :grafYpercentilPE, :zetaPT, :zetaTE, :zetaPE, :hemoglobina, :parasitosis, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'peso' => $oTabla->peso, 
			'talla' => $oTabla->talla, 
			'idDiagnostico' => ($oTabla->idDxNutricional == 0)? Null: $oTabla->idDxNutricional, 
			'grafXedadEnMeses' => ($oTabla->grafXedadEnMeses == 0)? Null: $oTabla->grafXedadEnMeses, 
			'grafYpercentilTE' => ($oTabla->grafYpercentilTE == 0)? Null: $oTabla->grafYpercentilTE, 
			'grafYpercentilPT' => ($oTabla->grafYpercentilPT == 0)? Null: $oTabla->grafYpercentilPT, 
			'grafYpercentilPE' => ($oTabla->grafYpercentilPE == 0)? Null: $oTabla->grafYpercentilPE, 
			'zetaPT' => $oTabla->zetaPT, 
			'zetaTE' => $oTabla->zetaTE, 
			'zetaPE' => $oTabla->zetaPE, 
			'hemoglobina' => ($oTabla->hemoglobina == 0)? Null: $oTabla->hemoglobina, 
			'parasitosis' => ($oTabla->parasitosis == "")? Null: $oTabla->parasitosis, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PacientesMovimientosEliminar :idCuentaAtencion, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PacientesMovimientosSeleccionarPorId :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}