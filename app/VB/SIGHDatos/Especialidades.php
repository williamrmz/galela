<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Especialidades extends Model
{
    protected $table = "Especialidades";
    protected $primaryKey = "IdEspecialidad";
    public $timestamps = false;
    protected $fillable =
        [
            "IdEspecialidad",
            "Nombre",
            "IdDepartamento",
            "TiempoPromedioAtencion"
        ];


	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEspecialidad AS Int = :idEspecialidad
			SET NOCOUNT ON 
			EXEC EspecialidadesAgregar @idEspecialidad OUTPUT, :nombre, :idDepartamento, :idUsuarioAuditoria
			SELECT @idEspecialidad AS idEspecialidad";

		$params = [
			'idEspecialidad' => 0, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idDepartamento' => ($oTabla->idDepartamento == 0)? Null: $oTabla->idDepartamento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC EspecialidadesModificar :idEspecialidad, :nombre, :idDepartamento, :idUsuarioAuditoria";

		$params = [
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idDepartamento' => ($oTabla->idDepartamento == 0)? Null: $oTabla->idDepartamento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EspecialidadesEliminar :idEspecialidad, :idUsuarioAuditoria";

		$params = [
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EspecialidadesSeleccionarPorId :idEspecialidad";

		$params = [
			'idEspecialidad' => $oTabla->idEspecialidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarAsistenciales()
	{
		$query = "
			EXEC EspecialidadesSeleccionarAsistenciales ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public static function SeleccionarPorDepartamento($idDepartamento)
	{
		$query = "
			EXEC EspecialidadesSeleccionarPorDepartamento :idDepartamento";

		$params = [
			'idDepartamento' => ($idDepartamento == 0)? Null: $idDepartamento,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorDepartamentoV2($idDepartamento)
	{
		$query = "
			EXEC EspecialidadesSeleccionarPorDepartamentoV2 :idDepartamento";

		$params = [
			'idDepartamento' => (IdDepartamento == 0)? Null: IdDepartamento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public static function SeleccionarPorMedico($idMedico)
	{
		$query = "
			EXEC EspecialidadesSeleccionarPorMedico :idMedico";

		$params = [
			'idMedico' => $idMedico,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipoServicioYDpto($idTipoServicio, $idDepartamento)
	{
		$query = "
			EXEC EspecialidadesXidTipoServicioIdDepartamento :idTipoServicio, :idDepartamento";

		$params = [
			'idTipoServicio' => IdTipoServicio, 
			'idDepartamento' => IdDepartamento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipoServicio($idTipoServicio)
	{
		$query = "
			EXEC EspecialidadesXidTipoServicio :idTipoServicio";

		$params = [
			'idTipoServicio' => IdTipoServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosEspecialidades()
	{
		$query = "
			EXEC EspecialidadSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosEspecialidades1()
	{
		$query = "
			EXEC EspecialidadSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDoEspecialidades)
	{
		$query = "
			EXEC EspecialidadesFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar1($oDoEspecialidades)
	{
		$query = "
			EXEC EspecialidadesFiltrar2 :especialidad";

		$params = [
			'especialidad' => $oDoEspecialidades->nombre, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos($idDepartamento)
	{
		$query = "
			EXEC EspecialidadesSeleccionarTodos :idDepartamento";

		$params = [
			'idDepartamento' => IdDepartamento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosEspecialidadesxFecha($fecha)
	{
		$query = "
			EXEC EspecialidadSeleccionarTodosxFecha :fecha";

		$params = [
			'fecha' => $fecha, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}