@extends('layouts.app')

@section('content')


{{-- <div class="card">
    <div class="card-header">
        Empleados
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <form action="#" class="row">
                    <div class="col-sm-3 form-group">
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-sm-7 form-group">
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-sm-2 form-group">
                        <a href="#" class="btn btn-success btn-sm">Search</a>
                        <a href="#" class="btn btn-secondary btn-sm">Clear</a>
                    </div>
                </form>
            </div>
    
            <div class="col-sm-12">
                <table class="table table-sm">
                    <thead>
                        <tr style="">
                            <td>#</td>
                            <td>DNI</td>
                            <td>Nombres y apellidos</td>
                            <td width="30"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>72918104</td>
                            <td>Romel Diaz Ramos</td>
                            <td>
                                <input type="hidden" class="row-data" value="row #01">
                                <a href="#" class="btn btn-secondary btn-sm btn-select"> <i class="fa fa-plus"></i>+</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>78541254</td>
                            <td>Maria vasques garcia</td>
                            <td>
                                <input type="hidden" class="row-data" value="row #02">
                                <a href="#" class="btn btn-secondary btn-sm btn-select"> <i class="fa fa-plus"></i>+</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> --}}

    

    <div class="control">my content...</div>

<script src="{{ url('componentes/com-buscar-empleados.js') }}"></script>

<script>
    $(function(){
        var data = [
            { id:1, dni: '72918140', name: 'Jamer Diaz Ramos'},
            { id:2, dni: '78456980', name: 'Mariana Garcia Vazques'},
        ];

        $(".control").comBuscarEmpleado({
            title: 'Buscar Empleados',
            data: data,
            event_search: searchManager,
        });

        $(".control").on('click.')


    });


    function searchManager()
    {

    }

</script>


@endsection



