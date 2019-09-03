<style type="text/css">
    .cell-center {
        vertical-align: middle;
    }
</style>

<div class="table-responsive">
    <table class="table table-bordered table-condensed" style="margin-bottom:0">
        <thead>
            <tr align="center" style="font-weight:bold;" class="bg-gray-active color-palette">
                <td rowspan="2" style="vertical-align: middle;">Codigo</td>
                <td rowspan="2" style="vertical-align: middle;">Insumo</td>
                <td rowspan="2" style="vertical-align: middle;">Almacen</td>
                <td rowspan="2" style="vertical-align: middle;">
                    <button type="button" class="btn btn-xs btn-link" data-toggle="tooltip" data-placement="top" title="Consumo Real"><b>CoR</b></button>
                </td>
                <td rowspan="2" style="vertical-align: middle;">
                    <button type="button" class="btn btn-xs btn-link" data-toggle="tooltip" data-placement="top" title="Consumo Esperado"><b>CoE</b></button>
                </td>
                <td colspan="4" style="vertical-align: middle;">Detalle</td>
            </tr>
            <tr align="center" style="font-weight:bold;" class="bg-gray-active color-palette">
                <td style="vertical-align: middle;">Servicio</td>
                <td style="vertical-align: middle;">Empleado</td>
                <td style="vertical-align: middle;">
                    <button type="button" class="btn btn-xs btn-link" data-toggle="tooltip" data-placement="top" title="Cantidad Referencial"><b>CaR</b></button>
                </td>
                <td style="vertical-align: middle;">
                    <button type="button" class="btn btn-xs btn-link" data-toggle="tooltip" data-placement="top" title="Cantidad Utilizada"><b>CaU</b></button>
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $insumo)
                @php
                    $consumoDetalles = $insumo['consumoDetalle'];
                    dd($consumoDetalles);asdaasdfasf
                    
                    $cantDetalle = count($consumoDetalles);
                    $rowOnce = true;

                    $consumoClass = '';
                    if ( $insumo->Consumo > $insumo->ConsumoEsperado ){
                        $consumoClass = 'text-red';
                    }else if ( $insumo->Consumo < $insumo->ConsumoEsperado ){
                        $consumoClass = 'text-green';
                    }
                @endphp
                
                @foreach ($consumoDetalles  as $detalle)
                    @php
                        $cantidadClass = '';
                        if ( $detalle->CantidadUsada > $detalle->CantidadReferencia ){
                            $cantidadClass = 'text-red';
                        }else if ( $detalle->CantidadUsada < $detalle->CantidadReferencia ){
                            $cantidadClass = 'text-green';
                        }

                    @endphp
                    <tr>
                        @if($rowOnce)
                            <td rowspan="{{ $cantDetalle }}" style="vertical-align: middle;">{{ $insumo->IdProductoInsumo }}</td>
                            <td rowspan="{{ $cantDetalle }}" style="vertical-align: middle;">{{ $insumo->NombreProductoInsumo }}</td>
                            <td align="center" rowspan="{{ $cantDetalle }}" style="vertical-align: middle;">{{ $insumo->Almacen }}</td>
                            <td align="center" rowspan="{{ $cantDetalle }}" style="vertical-align: middle;" class="{{$consumoClass}}">{{ $insumo->Consumo }}</td>
                            <td align="center" rowspan="{{ $cantDetalle }}" style="vertical-align: middle;">{{ $insumo->ConsumoEsperado }}</td>

                            <td>{{ $detalle->NombreProductoServicio }}</td>
                            
                            <td>{{ $detalle->NombreEmpleado }}</td>
                            <td>{{ $detalle->CantidadReferencia }}</td>
                            <td class="{{$cantidadClass}}">{{ $detalle->CantidadUsada }}</td>
                        @else
                            <td>{{ $detalle->NombreProductoServicio }}</td>
                            <td>{{ $detalle->NombreEmpleado }}</td>
                            <td>{{ $detalle->CantidadReferencia }}</td>
                            <td class="{{$cantidadClass}}">{{ $detalle->CantidadUsada }}</td>
                        @endif

                        @php
                            $rowOnce = false;
                        @endphp
                    </tr>

                @endforeach
                 
            @endforeach
            
        </tbody>
    </table>
</div>


