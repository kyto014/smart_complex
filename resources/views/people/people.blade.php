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

            $('.page-table-td').on("click",function(){
                window.location = $(this).closest('tr').data('href');
                return false;
            });

            $('.deletePerson').on("click",function(){
                $("#personName").text($(this).data('content'));
                $("#btn-continue").attr('data-href', $(this).data('href'));
                $("#continue-modal").modal("toggle");
                return false;
            });
        } );
    </script>
    <div >
    <h1 class="mainTitle">ľudia</h1>
    <a class="btn btn-add" href="{{ url('/people-create') }}">pridať osobu</a>
        </div>
    <hr style="margin-top: 60px;">
    <div class="table-responsive">
        <table id="page-table" class="display" width="100%">
            <thead class="page-table-thead">
                <tr>
                    {{--<th>ID</th>--}}
                    <th class="page-table-th">MENO</th>
                    <th class="page-table-th page-table-th-2">PRIEZVISKO</th>
                    <th class="page-table-th page-table-th-2">EMAIL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($people as $p)
                <tr class="page-table-row" data-href="{{ url('/people') }}/{{ $p->person_id }}">
                    {{--<td>{{$p->person_id}}</td>--}}
                    <td class="page-table-td capitalize"><i class="fa fa-search-plus" ></i>{{$p->forname}}</td>
                    <td class="page-table-td capitalize page-table-2">{{$p->surname}}</td>
                    <td class="page-table-td page-table-2" >{{$p->email}}</td>
                    <td class="col-delete" >
                        <a data-href="{{ url('/people') }}/{{ $p->person_id }}" data-content="{{$p->forname}} {{$p->surname}}" class="deletePerson" data-toggle="modal" data-target="#continue-modal" href="" style="width: 100%"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                    <p>Chcete naozaj zmazať záznam osoby <span id="personName" style="font-weight: 500; text-transform: capitalize"></span>?</p>

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
