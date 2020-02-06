<table class="table">
    <thead>
        <tr class="bg-purple disabled color-palette">
            <td width="50"><b>#</b></td>
            <td><b>Grupo</b></td>
            <td><b></b></td>
        </tr>
    </thead>
    <tbody>
        @foreach($grupos as $grupo)
            <tr>
                <td> <a href="#" class="btn btn-xs btn-default btn-collapse"> <i class="fa fa-minus"></i></a></td>
                <td>
                    <p>{{ strtoupper($grupo->Descripcion) }}</p>
                    <div class="collapse in" >
                        <div style="height: 200px; overflow-y: scroll;">
                            <table class="table table-bordered table-hover table-condensed">
                                <thead>
                                    <tr style="font-weight:bold">
                                        <td>Codigo</td>
                                        <td>Nombre</td>
                                        <td width="30"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupo->servicios as $servicio)
                                        <tr>
                                            <td> {{ $servicio->Codigo }}</td>
                                            <td> {{ $servicio->Nombre }}</td>
                                            <td> 
                                                <a href="{{ route('lab.configuracion-resultados.edit', $servicio->IdProducto) }}" class="btn btn-xs btn-default"> <i class="fa fa-edit"></i>  </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>