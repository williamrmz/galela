<?php
namespace App\VB\SIGHIntegracion;

use Illuminate\Database\Eloquent\Model;

class Patient extends model
{
    protected $fillable = [
        'paciente', 
        'distrito',
        'pais',
        'SystemTypeSource',
        'SystemProvider',
        'nuevoPaciente',
    ];

    // public function NuevoPaciente() {
    //     $this->setConfigurationPatienteFactory();
    //     $this->nuevoPaciente = mo_PatientFactory.NuevoPaciente
    // }


    // Private Function setConfigurationPatienteFactory() As Boolean
    //     mo_PatientFactory.SystemProvider = ml_SystemProvider
    //     mo_PatientFactory.SystemTypeSource = ml_SystemTypeSource
    //     Set mo_PatientFactory.Paciente = mo_paciente
        
    //     Set mo_PatientFactory.Pais = mo_DOPais
    //     Set mo_PatientFactory.Distrito = mo_DoDistrito
    // End Function

}