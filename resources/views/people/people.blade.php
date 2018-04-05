@extends('base_structure')
@section('additional_headers')
    {{--nnieco--}}
@stop

@section('content')
    <script>
        $(document).ready(function() {
            $('#page-table').DataTable( {
//                data: dataSet,
                columns: [null, null, null, null]
            } );

            $('.page-table-row').on("click",function(){
                alert($(this).data('href'));
                window.location = $(this).data('href');
                return false;
            });
        } );
    </script>

    {{--@foreach($people as $p)--}}
        {{--{{$p}}--}}
    {{--@endforeach--}}

    <table id="page-table" class="display" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>MENO</th>
                <th>PRIEZVISKO</th>
                <th>EMAIL</th>
            </tr>
        </thead>
        <tbody>
        @foreach($people as $p)
            <tr class="page-table-row" data-href="{{ url('/people') }}/{{ $p->person_id }}">
                <td>{{$p->person_id}}</td>
                <td>{{$p->forname}}</td>
                <td>{{$p->surname}}</td>
                <td>{{$p->email}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
