<?php

namespace App\VB\SIGHIntegracion;

use Illuminate\Database\Eloquent\Model;
use App\VB\SIGHIntegracion\Patient;
use App\VB\SIGHNegocios\ReglasComunes;
use App\VB\SIGHComun\DOPais;
use App\VB\SIGHComun\DODistrito;
use App\VB\SIGHComun\DOInteoIntegracionSistema;
use App\VB\SIGHDatos\InteoIntegracionSistema;

use DB;

class ReglasIntegracion extends Model
{
    private $mo_ReglasComunes;

    public function __construct()
    {
        $this->mo_ReglasComunes = new ReglasComunes;
    }


    public function EnviarDatosPacienteRisPacs($oDoPaciente, $nuevoPaciente = true)
    {
        $o_IntegrationPatient = new Patient;
        $oDOPais = new DOPais;
        $oDODistrito = new DODistrito;
        $oDOInteoIntegracionSistema = new DOInteoIntegracionSistema;

        $oDOInteoIntegracionSistema = $this->getProviderIntegration( param('sghRisPacs') );

        if ($oDOInteoIntegracionSistema != null) {
            $o_IntegrationPatient = new Patient;
            $o_IntegrationPatient->systemProvider = $oDOInteoIntegracionSistema->idProveedorSistema;  //'sghIntegracionProveedorSistema.sghCarestream
            $o_IntegrationPatient->systemTypeSource = param('sghIntegracionTipoSistema.sghRisPacs');
            
            
            $o_IntegrationPatient->paciente = $oDoPaciente;
            
            if ($oDoPaciente->idPaisDomicilio > 0) {
                $oDOPais = $this->mo_ReglasComunes->PaisSeleccionarPorId($oDoPaciente->idPaisDomicilio);
            }
            
            if ($oDoPaciente->idDistritoDomicilio > 0 ) {
                $oDODistrito = $this->mo_ReglasComunes->DistritoSeleccionarPorId($oDoPaciente->idDistritoDomicilio);
            }
            
            $o_IntegrationPatient->pais = $oDOPais;
            $o_IntegrationPatient->distrito = $oDODistrito;
            
            if ($nuevoPaciente == true) {
                $o_IntegrationPatient->NuevoPaciente();
            }else{
                $o_IntegrationPatient->EditarPaciente();
            }
            
            return true;
        }
    }

    public function getProviderIntegration( $ldTipoSistema )
    {
        
        $oInteoIntegracionSistema = new InteoIntegracionSistema;
        $oDOInteoIntegracionSistema = new DOInteoIntegracionSistema;


        $oDOInteoIntegracionSistema->idTipoSistema = $ldTipoSistema;

        dd('falla aki');
        $data = $oInteoIntegracionSistema->SeleccionarProveedorActual($oDOInteoIntegracionSistema);

        if( $data == true){
            return $oDOInteoIntegracionSistema;
        }
        return false;
    }

    
}