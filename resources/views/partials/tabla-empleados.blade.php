<div class="row">
    <div class="col-sm-12 table-responsive">
        <table class="table table-hover table-condensed" style="margin-bottom:0">
            <thead>
                <tr>
                    <td><b>DNI</b></td>
                    <td><b>Empleado</b></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                    <tr>
                        <td> {{ $empleado->DNI }}</td>
                        <td> {{ $empleado->Fullname }}</td>
                        <td>
                            <input type="hidden" value="{{ json_encode($empleado) }}">
                            <a href="#" title="seleccionar" class="btn btn-xs btn-default empleado-btn-seleccionar"> <i class="fa fa-plus"></i></a>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        
        {{ $empleados->render() }}
    </div>
</div>

