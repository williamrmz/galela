<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionesCE extends Model
{
    protected $connection = 'sqlsrv_ext';
    protected $table = 'AtencionesCE';
    protected $primaryKey = 'idAtencion';
	public $timestamps = false;

	public $fillable = [
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

	public static function SeleccionarPorNroHistoria($NroHistoriaClinica)
    {
        $sql = "EXEC AtencionesCeXnrohistoriaTriaje :NroHistoriaClinica;";
        $params = [
            'NroHistoriaClinica' => $NroHistoriaClinica
        ];

        return DB::connection('sqlsrv_ext')->select($sql, $params);
    }
}