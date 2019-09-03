@extends('layouts.master')

@section('content')

<div class="box">
    <div class="box-body">
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Class Model</th>
                    <th width="100"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $key => $file)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $file }}</td>
                        <td> 
                            <a href="{{ url('/dev/design/'.$file) }}" class="btn btn-xs btn-default" title="Diseño"> <i class="fa fa-table"></i></a>
                            <a href="{{ url('/dev/list/'.$file) }}" class="btn btn-xs btn-default" title="Listar"> <i class="fa fa-list"></i></a>
                            <a href="{{ url('/dev/search/'.$file) }}" class="btn btn-xs btn-default" title="Buscar por ID"> <i class="fa fa-filter"></i></a>
                        </td>
                    </tr>    
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
@endsection