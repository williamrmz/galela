<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class DepartamentosHospital extends Model
{
    protected $table = "DepartamentosHospital";
    protected $primaryKey = "IdDepartamento";
    public $timestamps = false;
    protected $fillable =
        [
            "IdDepartamento",
            "Nombre"
        ];

	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idDepartamento AS Int = :idDepartamento
			SET NOCOUNT ON 
			EXEC DepartamentosHospitalAgregar :nombre, @idDepartamento OUTPUT, :idUsuarioAuditoria
			SELECT @idDepartamento AS idDepartamento";

		$params = [
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idDepartamento' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC DepartamentosHospitalModificar :nombre, :idDepartamento, :idUsuarioAuditoria";

		$params = [
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idDepartamento' => ($oTabla->idDepartamento == "")? Null: $oTabla->idDepartamento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC DepartamentosHospitalEliminar :idDepartamento, :idUsuarioAuditoria";

		$params = [
			'idDepartamento' => ($oTabla->idDepartamento == "")? Null: $oTabla->idDepartamento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC DepartamentosHospitalSeleccionarPorId :idDepartamento";

		$params = [
			'idDepartamento' => $oTabla->idDepartamento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public static function SeleccionarTodos()
	{
		$query = "
			EXEC DepartamentosHospitalSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipoServicio($idTipoServicio)
	{
		$query = "
			EXEC DepartamentosHospitalSeleccionaPorTipoServicio :idTipoServicio";

		$params = [
			'idTipoServicio' => IdTipoServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}