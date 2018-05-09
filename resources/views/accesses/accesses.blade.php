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
                columns: [null, null, null, null, null, null]
            } );

        } );
    </script>
    <div >
        <h1 class="mainTitle">prístupy</h1>
        <a class="btn btn-add btn-success" href="{{ url('/access-create') }}">pridaj prístup</a>
    </div>
    <hr style="margin-top: 60px;">
    <div class="table-responsive">
        <table id="page-table" class="display table table-bordered" width="100%">
            <thead class="page-table-thead">
            <tr>
                <th class="page-table-th">NÁZOV</th>
                <th class="page-table-th page-table-th-3">OD</th>
                <th class="page-table-th page-table-th-3">DO</th>
                <th class="page-table-th page-table-th-3">DVERE</th>
                <th class="page-table-th page-table-th-3" style="text-transform: uppercase">nadväzujúci prístup</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($accesses as $a)
                <tr class="page-table-row" data-href="{{ url('/accesses') }}/{{ $a->access_id }}">
                    <td class="page-table-td"><i class="fa fa-search-plus" ></i>{{$a->access_name}}</td>
                    <td class="page-table-td">{{$a->time_from}}</td>
                    <td class="page-table-td">{{$a->time_to}}</td>
                    <td class="page-table-td">{{$a->door->door_name}}</td>
                    @if($a->next_access_id == null)
                        <td class="page-table-td" style="text-align: center">--</td>
                    @else
                        <td class="page-table-td">{{$a->access['access_name']}}</td>
                    @endif
                    <td class="col-delete" >
                        <a data-href="{{ url('/accesses-delete') }}/{{ $a->access_id }}" data-content="{{$a->access_name}}" class="deleteAccess" data-toggle="modal" data-target="#continue-modal" href="" style="width: 100%"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                    <p>Chcete naozaj zmazať prístup <span id="accessName" style="font-weight: 500; text-transform: capitalize"></span>?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>
                    <form id="delete-form" action="" method="get">
                    <button id="btn-continue" data-href="" type="submit" class="btn btn-primary">Pokračovať</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ URL::asset('js/view_all.js') }}" type="text/javascript" ></script>
@stop