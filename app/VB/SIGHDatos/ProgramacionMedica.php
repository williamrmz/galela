<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ProgramacionMedica extends Model
{
    protected $table = "ProgramacionMedica";
    protected $primaryKey = "IdProgramacion";
    public $timestamps = false;
    protected $fillable =
        [
            "IdProgramacion",
            "IdMedico",
            "IdDepartamento",
            "Fecha",
            "HoraInicio",
            "HoraFin",
            "IdTipoProgramacion",
            "Descripcion",
            "IdTurno",
            "IdEspecialidad",
            "Color",
            "IdServicio",
            "IdTipoServicio",
            "FechaReg",
            "TiempoPromedioAtencion"
        ];

	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idProgramacion AS Int = :idProgramacion
			SET NOCOUNT ON 
			EXEC ProgramacionMedicaAgregar :idEspecialidad, :idTurno, :color, :idServicio, @idProgramacion OUTPUT, :idMedico, :idDepartamento, :idTipoServicio, :fecha, :horaInicio, :horaFin, :descripcion, :idTipoProgramacion, :fechaReg, :tiempoPromedioAtencion, :idUsuarioAuditoria
			SELECT @idProgramacion AS idProgramacion";

		$params = [
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'color' => ($oTabla->color == 0)? Null: $oTabla->color, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idProgramacion' => 0, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idDepartamento' => ($oTabla->idDepartamento == 0)? Null: $oTabla->idDepartamento, 
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'horaInicio' => ($oTabla->horaInicio == "")? Null: $oTabla->horaInicio, 
			'horaFin' => ($oTabla->horaFin == "")? Null: $oTabla->horaFin, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoProgramacion' => ($oTabla->idTipoProgramacion == 0)? Null: $oTabla->idTipoProgramacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'tiempoPromedioAtencion' => ($oTabla->tiempoPromedioAtencion == 0)? Null: $oTabla->tiempoPromedioAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProgramacionMedicaModificar :idEspecialidad, :idTurno, :color, :idServicio, :idProgramacion, :idMedico, :idDepartamento, :idTipoServicio, :fecha, :horaInicio, :horaFin, :descripcion, :idTipoProgramacion, :tiempoPromedioAtencion, :idUsuarioAuditoria";

		$params = [
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'color' => ($oTabla->color == 0)? Null: $oTabla->color, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idProgramacion' => ($oTabla->idProgramacion == 0)? Null: $oTabla->idProgramacion, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idDepartamento' => ($oTabla->idDepartamento == 0)? Null: $oTabla->idDepartamento, 
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'horaInicio' => ($oTabla->horaInicio == "")? Null: $oTabla->horaInicio, 
			'horaFin' => ($oTabla->horaFin == "")? Null: $oTabla->horaFin, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoProgramacion' => ($oTabla->idTipoProgramacion == 0)? Null: $oTabla->idTipoProgramacion, 
			'tiempoPromedioAtencion' => ($oTabla->tiempoPromedioAtencion == 0)? Null: $oTabla->tiempoPromedioAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProgramacionMedicaEliminar :idProgramacion, :idUsuarioAuditoria";

		$params = [
			'idProgramacion' => ($oTabla->idProgramacion == 0)? Null: $oTabla->idProgramacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ProgramacionMedicaSeleccionarPorId :idProgramacion";

		$params = [
			'idProgramacion' => $oTabla->idProgramacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorMedicoYMes($lIdMedico, $iMes, $iAnio, $lIdUsuario)
	{
		$query = "
			EXEC ProgramacionMedicaEliminarPorMedicoYMes :idMedico, :mes, :anio, :idUsuarioAuditoria";

		$params = [
			'idMedico' => $lIdMedico, 
			'mes' => $iMes, 
			'anio' => $iAnio, 
			'idUsuarioAuditoria' => $lIdUsuario, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorMedicoYMes($lIdMedico, $iMes, $iAnio)
	{
		$query = "
			EXEC ProgramacionMedicaSeleccionarPorMedicoYMes :idMedico, :mes, :anio";

		$params = [
			'idMedico' => $lIdMedico, 
			'mes' => $iMes, 
			'anio' => $iAnio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDiasDeCEProgPorMedicoYMes($lIdMedico, $iMes, $iAnio)
	{
		$query = "
			EXEC ProgramacionMedicaXMedicoMesAnio :lIdMedico, :iMes, :iAnio";

		$params = [
			'lIdMedico' => $lIdMedico, 
			'iMes' => $iMes, 
			'iAnio' => $iAnio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorMedico($lIdMedico)
	{
		$query = "
			EXEC ProgramacionMedicaXmedico :lIdMedico";

		$params = [
			'lIdMedico' => $lIdMedico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarHoraFinPorCitaAdicional($oTabla)
	{
		$query = "
			EXEC ProgramacionMedicaModificarHoraPorCitaAdicional :idProgramacion, :horaFin, :idUsuarioAuditoria";

		$params = [
			'idProgramacion' => ($oTabla->idProgramacion == 0)? Null: $oTabla->idProgramacion, 
			'horaFin' => ($oTabla->horaFin == "")? Null: $oTabla->horaFin, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	// 31.01.2020 (Lo mismo que SeleccionarPorMedico, pero con un mejor nombre y static)
    public static function programacionPorMedico($idMedico)
    {
        $query = "
			EXEC ProgramacionMedicaXmedico :lIdMedico";

        $params = [
            'lIdMedico' => $idMedico,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public static function getProgramaciPorMedicoDia($IdMedico, $fecha)
    {
        $items = self::join('Especialidades', 'ProgramacionMedica.IdEspecialidad', '=', 'Especialidades.IdEspecialidad')
            ->where('ProgramacionMedica.IdMedico', $IdMedico)
            ->whereRaw("CAST(ProgramacionMedica.Fecha as date) = '$fecha'")
            ->select('ProgramacionMedica.*', 'Especialidades.Nombre')
            ->orderBy('ProgramacionMedica.HoraInicio', 'asc')->get();
        return $items;
    }

    public static function getProgramacionMesSmall($IdMedico, $mes, $anio)
    {
        return self::join("Turnos", "ProgramacionMedica.IdTurno", "=", "Turnos.IdTurno")
            ->whereRaw("MONTH(ProgramacionMedica.Fecha) = $mes and YEAR(ProgramacionMedica.Fecha) = $anio and ProgramacionMedica.IdMedico = $IdMedico")
            ->selectRaw("ProgramacionMedica.IdProgramacion, ProgramacionMedica.Fecha, DAY(ProgramacionMedica.Fecha) as dia, ProgramacionMedica.HoraInicio, ProgramacionMedica.HoraFin, Turnos.Codigo,
                        DATEDIFF(HOUR, convert(time, ProgramacionMedica.HoraInicio), convert(time, ProgramacionMedica.HoraFin)) as horas,
                        RTRIM(LTRIM(Turnos.Codigo))+' ('+CAST(DATEDIFF(HOUR, convert(time, ProgramacionMedica.HoraInicio), convert(time, ProgramacionMedica.HoraFin))  as varchar)+')'  as descripcion")
            ->orderBy("ProgramacionMedica.Fecha", "asc")
            ->get();
    }


    public static function SeleccionarPorMedicoFechaHora($IdMedico, $Fecha, $HoraInicio, $HoraFin)
    {
        return self::where('IdMedico', $IdMedico)
            ->whereRaw("CAST(Fecha as date)='$Fecha'")
            ->whereRaw("('$HoraInicio' between CONVERT(TIME, HoraInicio) and DATEADD(MINUTE, -1, CONVERT(TIME, HoraFin)) or '$HoraFin' between DATEADD(MINUTE, +1, CONVERT(TIME, HoraInicio)) and CONVERT(TIME, HoraFin))")
            ->get();
    }

    public static function SeleccionarPorMedicoFechaHoraOtrosServicios($IdMedico, $Fecha, $HoraInicio, $HoraFin, $IdServicio)
    {
        return self::where('IdMedico', $IdMedico)
            ->where("IdServicio", "!=", $IdServicio)
            ->whereRaw("CAST(Fecha as date)='$Fecha'")
            ->whereRaw("('$HoraInicio' between CONVERT(TIME, HoraInicio) and DATEADD(MINUTE, -1, CONVERT(TIME, HoraFin)) or '$HoraFin' between DATEADD(MINUTE, +1, CONVERT(TIME, HoraInicio)) and CONVERT(TIME, HoraFin))")
            ->get();
    }


    public static function CitasSeleccionarPorServicioYfecha($IdServicio, $Fecha)
    {
        return DB::table("Citas")
            ->leftJoin("Pacientes", "Citas.IdPaciente", "=", "Pacientes.IdPaciente")
            ->whereRaw("CONVERT(DATE, dbo.Citas.Fecha) = '$Fecha' and Citas.idServicio = $IdServicio")
            ->selectRaw("Citas.IdProgramacion, Citas.Fecha, Citas.HoraInicio, Pacientes.ApellidoPaterno, 
            Pacientes.ApellidoMaterno, Pacientes.idDistritoDomicilio, Pacientes.PrimerNombre , 
            Pacientes.SegundoNombre, Pacientes.FechaNacimiento, Pacientes.NroHistoriaClinica,Citas.idServicio, 
            Pacientes.NroDocumento, Pacientes.IdTipoSexo,Pacientes.idPaciente")
            ->get();
    }

}