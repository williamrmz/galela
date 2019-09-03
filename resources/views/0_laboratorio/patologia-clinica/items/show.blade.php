@extends('layouts.master')

@section('lab', 'active menu-open')
@section('lab.pat-clinica', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li><a href="{{ route('lab.items.index') }}">Items CPT</a></li>
<li class="active">Referencias</li>
@endsection

@section('content')
    {{ Form::hidden('items-path-ctrl', route('lab.items.index') ) }}
    {{ Form::hidden('refs-path-ctrl', route('lab.refs.index') ) }}
    {{ Form::hidden('id_item', $item->idItem, ['id'=>'id_item'] ) }}

    @include('partials.my-modal')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Valores de Referencia - {{ $item->Item }}</h3>

            <div class="box-tools pull-right">
                <a href="#" class="btn btn-xs btn-primary refs-btn-create"> <i class="fa fa-plus"></i> Nueva</a>
            </div>
        </div>

        <div class="box-body refs-tabla">
            
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ url('/template/pages/lab.items.refs.js') }}"></script>
@endsection