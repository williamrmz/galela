<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Paises extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC PaisesAgregar :nombre, :idPais, :idUsuarioAuditoria";

		$params = [
			'nombre' => $oTabla->nombre, 
			'idPais' => $oTabla->idPais, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PaisesModificar :nombre, :idPais, :idUsuarioAuditoria";

		$params = [
			'nombre' => $oTabla->nombre, 
			'idPais' => $oTabla->idPais, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PaisesEliminar :idPais, :idUsuarioAuditoria";

		$params = [
			'idPais' => $oTabla->idPais, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PaisesSeleccionarPorId :idPais";

		$params = [
			'idPais' => $oTabla->idPais, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC PaisesSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public static function buscarPaisPorNombre($nombrePais)
    {
        $objPais = new Paises();
        $data = $objPais->whereRaw("upper(Nombre) = ?", strtoupper($nombrePais))->first();
        return $data;
    }

}