<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabItemCPT extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC LabItemsCptAgregar :idProductoCpt, :ordenXresultado, :idGrupo, :idItemGrupo, :idItem, :valorSiEsCombo, :valorReferencial, :metodo, :soloNumero, :soloTexto, :soloCombo, :soloCheck, :idUsuarioAuditoria";

		$params = [
			'idProductoCpt' => ($oTabla->idProductoCpt == 0)? Null: $oTabla->idProductoCpt, 
			'ordenXresultado' => ($oTabla->ordenXresultado == 0)? Null: $oTabla->ordenXresultado, 
			'idGrupo' => ($oTabla->idGrupo == 0)? Null: $oTabla->idGrupo, 
			'idItemGrupo' => ($oTabla->idItemGrupo == 0)? Null: $oTabla->idItemGrupo, 
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'valorSiEsCombo' => ($oTabla->valorSiEsCombo == "")? Null: $oTabla->valorSiEsCombo, 
			'valorReferencial' => ($oTabla->valorReferencial == "")? Null: $oTabla->valorReferencial, 
			'metodo' => ($oTabla->metodo == "")? Null: $oTabla->metodo, 
			'soloNumero' => ($oTabla->soloNumero == 0)? Null: $oTabla->soloNumero, 
			'soloTexto' => ($oTabla->soloTexto == 0)? Null: $oTabla->soloTexto, 
			'soloCombo' => ($oTabla->soloCombo == 0)? Null: $oTabla->soloCombo, 
			'soloCheck' => ($oTabla->soloCheck == 0)? Null: $oTabla->soloCheck, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC LabItemsCptModificar :idProductoCpt, :ordenXresultado, :idGrupo, :idItemGrupo, :idItem, :valorSiEsCombo, :valorReferencial, :metodo, :soloNumero, :soloTexto, :soloCombo, :soloCheck, :idUsuarioAuditoria";

		$params = [
			'idProductoCpt' => ($oTabla->idProductoCpt == 0)? Null: $oTabla->idProductoCpt, 
			'ordenXresultado' => ($oTabla->ordenXresultado == 0)? Null: $oTabla->ordenXresultado, 
			'idGrupo' => ($oTabla->idGrupo == 0)? Null: $oTabla->idGrupo, 
			'idItemGrupo' => ($oTabla->idItemGrupo == 0)? Null: $oTabla->idItemGrupo, 
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'valorSiEsCombo' => ($oTabla->valorSiEsCombo == "")? Null: $oTabla->valorSiEsCombo, 
			'valorReferencial' => ($oTabla->valorReferencial == "")? Null: $oTabla->valorReferencial, 
			'metodo' => ($oTabla->metodo == "")? Null: $oTabla->metodo, 
			'soloNumero' => ($oTabla->soloNumero == 0)? Null: $oTabla->soloNumero, 
			'soloTexto' => ($oTabla->soloTexto == 0)? Null: $oTabla->soloTexto, 
			'soloCombo' => ($oTabla->soloCombo == 0)? Null: $oTabla->soloCombo, 
			'soloCheck' => ($oTabla->soloCheck == 0)? Null: $oTabla->soloCheck, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC LabItemsCptEliminar :idProductoCpt, :idUsuarioAuditoria";

		$params = [
			'idProductoCpt' => $oTabla->idProductoCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($widProductoCpt)
	{
		$query = "
			EXEC LabItemsCptSeleccionarPorId :idProductoCpt";

		$params = [
			'idProductoCpt' => $widProductoCpt, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarUno($oTabla)
	{
		$query = "
			EXEC LabItemsCptModificarUno :idProductoCpt, :ordenXresultado, :idGrupo, :idItemGrupo, :idItem, :valorSiEsCombo, :valorReferencial, :metodo, :soloNumero, :soloTexto, :soloCombo, :soloCheck, :idUsuarioAuditoria";

		$params = [
			'idProductoCpt' => ($oTabla->idProductoCpt == 0)? Null: $oTabla->idProductoCpt, 
			'ordenXresultado' => ($oTabla->ordenXresultado == 0)? Null: $oTabla->ordenXresultado, 
			'idGrupo' => ($oTabla->idGrupo == 0)? Null: $oTabla->idGrupo, 
			'idItemGrupo' => ($oTabla->idItemGrupo == 0)? Null: $oTabla->idItemGrupo, 
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'valorSiEsCombo' => ($oTabla->valorSiEsCombo == "")? Null: $oTabla->valorSiEsCombo, 
			'valorReferencial' => ($oTabla->valorReferencial == "")? Null: $oTabla->valorReferencial, 
			'metodo' => ($oTabla->metodo == "")? Null: $oTabla->metodo, 
			'soloNumero' => ($oTabla->soloNumero == 0)? Null: $oTabla->soloNumero, 
			'soloTexto' => ($oTabla->soloTexto == 0)? Null: $oTabla->soloTexto, 
			'soloCombo' => ($oTabla->soloCombo == 0)? Null: $oTabla->soloCombo, 
			'soloCheck' => ($oTabla->soloCheck == 0)? Null: $oTabla->soloCheck, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function RetornaLabPruebas()
	{
		$query = "
			EXEC ListarPruebasLab ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarMedicosPatologos()
	{
		$query = "
			EXEC ListarMedicosPatologos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}