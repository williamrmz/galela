<?php
// simular los procedimientos o functiones de la base de datos
namespace App\Execute;

use DB;

class Procedure
{
    public static function HistoriasClinicasGenerarNroHistoria( $function, $a )
    {
        $params = [ 'idTipoNumeracion', 'nroHistoriaClinica'];
        validate_args($function, $params, $a);

        if ( $a->idTipoNumeracion == 3){
            // DB::commit();
            $data = DB::select(
                "SELECT TOP 1 nroHistoriaClinica FROM GeneradorNroHistoriaClinica 
                WHERE idTipoNumeracion = 3 AND estado = 1
                ORDER BY idNumerador");

            $a->nroHistoriaClinica = isset( $data[0] )? $data[0]->nroHistoriaClinica: 0;

            if( $a->nroHistoriaClinica == 0){
                DB::update("UPDATE  GeneradorNroHistoriaClinica  SET estado = 0
                WHERE NroHistoriaClinica = $a->nroHistoriaClinica  and IdTipoNumeracion = 3");
            }
        }else{
            // DB::commit();
            $data = DB::select(
                "SELECT ISNULL( NroHistoriaClinica+1, 1) AS 'nroHistoriaClinica' FROM GeneradorNroHistoriaClinica 
                WHERE idTipoNumeracion = $a->idTipoNumeracion AND estado = 1");

            $a->nroHistoriaClinica = isset( $data[0] )? $data[0]->nroHistoriaClinica: 0;

            DB::update("UPDATE  GeneradorNroHistoriaClinica  SET nroHistoriaClinica = $a->nroHistoriaClinica
            WHERE idTipoNumeracion = $a->idTipoNumeracion  AND estado = 1");
        }
                    
        return jsonClass([
            'nroHistoriaClinica' => $a->nroHistoriaClinica,
        ]);

    }
}

