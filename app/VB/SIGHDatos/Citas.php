<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Citas extends Model
{
    protected $table = 'Citas';
    protected $primaryKey = 'IdCita';
    public $timestamps = false;
    protected $fillable =
        [
            "Fecha",
            "HoraInicio",
            "HoraFin",
            "IdPaciente",
            "IdEstadoCita",
            "IdAtencion",
            "IdMedico",
            "IdEspecialidad",
            "IdServicio",
            "IdProgramacion",
            "IdProducto",
            "FechaSolicitud",
            "HoraSolicitud",
            "EsCitaAdicional",
        ];

    public function Insertar($oTabla)
    {
        $query = "
			DECLARE @idCita AS Int = :idCita
			SET NOCOUNT ON
			EXEC CitasAgregar :horaSolicitud, :fechaSolicitud, :idProducto, :idProgramacion, :idServicio, :horaFin, :horaInicio, @idCita OUTPUT, :fecha, :idEstadoCita, :idMedico, :idEspecialidad, :idAtencion, :idPaciente, :esCitaAdicional, :idUsuarioAuditoria
			SELECT @idCita AS idCita";

        $params = [
            'horaSolicitud' => ($oTabla->horaSolicitud == "") ? Null : $oTabla->horaSolicitud,
            'fechaSolicitud' => ($oTabla->fechaSolicitud == 0) ? Null : $oTabla->fechaSolicitud,
            'idProducto' => ($oTabla->idProducto == 0) ? Null : $oTabla->idProducto,
            'idProgramacion' => ($oTabla->idProgramacion == 0) ? Null : $oTabla->idProgramacion,
            'idServicio' => ($oTabla->idServicio == 0) ? Null : $oTabla->idServicio,
            'horaFin' => ($oTabla->horaFin == "") ? Null : $oTabla->horaFin,
            'horaInicio' => ($oTabla->horaInicio == "") ? Null : $oTabla->horaInicio,
            'idCita' => 0,
            'fecha' => ($oTabla->fecha == 0) ? Null : $oTabla->fecha,
            'idEstadoCita' => ($oTabla->idEstadoCita == 0) ? Null : $oTabla->idEstadoCita,
            'idMedico' => ($oTabla->idMedico == 0) ? Null : $oTabla->idMedico,
            'idEspecialidad' => ($oTabla->idEspecialidad == 0) ? Null : $oTabla->idEspecialidad,
            'idAtencion' => ($oTabla->idAtencion == 0) ? Null : $oTabla->idAtencion,
            'idPaciente' => ($oTabla->idPaciente == 0) ? Null : $oTabla->idPaciente,
            'esCitaAdicional' => ($oTabla->esCitaAdicional == True) ? 1 : 0,
            'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria,
        ];

        $data = \DB::select($query, $params);

        $data = reset($data);

        return $data;
    }

    public function Modificar($oTabla)
    {
        $query = "
			EXEC CitasModificar :horaSolicitud, :fechaSolicitud, :idProducto, :idProgramacion, :idServicio, :horaFin, :horaInicio, :idCita, :fecha, :idEstadoCita, :idMedico, :idEspecialidad, :idAtencion, :idPaciente, :esCitaAdicional, :idUsuarioAuditoria";

        $params = [
            'horaSolicitud' => ($oTabla->horaSolicitud == "") ? Null : $oTabla->horaSolicitud,
            'fechaSolicitud' => ($oTabla->fechaSolicitud == 0) ? Null : $oTabla->fechaSolicitud,
            'idProducto' => ($oTabla->idProducto == 0) ? Null : $oTabla->idProducto,
            'idProgramacion' => ($oTabla->idProgramacion == 0) ? Null : $oTabla->idProgramacion,
            'idServicio' => ($oTabla->idServicio == 0) ? Null : $oTabla->idServicio,
            'horaFin' => ($oTabla->horaFin == "") ? Null : $oTabla->horaFin,
            'horaInicio' => ($oTabla->horaInicio == "") ? Null : $oTabla->horaInicio,
            'idCita' => ($oTabla->idCita == 0) ? Null : $oTabla->idCita,
            'fecha' => ($oTabla->fecha == 0) ? Null : $oTabla->fecha,
            'idEstadoCita' => ($oTabla->idEstadoCita == 0) ? Null : $oTabla->idEstadoCita,
            'idMedico' => ($oTabla->idMedico == 0) ? Null : $oTabla->idMedico,
            'idEspecialidad' => ($oTabla->idEspecialidad == 0) ? Null : $oTabla->idEspecialidad,
            'idAtencion' => ($oTabla->idAtencion == 0) ? Null : $oTabla->idAtencion,
            'idPaciente' => ($oTabla->idPaciente == 0) ? Null : $oTabla->idPaciente,
            'esCitaAdicional' => ($oTabla->esCitaAdicional == True) ? 1 : 0,
            'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria,
        ];

        $data = \DB::update($query, $params);

        return $data;
    }

    public function Eliminar($oTabla)
    {
        $query = "
			EXEC CitasEliminar :idCita, :idUsuarioAuditoria";

        $params = [
            'idCita' => ($oTabla->idCita == 0) ? Null : $oTabla->idCita,
            'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria,
        ];

        $data = \DB::update($query, $params);

        return $data;
    }

    public function SeleccionarPorId($oTabla)
    {
        $query = "
			EXEC CitasSeleccionarPorId :idCita";

        $params = [
            'idCita' => $oTabla->idCita,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function SeleccionarPorMedicoYFecha($lIdMedico, $daFecha)
    {
        $query = "
			EXEC CitasSeleccionarPorMedicoYFecha :idMedico, :fecha";

        $params = [
            'idMedico' => $lIdMedico,
            'fecha' => ($daFecha == 0) ? Null : $daFecha,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function SeleccionarBloqueadasPorMedicoYFecha($lIdMedico, $daFecha)
    {
        $query = "
			EXEC CitasSeleccionarBloqueadasPorMedicoYFecha :idMedico, :fecha";

        $params = [
            'idMedico' => $lIdMedico,
            'fecha' => ($daFecha == 0) ? Null : $daFecha,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function SeleccionarPorDisponiblesPorMedicoYFecha($lIdMedico, $daFecha)
    {
        $query = "
			EXEC CitasSeleccionarDisponiblesPorMedicoYFecha :idMedico, :fecha";

        $params = [
            'idMedico' => $lIdMedico,
            'fecha' => ($daFecha == 0) ? Null : $daFecha,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function SeleccionarPorDisponiblesPorMedicoEspecialidadYFecha($lIdMedico, $lIdEspecialidad, $daFecha)
    {
        $query = "
			EXEC CitasSeleccionarDisponiblesPorMedicoEspecialidadYFecha :idMedico, :idEspecialidad, :fecha";

        $params = [
            'idMedico' => $lIdMedico,
            'idEspecialidad' => $lIdEspecialidad,
            'fecha' => ($daFecha == 0) ? Null : $daFecha,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function SeleccionarPacientesPorMedicoYFecha($lIdMedico, $daFecha)
    {
        $query = "
			EXEC CitasSeleccionarPacientePorMedicoYFecha :idMedico, :fecha";

        $params = [
            'idMedico' => $lIdMedico,
            'fecha' => ($daFecha == 0) ? Null : $daFecha,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function SeleccionarPorPacienteYFecha($lIdPaciente, $daFecha)
    {
        $query = "
			EXEC CitasSeleccionarPorPacienteYFecha :idPaciente, :fecha";

        $params = [
            'idPaciente' => $lIdPaciente,
            'fecha' => ($daFecha == 0) ? Null : $daFecha,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function ActualizarCitaPagada($lIdAtencion, $lIdUsuarioAuditoria)
    {
        $query = "
			EXEC CitasActualizarCitaPagada :idAtencion, :idUsuarioAuditoria";

        $params = [
            'idAtencion' => $lIdAtencion,
            'idUsuarioAuditoria' => $lIdUsuarioAuditoria,
        ];

        $data = \DB::update($query, $params);

        return $data;
    }

    public function ActualizarCitaPagadaDEBB($lIdAtencion, $lIdUsuarioAuditoria)
    {
        $query = "
			EXEC CitasActualizarCitaPagadaDEBB :idAtencion, :idUsuarioAuditoria";

        $params = [
            'idAtencion' => $lIdAtencion,
            'idUsuarioAuditoria' => $lIdUsuarioAuditoria,
        ];

        $data = \DB::update($query, $params);

        return $data;
    }

    public function SeleccionarPorIdCuenta($oTabla)
    {
        $query = "
			EXEC SeleccionarFechaReferencia :idAtencion";

        $params = [
            'idAtencion' => $oTabla->idAtencion,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function AgregarFechaReferenciaCita($oTabla)
    {
        $query = "
			EXEC ActualizarFechaReferenciaCitas :idAtencion, :fechaReferencia, :nroReferencia";

        $params = [
            'idAtencion' => $oTabla->idAtencion,
            'fechaReferencia' => ($oTabla->fechaReferencia == "") ? Null : $oTabla->fechaReferencia,
            'nroReferencia' => ($oTabla->nroReferencia == "") ? Null : $oTabla->nroReferencia,
        ];

        $data = \DB::update($query, $params);

        return $data;
    }

    public function RetornaFechaVigencias($ml_idAtencion)
    {
        $query = "
			EXEC CitasFechaReferenciaTranscurridos :idAtencion";

        $params = [
            'idAtencion' => $ml_idAtencion,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function retornaContraReferenciaTratamiento($ml_IdcuentaAtencion)
    {
        $query = "
			EXEC ListarContraReferecniaTratamiento :idCuentaAtencion";

        $params = [
            'idCuentaAtencion' => $ml_IdcuentaAtencion,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function RetornaFechaReferencia($nroReferencia, $ms_DNi)
    {
        $query = "
			EXEC RetornaFechaReferencia :nroReferencia, :dNI";

        $params = [
            'nroReferencia' => NroReferencia,
            'dNI' => $ms_DNi,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function RetornaServicio($ml_IdServicio)
    {
        $query = "
			EXEC SERVICIOSSELECCIONARPORID :idServicio";

        $params = [
            'idServicio' => $ml_IdServicio,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function RetornaNombreEstablecimiento($ml_idAtencion)
    {
        $query = "
			EXEC ListarEstablecimientoDestinoXIdAtencion :idAtencion";

        $params = [
            'idAtencion' => $ml_idAtencion,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

    public function ActualizarEstadoImpresionReferencia($oTabla)
    {
        $query = "
			EXEC actualizarestadoimpresionreferencia :idAtencion, :diasextension";

        $params = [
            'idAtencion' => $oTabla->idAtencion,
            'diasextension' => $oTabla->diasExtension,
        ];

        $data = \DB::update($query, $params);

        return $data;
    }

    public function RetornaIdEspecialidadXIdServicio($ml_IdEspecialidad)
    {
        $query = "
			EXEC RetornaIdEspecialidad :idServicio";

        $params = [
            'idServicio' => $ml_IdEspecialidad,
        ];

        $data = \DB::select($query, $params);

        return $data;
    }

}
