<?php

namespace App\Visual;

use App\BaseModel;
use DB;
class FarmMovimiento extends BaseModel
{
    protected $table = 'farmMovimiento';

    protected $primaryKey = 'MovNumero';

    protected $fillable = [
        'MovNumero',
        'MovTipo',
        'idAlmacenOrigen',
        'idAlmacenDestino',
        'idTipoConcepto',
        'DocumentoIdtipo',
        'DocumentoNumero',
        'Observaciones',
        'Total',
        'idMotivoAnulacion',
        'fechaAnulacion',
        'idUsuarioAnulacion',
        'fechaCreacion',
        'idUsuario',
        'idEstadoMovimiento',
        'estado',
        'idusuariom'
    ];


    public const MOV_SALIDA = 'S';
    public const MOV_ENTRADA = 'E';
    public const LAB_ALMACEN = 12;
    public const LAB_RESPONSABLE = 13;

    public const CONCEPTO_AJUSTE_INVENTARIO = 20;
    public const CONCEPTO_DISTRIBUCION = 4;

    public const ID_LIST_ITEM_NI = 1304;
    public const ID_LIST_ITEM_NS = 1305;

    public static function labResponsableActual()
    {
        $result = DB::table('farmMovimiento as m')
            ->leftJoin('Empleados as e', DB::raw('try_parse(e.DNI AS INT)'), DB::raw('try_parse(m.Observaciones AS INT)') )
            ->where(['idAlmacenDestino' => self::LAB_RESPONSABLE, 'MovTipo' => self::MOV_ENTRADA])
            ->orderBy('m.fechaCreacion', 'desc')
            ->get()->first();
        return $result;
    }

    public static function getStockLabResponsable()
    {
        $sql = 
        "SELECT 
            cbi.Codigo, cbi.Nombre, sbi.tipo, 
            sd.Lote, sd.FechaVencimiento,sd.idAlmacen,
            sd.idProducto, sd.Precio , sd.Cantidad AS Saldo,
            sd.idTipoSalidaBienInsumo AS idTipoSalidaBienInsumoSaldo
        FROM  farmSaldoDetallado  AS sd
        LEFT JOIN farmTipoSalidaBienInsumo AS sbi ON (sd.idTipoSalidaBienInsumo = sbi.idTipoSalidaBienInsumo)
        LEFT JOIN FactCatalogoBienesInsumos AS cbi ON (sd.idProducto = cbi.IdProducto)
        WHERE sd.IdAlmacen = ?
        AND (SELECT TOP 1  s.cantidad FROM FarmSaldo AS s 
            WHERE s.idAlmacen=sd.idAlmacen 
            AND s.idProducto=sd.idProducto 
            AND s.idTipoSalidaBienInsumo=sd.idTipoSalidaBienInsumo) >0
        ORDER BY cbi.Nombre";

        $productos = DB::select($sql, [13]);
        return $productos;
    }


    public static function nextNumDocNsParaResponsable()
    {
        $base = 'DR-'; // DISTRIBUCION A REPONSABLE
        $result = DB::table('farmMovimiento')
            ->where('idAlmacenDestino', self::LAB_RESPONSABLE)
            ->where('MovTipo', self::MOV_SALIDA)
            ->where('DocumentoNumero', 'like', "%$base%")
            ->orderBy('fechaCreacion', 'desc')
            ->first();

        $num = 1;
        if($result){
            $num = $result->DocumentoNumero;
            $dataArray = explode('-', $num);
            if(count($dataArray) == 2){
                $num = (int) $dataArray[1];
                $num ++;
            }
        }

        $num = '000000'.$num;
        $correlativo = $base . substr($num, -6);
        return $correlativo;
    }

    public static function lastNiEnResponsable()
    {
        $result = DB::table('farmMovimiento')
            ->where('idAlmacenDestino', self::LAB_RESPONSABLE)
            ->where('MovTipo', 'E')
            ->orderBy('fechaCreacion', 'desc')
            ->first();
        return $result;
    }

    public static function nextNumDocNsParaAlmacen()
    {
        $base = 'DA-'; // DISTRIBUCION A ALMACEN
        $result = DB::table('farmMovimiento')
            ->where('idAlmacenDestino', self::LAB_ALMACEN)
            ->where('MovTipo', self::MOV_SALIDA)
            ->where('DocumentoNumero', 'like', "%$base%")
            ->orderBy('fechaCreacion', 'desc')
            ->first();

        $num = 1;
        if($result){
            $num = $result->DocumentoNumero;
            $dataArray = explode('-', $num);
            if(count($dataArray) == 2){
                $num = (int) $dataArray[1];
                $num ++;
            }
        }

        $num = '000000'.$num;
        $correlativo = $base . substr($num, -6);
        return $correlativo;
    }

    public static function calcula_total($productos)
    {
        $total = 0;
        foreach($productos as $producto){
            $total += $producto['cantidad'] * $producto['precio'];
        }
        return $total;
    }    

    public static function generaNumeroDocumento($base)
    {
        $currentNum = FarmMovimiento::where('DocumentoNumero', 'LIKE', "$base-%")
            ->orderBy('DocumentoNumero', 'DESC')
            ->get()->first();
        $nextNum = 1;
        if($currentNum){
            $numArray = explode('-', $currentNum->DocumentoNumero);
            if(count($numArray) == 2){
                
                $nextNum = (int) $numArray[1];
                
                $nextNum ++;
                
            }
        }

        $nextNum = $base.'-'.zeroFill($nextNum, 4);
        return $nextNum;
    }


    public static function setProductosUsados($productos)
    {
        foreach($productos as $key => $producto){
            $saldo = $producto['saldo'];
            $cantidad = $saldo- $producto['cantidad'];
            $productos[$key]['cantidad']  = $cantidad;
            $productos[$key]['saldo']  = $saldo;
            $productos[$key]['total'] = $cantidad * $producto['precio'];
        }
        return $productos;
    }
}
