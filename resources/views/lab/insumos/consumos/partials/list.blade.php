
<style type="text/css">
    .cell-center-v {
        vertical-align: middle !important;
    }
    .cell-center-vh {
        vertical-align: middle !important;
        text-align: center !important;
    }
</style>

<div class="table-responsive">
    <table class="table table-bordered table-condensed" style="margin-bottom:0">
        <thead>
            <tr align="center" style="font-weight:bold;" class="bg-gray-active color-palette">
                <td rowspan="2" style="vertical-align: middle;">Codigo</td>
                <td rowspan="2" style="vertical-align: middle;">Insumo</td>
                <td rowspan="2" style="vertical-align: middle;">Almacen</td>
                <td rowspan="2" style="vertical-align: middle;">Cantidad</td>
                <td rowspan="2" style="vertical-align: middle;">Fecha Recepcion</td>
                <td rowspan="2" style="vertical-align: middle;">Fecha Devolucion</td>
                
                <td rowspan="2" style="vertical-align: middle;">
                    <button type="button" class="btn btn-xs btn-link" data-toggle="tooltip" data-placement="top" title="Consumo Esperado"><b>CoE</b></button>
                </td>
                <td rowspan="2" style="vertical-align: middle;">
                    <button type="button" class="btn btn-xs btn-link" data-toggle="tooltip" data-placement="top" title="Consumo Real"><b>CoR</b></button>
                </td>

                <td colspan="5" style="vertical-align: middle;">Detalle</td>
            </tr>
            <tr align="center" style="font-weight:bold;" class="bg-gray-active color-palette">
                <td>Fecha</td>
                <td>Servicio</td>
                <td>Empleado</td>
                <td>
                    <button type="button" class="btn btn-xs btn-link" data-toggle="tooltip" data-placement="top" title="Cantidad Referencial"><b>CaR</b></button>
                </td>
                <td style="vertical-align: middle;">
                    <button type="button" class="btn btn-xs btn-link" data-toggle="tooltip" data-placement="top" title="Cantidad Utilizada"><b>CaU</b></button>
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $insumo)
                @php
                    $entradas = $insumo['entradas'];
                    $numEntradas = count($entradas);
                    $onceL1 = true;
                @endphp

                
                @foreach ($entradas as $entrada)
                    @php
                        // dd($entradas);
                        $onceL2 = true;
                        $detalles = isset($entrada['consumoDetalle'])? $entrada['consumoDetalle']: [];
                        $numDetalles = count($detalles);
                    @endphp

                    @foreach ($detalles as $detalle)

                        <tr >
                            @if( $onceL1)
                            <td rowspan="{{$numDetalles*$numEntradas}}" class="cell-center-v">{{ $insumo['codigoProductoInsumo'] }}</td>
                            <td rowspan="{{$numDetalles*$numEntradas}}" class="cell-center-v">{{ $insumo['nombreProductoInsumo'] }}</td>
                            <?php $onceL1 = false ?>
                            @endif

                            @if ($onceL2)
                            <td rowspan="{{$numDetalles}}" class="cell-center-v">{{ $entrada['empleado'] }}</td>
                            <td rowspan="{{$numDetalles}}" class="cell-center-vh">{{ $entrada['cantidad'] }}</td>
                            <td rowspan="{{$numDetalles}}" class="cell-center-vh">{{ dateFormat($entrada['fechaCreacion'], 'd/m/Y H:i') }}</td>
                            <td rowspan="{{$numDetalles}}" class="cell-center-vh">{{ dateFormat($entrada['fechaDevolucion'], 'd/m/Y H:i') }}</td>
                            <td rowspan="{{$numDetalles}}" class="cell-center-vh">{{ $entrada['consumoEsperado'] }}</td>
                            <td rowspan="{{$numDetalles}}" class="cell-center-vh">{{ $entrada['consumoReal'] }}</td>
                            <?php $onceL2 = false ?>
                            @endif
                            

                            <td class="cell-center-vh">{{ dateFormat($detalle['fecha'], 'd/m/Y H:i') }}</td>
                            <td>{{ $detalle['nombreProductoServicio'] }}</td>
                            <td>{{ $detalle['nombreEmpleado'] }}</td>
                            <td>{{ $detalle['cantidadReferencia'] }}</td>
                            <td>{{ $detalle['cantidadUsada'] }}</td>
                        </tr>   

                        
                    @endforeach

                    
                @endforeach
                
                
            @endforeach
                
        </tbody>
    </table>
</div>


