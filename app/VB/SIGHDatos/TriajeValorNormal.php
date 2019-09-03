<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TriajeValorNormal extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTriajeValorNormal AS Int = :idTriajeValorNormal
			SET NOCOUNT ON 
			EXEC TriajeValorNormalAgregar @idTriajeValorNormal OUTPUT, :edadInicialEnDia, :edadFinalEnDia, :valorNormalMinimo, :valorNormalMaximo, :valorCoherenteMinimo, :valorCoherenteMaximo, :idTriajeVariable, :estadoPaciente, :sexoPaciente, :fechaVigencia, :idUsuarioAuditoria
			SELECT @idTriajeValorNormal AS idTriajeValorNormal";

		$params = [
			'idTriajeValorNormal' => 0, 
			'edadInicialEnDia' => ($oTabla->edadInicialEnDia == 0)? Null: $oTabla->edadInicialEnDia, 
			'edadFinalEnDia' => ($oTabla->edadFinalEnDia == 0)? Null: $oTabla->edadFinalEnDia, 
			'valorNormalMinimo' => $oTabla->valorNormalMinimo, 
			'valorNormalMaximo' => $oTabla->valorNormalMaximo, 
			'valorCoherenteMinimo' => $oTabla->valorCoherenteMinimo, 
			'valorCoherenteMaximo' => $oTabla->valorCoherenteMaximo, 
			'idTriajeVariable' => ($oTabla->idTriajeVariable == 0)? Null: $oTabla->idTriajeVariable, 
			'estadoPaciente' => ($oTabla->estadoPaciente == 0)? Null: $oTabla->estadoPaciente, 
			'sexoPaciente' => ($oTabla->sexoPaciente == 0)? Null: $oTabla->sexoPaciente, 
			'fechaVigencia' => ($oTabla->fechaVigencia == 0)? Null: $oTabla->fechaVigencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TriajeValorNormalModificar :idTriajeValorNormal, :edadInicialEnDia, :edadFinalEnDia, :valorNormalMinimo, :valorNormalMaximo, :valorCoherenteMinimo, :valorCoherenteMaximo, :idTriajeVariable, :estadoPaciente, :sexoPaciente, :fechaVigencia, :idUsuarioAuditoria";

		$params = [
			'idTriajeValorNormal' => ($oTabla->idTriajeValorNormal == 0)? Null: $oTabla->idTriajeValorNormal, 
			'edadInicialEnDia' => ($oTabla->edadInicialEnDia == 0)? Null: $oTabla->edadInicialEnDia, 
			'edadFinalEnDia' => ($oTabla->edadFinalEnDia == 0)? Null: $oTabla->edadFinalEnDia, 
			'valorNormalMinimo' => $oTabla->valorNormalMinimo, 
			'valorNormalMaximo' => $oTabla->valorNormalMaximo, 
			'valorCoherenteMinimo' => $oTabla->valorCoherenteMinimo, 
			'valorCoherenteMaximo' => $oTabla->valorCoherenteMaximo, 
			'idTriajeVariable' => ($oTabla->idTriajeVariable == 0)? Null: $oTabla->idTriajeVariable, 
			'estadoPaciente' => ($oTabla->estadoPaciente == 0)? Null: $oTabla->estadoPaciente, 
			'sexoPaciente' => ($oTabla->sexoPaciente == 0)? Null: $oTabla->sexoPaciente, 
			'fechaVigencia' => ($oTabla->fechaVigencia == 0)? Null: $oTabla->fechaVigencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TriajeValorNormalEliminar :idTriajeValorNormal, :idUsuarioAuditoria";

		$params = [
			'idTriajeValorNormal' => $oTabla->idTriajeValorNormal, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TriajeValorNormalSeleccionarPorId :idTriajeValorNormal";

		$params = [
			'idTriajeValorNormal' => $oTabla->idTriajeValorNormal, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarValorNormalesSegunParametros($oTabla)
	{
		$query = "
			EXEC TriajeValorNormalesSegunParamtros :edadInicialEnDia, :sexoPaciente, :fechaVigencia, :estadoPaciente";

		$params = [
			'edadInicialEnDia' => $oTabla->edadInicialEnDia, 
			'sexoPaciente' => $oTabla->sexoPaciente, 
			'fechaVigencia' => $oTabla->fechaVigencia, 
			'estadoPaciente' => $oTabla->estadoPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}