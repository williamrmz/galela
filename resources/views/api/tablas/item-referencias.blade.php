<div class="table-responsive">
    <table class="table table-condensed table-hover table-bordered" style="margin-bottom:0">
        <thead>
            <tr class="bg-gray" align="center" style="font-weight: bold">
                <td>#</td>
                <td>Sexo</td>
                <td>Edad</td>
                <td>Referencias</td>
            </tr>
        </thead>

        <tbody>
            @foreach ($item->referencias as $key => $ref)
                @if($ref->valor_tipo=='N')
                    @php
                        $sexo = $ref->sexo_id==1? 'Masculino':
                                $ref->sexo_id==2? 'Femenino': 'Ambos';

                        $edadUnidad = $ref->edad_unidad=='A'? 'años' : 'dias';
                        $valMin = ''.number_format($ref->valor_min, 2, '.', '');
                        $valMax = ''.number_format($ref->valor_max, 2, '.', '');

                        $edadRango = "[$ref->edad_min - $ref->edad_max] $edadUnidad";

                        $valRango = "[$valMin - $valMax] $ref->valor_unidad";

                    @endphp
                    <tr align="center">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $sexo }}</td>
                        <td>{{ $edadRango }}</td>
                        <td>{{ $valRango }}</td>
                    </tr>   
                @endIf
            @endforeach
        </tbody>
    </table>
</div>