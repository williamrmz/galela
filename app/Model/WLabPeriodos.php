<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WLabPeriodos extends Model
{
    protected $table = "WLabPeriodos";

    protected $primaryKey = 'IdPeriodo';

    public $timestamps = false;


    public function area()
    {
        return $this->hasOne('App\Model\LabGrupos', 'idGrupo', 'IdArea');
    }

    public function getNombreMesAttribute()
    {
        $meses = self::meses();
        try {
            return $meses[$this->Mes];
            $meses[$this->Mes];
        } catch (\Exception $e) {
            return 'Uknown';
        }
    }

    public function periodoTxt()
    {
        $meses = WLabPeriodos::meses();
        $mes = $meses[$this->Mes];
        $anio = $this->Anio;
        $texto = "$anio - $mes";
        return $texto;
    }

    public static function calNumDias($anio, $mes)
    {
        $fecha = "$anio-$mes-01";
        $dias = date( "t", strtotime( $fecha ) );
        return $dias;
    }

    public static function meses()
    {
        $meses = [
            1=>'Enero', 2=>'Febrero', 3=>'Marzo', 4=>'Abril', 5=>'Mayo', 6=>'Junio', 
            7=>'Julio', 8=>'Agosto', 9=>'Septiembre', 10=>'octubre', 11=>'Noviembre', 12=>'Diciembre'
        ];
        return $meses;
    }

    public static function anios()
    {
        $anios = [];
        $currentYear = date('Y');
        $maxYear = 2050;
        for( $i = $currentYear; $i<=$maxYear; $i++){
            $anios[$i] = $i;
        }
        return $anios;

    }
}
