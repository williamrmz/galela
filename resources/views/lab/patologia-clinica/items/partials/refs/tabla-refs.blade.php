<div class="table-responsive">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Sexo</td>
                    <td>Edad</td>
                    <td>Referencia</td>
                    <td>Alertas</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($refs as $ref)
                    <tr>
                        <td>{{ $ref->id_valor }}</td>
                        <td>{{ $ref->sexo() }}</td>
                        <td>{{ $ref->rangoEdades() }}</td>
                        <td>{{ $ref->rangoValores() }}</td>
                        <td>{!! $ref->alertas() !!}</td>
                        <td>
                            <input type="hidden" value="{{ $ref->id_valor }}">
                            <a href="#" class="btn btn-xs btn-default refs-btn-edit"> <i class="fa fa-fw fa-edit"></i></a>
                            <a href="#" class="btn btn-xs btn-default refs-btn-delete"> <i class="fa fa-fw fa-trash"></i></a>
                        </td>
                    </tr>  
                @endforeach
                
            </tbody>
        </table>
    </div>
