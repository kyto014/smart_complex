@extends('base_structure')
@section('additional_headers')
    <link href="{{ URL::asset('css/additional_style_tables.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
    <script>
        $(document).ready(function() {
            $('#page-table').DataTable( {
//                data: dataSet,
                columns: [null, null, null, null]
            } );

        } );
    </script>
    <div >
        <h1 class="mainTitle">kľúče</h1>
        <a class="btn btn-add btn-success" href="{{ url('/key-create') }}">pridaj kľúč</a>
    </div>
    <hr style="margin-top: 60px;">
    <div class="table-responsive">
        <table id="page-table" class="display table table-bordered" width="100%">
            <thead class="page-table-thead">
            <tr>
                <th class="page-table-th">TYP KĽÚČA</th>
                <th class="page-table-th page-table-th-3">STAV KĽÚČA</th>
                <th class="page-table-th page-table-th-3">DRŽITEĽ</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($keys as $k)
                {{--{{$k}}--}}
                <tr class="page-table-row" data-href="{{ url('/keys') }}/{{ $k->key_id }}">
                    <td class="page-table-td"><i class="fa fa-search-plus" ></i>{{$k->keyType->name}}</td>
                    <td class="page-table-td">{{$k->keyState->name}}</td>
                    <td class="page-table-td capitalize">{{$k->person->forname}} {{$k->person->surname}}</td>
                    <td class="col-delete" >
                        <a data-href="{{ url('/keys') }}/{{ $k->key_id }}" data-content="{{$k->keyType->name}} osoby {{$k->person->forname}} {{$k->person->surname}}" class="deleteKey" data-toggle="modal" data-target="#continue-modal" href="" style="width: 100%"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="continue-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{--<h5 class="modal-title" id="exampleModalLabel">Chcete naozaj zmazať tento záznam?</h5>--}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Chcete naozaj zmazať kľúč <span id="keyName" style="font-weight: 500;"></span>?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>
                    <button id="btn-continue" data-href="" type="button" class="btn btn-primary">Pokračovať</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ URL::asset('js/view_all.js') }}" type="text/javascript" ></script>
@stop