@extends('layouts.master')

@section('content')

<div class="box">
    <div class="box-body">
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th colspan="2"> Table: {{ $file }}</th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Field</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($colums as $key => $colum)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $colum }}</td>
                    </tr>    
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection