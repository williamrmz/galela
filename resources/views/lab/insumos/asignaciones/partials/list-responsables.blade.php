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
                @foreach ($responsables as $responsable)
                    <tr>
                        <td> {{ $responsable->DNI }}</td>
                        <td> {{ $responsable->Fullname() }}</td>
                        <td>
                            <input type="hidden" nane="IdResponsable" value="{{ $responsable }}">
                            <a href="#" title="seleccionar" class="btn btn-xs btn-default responsable-btn-select"> <i class="fa fa-plus"></i></a>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        <div class="responsables-paginator">
            {{ $responsables->render() }}
        </div>
    </div>
</div>

    