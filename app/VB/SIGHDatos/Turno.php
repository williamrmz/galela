<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Turno extends Model
{
    protected $table = "Turnos";
    protected $primaryKey = "IdTurno";
    protected $fillable = [
            "IdTurno",
            "Codigo",
            "Descripcion",
            "HoraInicio",
            "HoraFin",
            "IdTipoServicio",
            "IdEspecialidad"
        ];
    public $timestamps = false;

	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTurno AS Int = :idTurno
			SET NOCOUNT ON 
			EXEC TurnosAgregar :idEspecialidad, :codigo, :idTipoServicio, :horaFin, :horaInicio, :descripcion, @idTurno OUTPUT, :idTipoTurnoRef, :idUsuarioAuditoria
			SELECT @idTurno AS idTurno";

		$params = [
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'horaFin' => ($oTabla->horaFin == "")? Null: $oTabla->horaFin, 
			'horaInicio' => ($oTabla->horaInicio == "")? Null: $oTabla->horaInicio, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTurno' => 0, 
			'idTipoTurnoRef' => ($oTabla->idTipoTurnoRef == 0)? Null: $oTabla->idTipoTurnoRef, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TurnosModificar :idEspecialidad, :codigo, :idTipoServicio, :horaFin, :horaInicio, :descripcion, :idTurno, :idTipoTurnoRef, :idUsuarioAuditoria";

		$params = [
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'horaFin' => ($oTabla->horaFin == "")? Null: $oTabla->horaFin, 
			'horaInicio' => ($oTabla->horaInicio == "")? Null: $oTabla->horaInicio, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idTipoTurnoRef' => ($oTabla->idTipoTurnoRef == 0)? Null: $oTabla->idTipoTurnoRef, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TurnosEliminar :idTurno, :idUsuarioAuditoria";

		$params = [
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TurnosSeleccionarPorId :idTurno";

		$params = [
			'idTurno' => $oTabla->idTurno, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TurnosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorEspecialidad($lIdEspecialidad)
	{
		$query = "
			EXEC TurnosSeleccionarPorEspecialidad :idEspecialidad";

		$params = [
			'idEspecialidad' => $lIdEspecialidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

    public static function SeleccionarPorIdTipoServicio($idTipoServicio)
    {
        $query = "
			EXEC TurnosSeleccionarPorIdTipoServicio :IdTipoServicio";

        $params = [
            'IdTipoServicio' => $idTipoServicio,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

	public function SeleccionarPorCodigo($oTabla)
	{
		$query = "
			EXEC TurnosXcodigo :codigo";

		$params = [
			'codigo' => $oTabla->codigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	// :: 28/01/2020 LA
    public static function filtrar($textoFiltrar)
    {
        $page = request()->page;
        $size = 10;
        $rowStart = ($page-1) * $size;

        $params = [ 'size' => $size, 'rowStart' => $rowStart,];

        $queryPag = "ORDER BY Turnos.Codigo, Turnos.Descripcion OFFSET :rowStart ROWS FETCH NEXT :size ROWS ONLY";

        $querySelect = "Select Turnos.IdTurno, Turnos.Codigo, Turnos.Descripcion, Turnos.HoraInicio, Turnos.HoraFin,
                        TiposServicio.Descripcion as TipoServicio, Especialidades.Nombre as Especialidad";

        $queryFrom = " from ((Turnos left join TiposServicio on Turnos.IdTipoServicio = TiposServicio.IdTipoServicio) 
                        left join Especialidades on Turnos.IdEspecialidad = Especialidades.IdEspecialidad)";

        $queryWhere = " WHERE UPPER(Turnos.Descripcion) like '%$textoFiltrar%' ";

        $query = $querySelect . $queryFrom . $queryWhere .$queryPag;

        $queryCount = "SELECT count(*) total" . $queryFrom . $queryWhere;

        $items = DB::select( $query, $params );

        $count = DB::select( $queryCount );
        $total = reset( $count )->total; // first element of array

        $pag = new \Illuminate\Pagination\LengthAwarePaginator(
            collect ( $items )->forPage(1, $size),
            $total,
            $size,
            $page
        );

        return $pag;
    }

    // :: 29/01/2020 LA
    public static function guardar($oTurno)
    {
        $oTurno->save();
        return $oTurno;
    }

}