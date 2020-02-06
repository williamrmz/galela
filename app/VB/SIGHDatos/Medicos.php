<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Medicos extends Model
{
    protected $table        = "Medicos";
    protected $primaryKey   = "IdMedico";
    public $timestamps      = false;
    protected $fillable     = [
        "IdMedico",
        "Colegiatura",
        "IdEmpleado",
        "LoteHIS",
        "idColegioHIS"
    ];

    // :: 29/01/2020 LA
    public static function filtrarMedico($codPlanilla = '', $apePat = '', $apeMat = '', $nom = '')
    {

        $page = request()->page;
        $size = 20;
        $rowStart = ($page-1) * $size;

        $params = [ 'size' => $size, 'rowStart' => $rowStart,];

        $queryPag = "order by Empleados.ApellidoPaterno, Empleados.ApellidoMaterno, Empleados.Nombres OFFSET :rowStart ROWS FETCH NEXT :size ROWS ONLY";

        $querySelect = "select Medicos.IdMedico, Empleados.CodigoPlanilla, Empleados.ApellidoPaterno,
                        Empleados.ApellidoMaterno, Empleados.Nombres, 
                        Especialidades.Nombre as Especialidad , Medicos.Colegiatura ";

        $queryFrom   = " from ((Medicos left join Empleados on Medicos.IdEmpleado = Empleados.IdEmpleado) 
                        left join MedicosEspecialidad on Medicos.IdMedico = MedicosEspecialidad.IdMedico) 
                        left join Especialidades on MedicosEspecialidad.IdEspecialidad = Especialidades.IdEspecialidad";

        $queryWhere = " WHERE 1=1 ";

        if( $apePat != '')          $queryWhere .= " and Empleados.ApellidoPaterno like '%" . $apePat . "%' ";
        if( $apeMat != '')          $queryWhere .= " and Empleados.ApellidoMaterno like '%" . $apeMat . "%' ";
        if( $nom != '')             $queryWhere .= " and Empleados.Nombres like '%" . $nom . "%' ";
        if( $codPlanilla != '' )    $queryWhere .= " and Empleados.CodigoPlanilla = '" . $codPlanilla . "' ";

        $queryItems = $querySelect . $queryFrom . $queryWhere .$queryPag;

        $queryCount = "SELECT count(*) total" . $queryFrom . $queryWhere;

        $items = DB::select( $queryItems, $params );

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

	public function Insertar($oTabla)
	{
        // 30.01.2020 LA
        if ($oTabla->procedencia=="PROFESIONALESSALUD")
        {
            $oTabla->colegiatura = $oTabla->Colegiatura;
            $oTabla->loteHis = $oTabla->LoteHIS;
            $oTabla->idColegioHis = $oTabla->idColegioHIS;
            $oTabla->idEmpleado = $oTabla->IdEmpleado;
        }

		$query = "
			DECLARE @idMedico AS Int = :idMedico
			SET NOCOUNT ON 
			EXEC MedicosAgregar :idEmpleado, :colegiatura, @idMedico OUTPUT, :loteHis, :idColegioHIS, :rne, :egresado, :idUsuarioAuditoria
			SELECT @idMedico AS idMedico";

		$params = [
			'idEmpleado' => $oTabla->idEmpleado, 
			'colegiatura' => $oTabla->colegiatura, 
			'idMedico' => 0, 
			'loteHis' => ($oTabla->loteHis == "")? Null: $oTabla->loteHis, 
			'idColegioHIS' => ($oTabla->idColegioHis == "")? Null: $oTabla->idColegioHis, 
			'rne' => ($oTabla->rne == "")? Null: $oTabla->rne, 
			'egresado' => ($oTabla->egresado == True)? 1: 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC MedicosModificar :idEmpleado, :colegiatura, :idMedico, :loteHis, :idColegioHIS, :rne, :egresado, :idUsuarioAuditoria";

		$params = [
			'idEmpleado' => $oTabla->idEmpleado, 
			'colegiatura' => $oTabla->colegiatura, 
			'idMedico' => $oTabla->idMedico, 
			'loteHis' => ($oTabla->loteHis == "")? Null: $oTabla->loteHis, 
			'idColegioHIS' => ($oTabla->idColegioHis == "")? Null: $oTabla->idColegioHis, 
			'rne' => ($oTabla->rne == "")? Null: $oTabla->rne, 
			'egresado' => ($oTabla->egresado == True)? 1: 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC MedicosEliminar :idMedico, :idUsuarioAuditoria";

		$params = [
			'idMedico' => $oTabla->idMedico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC MedicosSeleccionarPorId :idMedico";

		$params = [
			'idMedico' => $oTabla->idMedico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($oDOMedico, $oDOEmpleado)
	{
		$query = "
			EXEC MedicosXcodigoPlanilla :codigoPlanilla";

		$params = [
			'codigoPlanilla' => $oDOEmpleado->codigoPlanilla, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC MedicosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPorDptosYEspecialidadEsActivo($idDepartamento, $idEspecialidad)
	{
		$lcSql = "";
	
		// 'yamill palomino
		if ( $idDepartamento > 0 and $idEspecialidad > 0) {
			$lcSql .= " where EsActivo = 1 and Especialidades.IdDepartamento = " . $idDepartamento . 
					"     and Especialidades.IdEspecialidad = " . idEspecialidad .
					" order by Nombre";
		} else if( $idDepartamento > 0 and $idEspecialidad == 0 ) {
			$lcSql .= " where EsActivo = 1 and Especialidades.IdDepartamento = " . $idDepartamento .
					" order by Nombre";
		} else if( $idDepartamento == 0 and $idEspecialidad > 0 ) {
			$lcSql .= " where EsActivo = 1 and Especialidades.IdEspecialidad = " . $idEspecialidad .
					" order by Nombre";
		} else if( $idDepartamento == 0 and $idEspecialidad == 0 ) {
			$lcSql .= " where EsActivo = 1  order by Nombre";
		}

		$query = "
			EXEC MedicosPorFiltro :lcFiltro";

		$params = [
			'lcFiltro' => $lcSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPorDptosYEspecialidadEsActivoConEspecialidad($IdDepartamento, $IdEspecialidad)
	{
		$lcSql = "";
	
		
		// 'yamill palomino
		if ( $IdDepartamento > 0 and $IdEspecialidad > 0 ) {
			$lcSql = $lcSql . " where EsActivo = 1 and Especialidades.IdDepartamento = " . $IdDepartamento .
					"     and Especialidades.IdEspecialidad = " . $IdEspecialidad .
					" order by Nombre";
		} else if ( $IdDepartamento > 0 and $IdEspecialidad == 0) {
			$lcSql = $lcSql . " where EsActivo = 1 and Especialidades.IdDepartamento = " . $IdDepartamento .
					" order by Nombre";
		} else if ( $IdDepartamento == 0 and $IdEspecialidad > 0) {
			$lcSql = $lcSql . " where EsActivo = 1 and Especialidades.IdEspecialidad = " . $IdEspecialidad .
					" order by Nombre";
		} else if ( $IdDepartamento == 0 and $IdEspecialidad == 0) {
			$lcSql = $lcSql . " where EsActivo = 1  order by Nombre"; //TODO: no existe columna EsActivo en V3
		}

		$query = "
			EXEC MedicosPorFiltroConEspecialidad :lcFiltro";

		$params = [
			'lcFiltro' => $lcSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarEspecialidadCE()
	{
		$query = "
			EXEC Listaespecialidades ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPorProgramacion($idDepartamento, $idEspecialidad, $lnIdservicio, $daFecha)
	{
		$query = "
			EXEC MedicosFiltrarPorProgramacion :lcFiltro";

		$params = [
			'lcFiltro' => lcSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPorProgramacion1($idEspecialidad, $lnIdservicio, $daFecha)
	{
		$query = "
			EXEC MedicosFiltrarPorProgramacion1 :idespecialidad";

		$params = [
			'idespecialidad' => IdEspecialidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOMedico, $oDOEmpleado, $lIdEspecialidad)
	{
		$query = "
			EXEC MedicosFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar1($oDOMedico, $oDOEmpleado, $lIdEspecialidad)
	{
		$query = "
			EXEC MedicosFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDepartamento($idMedico)
	{
		$query = "
			DECLARE @idDepartamento AS Int = :idDepartamento
			SET NOCOUNT ON 
			EXEC MedicosObtenerDepartamento :idMedico, @idDepartamento OUTPUT
			SELECT @idDepartamento AS idDepartamento";

		$params = [
			'idMedico' => IdMedico, 
			'idDepartamento' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public static function FiltrarPorDptoYEspecialidad($IdDepartamento, $IdEspecialidad)
	{
        $cmbIdMedico = self::join('Empleados', 'Medicos.IdEmpleado', '=', 'Empleados.IdEmpleado')
            ->join('MedicosEspecialidad', 'Medicos.IdMedico', '=', 'MedicosEspecialidad.IdMedico')
            ->join('Especialidades', 'MedicosEspecialidad.IdEspecialidad', '=', 'Especialidades.IdEspecialidad')
            ->where('Especialidades.IdDepartamento', $IdDepartamento)
            ->where('Especialidades.IdEspecialidad', $IdEspecialidad)
            ->selectRaw("distinct Medicos.IdMedico, Empleados.ApellidoPaterno + ' ' + Empleados.ApellidoMaterno + ' ' + Empleados.Nombres as DescripcionLarga")
            ->get();

        return $cmbIdMedico;
	}

	public function SeleccionarPorIdEmpleado($oTabla)
	{
		$query = "
			EXEC MedicosXidEmpleado :idEmpleado";

		$params = [
			'idEmpleado' => $oTabla->idEmpleado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}