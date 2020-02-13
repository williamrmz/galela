<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesCE extends Model
{
    protected $connection = 'sqlsrv_ext';
    protected $table = "AtencionesCE";
    protected $primaryKey = "idAtencion";
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable =
        [
            "idAtencion",
            "NroHistoriaClinica",
            "CitaDniMedicoJamo",
            "CitaFecha",
            "CitaMedico",
            "CitaServicioJamo",
            "CitaIdServicio",
            "CitaMotivo",
            "CitaExamenClinico",
            "CitaDiagMed",
            "CitaExClinicos",
            "CitaTratamiento",
            "CitaObservaciones",
            "CitaFechaAtencion",
            "CitaIdUsuario",
            "TriajeEdad",
            "TriajePresion",
            "TriajeTalla",
            "TriajeTemperatura",
            "TriajePeso",
            "TriajeFecha",
            "TriajeIdUsuario",
            "TriajePulso",
            "TriajeFrecRespiratoria",
            "CitaAntecedente"
        ];

	public function Insertar($oTabla)
	{
		$query = "
			EXEC atencionesCEAgregar :idAtencion, :nroHistoriaClinica, :citaDniMedicoJamo, :citaFecha, :citaMedico, :citaServicioJamo, :citaIdServicio, :citaMotivo, :citaExamenClinico, :citaDiagMed, :citaExClinicos, :citaTratamiento, :citaObservaciones, :citaFechaAtencion, :citaIdUsuario, :triajeEdad, :triajePresion, :triajeTalla, :triajeTemperatura, :triajePeso, :triajeFecha, :triajeIdUsuario, :triajePulso, :triajeFrecRespiratoria, :citaAntecedente, :triajePerimCefalico, :triajeFrecCardiaca, :triajeOrigen, :triajeSaturacion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'nroHistoriaClinica' => ($oTabla->nroHistoriaClinica == "")? Null: $oTabla->nroHistoriaClinica, 
			'citaDniMedicoJamo' => ($oTabla->citaDniMedicoJamo == "")? Null: $oTabla->citaDniMedicoJamo, 
			'citaFecha' => ($oTabla->citaFecha == 0)? Null: $oTabla->citaFecha, 
			'citaMedico' => ($oTabla->citaMedico == "")? Null: $oTabla->citaMedico, 
			'citaServicioJamo' => ($oTabla->citaServicioJamo == "")? Null: $oTabla->citaServicioJamo, 
			'citaIdServicio' => ($oTabla->citaIdServicio == 0)? Null: $oTabla->citaIdServicio, 
			'citaMotivo' => ($oTabla->citaMotivo == "")? Null: $oTabla->citaMotivo, 
			'citaExamenClinico' => ($oTabla->citaExamenClinico == "")? Null: $oTabla->citaExamenClinico, 
			'citaDiagMed' => ($oTabla->citaDiagMed == "")? Null: $oTabla->citaDiagMed, 
			'citaExClinicos' => ($oTabla->citaExClinicos == "")? Null: $oTabla->citaExClinicos, 
			'citaTratamiento' => ($oTabla->citaTratamiento == "")? Null: $oTabla->citaTratamiento, 
			'citaObservaciones' => ($oTabla->citaObservaciones == "")? Null: $oTabla->citaObservaciones, 
			'citaFechaAtencion' => ($oTabla->citaFechaAtencion == 0)? Null: $oTabla->citaFechaAtencion, 
			'citaIdUsuario' => ($oTabla->citaIdUsuario == 0)? Null: $oTabla->citaIdUsuario, 
			'triajeEdad' => ($oTabla->triajeEdad == "")? Null: $oTabla->triajeEdad, 
			'triajePresion' => ($oTabla->triajePresion == "")? Null: $oTabla->triajePresion, 
			'triajeTalla' => ($oTabla->triajeTalla == "")? Null: $oTabla->triajeTalla, 
			'triajeTemperatura' => ($oTabla->triajeTemperatura == "")? Null: $oTabla->triajeTemperatura, 
			'triajePeso' => ($oTabla->triajePeso == "")? Null: $oTabla->triajePeso, 
			'triajeFecha' => ($oTabla->triajeFecha == 0)? Null: $oTabla->triajeFecha, 
			'triajeIdUsuario' => ($oTabla->triajeIdUsuario == 0)? Null: $oTabla->triajeIdUsuario, 
			'triajePulso' => ($oTabla->triajePulso == 0)? Null: $oTabla->triajePulso, 
			'triajeFrecRespiratoria' => ($oTabla->triajeFrecRespiratoria == 0)? Null: $oTabla->triajeFrecRespiratoria, 
			'citaAntecedente' => ($oTabla->citaAntecedente == "")? Null: $oTabla->citaAntecedente, 
			'triajePerimCefalico' => ($oTabla->triajePerimCefalico == 0)? Null: $oTabla->triajePerimCefalico, 
			'triajeFrecCardiaca' => ($oTabla->triajeFrecCardiaca == 0)? Null: $oTabla->triajeFrecCardiaca, 
			'triajeOrigen' => ($oTabla->triajeOrigen == 0)? Null: $oTabla->triajeOrigen, 
			'triajeSaturacion' => ($oTabla->triajeSaturacion == 0)? Null: $oTabla->triajeSaturacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC atencionesCEModificar :idAtencion, :nroHistoriaClinica, :citaDniMedicoJamo, :citaFecha, :citaMedico, :citaServicioJamo, :citaIdServicio, :citaMotivo, :citaExamenClinico, :citaDiagMed, :citaExClinicos, :citaTratamiento, :citaObservaciones, :citaFechaAtencion, :citaIdUsuario, :triajeEdad, :triajePresion, :triajeTalla, :triajeTemperatura, :triajePeso, :triajeFecha, :triajeIdUsuario, :triajePulso, :triajeFrecRespiratoria, :citaAntecedente, :triajePerimCefalico, :triajeFrecCardiaca, :triajeOrigen, :triajeSaturacion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'nroHistoriaClinica' => ($oTabla->nroHistoriaClinica == "")? Null: $oTabla->nroHistoriaClinica, 
			'citaDniMedicoJamo' => ($oTabla->citaDniMedicoJamo == "")? Null: $oTabla->citaDniMedicoJamo, 
			'citaFecha' => ($oTabla->citaFecha == 0)? Null: $oTabla->citaFecha, 
			'citaMedico' => ($oTabla->citaMedico == "")? Null: $oTabla->citaMedico, 
			'citaServicioJamo' => ($oTabla->citaServicioJamo == "")? Null: $oTabla->citaServicioJamo, 
			'citaIdServicio' => ($oTabla->citaIdServicio == 0)? Null: $oTabla->citaIdServicio, 
			'citaMotivo' => ($oTabla->citaMotivo == "")? Null: $oTabla->citaMotivo, 
			'citaExamenClinico' => ($oTabla->citaExamenClinico == "")? Null: $oTabla->citaExamenClinico, 
			'citaDiagMed' => ($oTabla->citaDiagMed == "")? Null: $oTabla->citaDiagMed, 
			'citaExClinicos' => ($oTabla->citaExClinicos == "")? Null: $oTabla->citaExClinicos, 
			'citaTratamiento' => ($oTabla->citaTratamiento == "")? Null: $oTabla->citaTratamiento, 
			'citaObservaciones' => ($oTabla->citaObservaciones == "")? Null: $oTabla->citaObservaciones, 
			'citaFechaAtencion' => ($oTabla->citaFechaAtencion == 0)? Null: $oTabla->citaFechaAtencion, 
			'citaIdUsuario' => ($oTabla->citaIdUsuario == 0)? Null: $oTabla->citaIdUsuario, 
			'triajeEdad' => ($oTabla->triajeEdad == "")? Null: $oTabla->triajeEdad, 
			'triajePresion' => ($oTabla->triajePresion == "")? Null: $oTabla->triajePresion, 
			'triajeTalla' => ($oTabla->triajeTalla == "")? Null: $oTabla->triajeTalla, 
			'triajeTemperatura' => ($oTabla->triajeTemperatura == "")? Null: $oTabla->triajeTemperatura, 
			'triajePeso' => ($oTabla->triajePeso == "")? Null: $oTabla->triajePeso, 
			'triajeFecha' => ($oTabla->triajeFecha == 0)? Null: $oTabla->triajeFecha, 
			'triajeIdUsuario' => ($oTabla->triajeIdUsuario == 0)? Null: $oTabla->triajeIdUsuario, 
			'triajePulso' => ($oTabla->triajePulso == 0)? Null: $oTabla->triajePulso, 
			'triajeFrecRespiratoria' => ($oTabla->triajeFrecRespiratoria == 0)? Null: $oTabla->triajeFrecRespiratoria, 
			'citaAntecedente' => ($oTabla->citaAntecedente == "")? Null: $oTabla->citaAntecedente, 
			'triajePerimCefalico' => ($oTabla->triajePerimCefalico == 0)? Null: $oTabla->triajePerimCefalico, 
			'triajeFrecCardiaca' => ($oTabla->triajeFrecCardiaca == 0)? Null: $oTabla->triajeFrecCardiaca, 
			'triajeOrigen' => ($oTabla->triajeOrigen == 0)? Null: $oTabla->triajeOrigen, 
			'triajeSaturacion' => ($oTabla->triajeSaturacion == 0)? Null: $oTabla->triajeSaturacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC atencionesCEEliminar :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => $oTabla->idatencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public static function SeleccionarPorId($idAtencion)
	{
		$query = "
			EXEC atencionesCESeleccionarPorId :idAtencion";

		$params = [
			'idAtencion' => $idAtencion,
		];

		$data = \DB::connection('sqlsrv_ext')->select($query, $params);

		return $data;
	}

	public function SeleccionarPorNroHistoria($oTabla)
	{
		$query = "
			EXEC AtencionesCeXnrohistoriaTriaje :ml_NroHistoriaClinica";

		$params = [
			'ml_NroHistoriaClinica' => $oTabla->nroHistoriaClinica, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesCeListaTriaje($oTabla)
	{
		$query = "
			EXEC AtencionesCeListaTriaje :idAtencion, :nroHistoriaClinica";

		$params = [
			'idAtencion' => $oTabla->idatencion, 
			'nroHistoriaClinica' => $oTabla->nroHistoriaClinica, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}