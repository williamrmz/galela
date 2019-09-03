@extends('layouts.master')

@section('content')

<div class="box">
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed" style="margin-bottom:0">
                <thead>
                    <tr>
                        <th colspan="{{ count($cols)}}"> Table: {{ $file }}</th>
                    </tr>
                    <tr>
                        @foreach ($cols as $col)
                            <th>{{ $col}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as  $row)
                        <tr>
                            @foreach ($cols as $col)
                            <td>{{ $row->$col }}</td> 
                            @endforeach   
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $rows->render() }}
    </div>
</div>
@endsection