@extends('base_structure')
@section('additional_headers')
    <link href="{{ URL::asset('css/style_other_views.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
    {{--    <link href="{{ URL::asset('css/bootstrap-select.min.css') }}" rel="stylesheet">--}}
    {{--    <script src="{{ URL::asset('js/bootstrap-select.min.js') }}" type="text/javascript" ></script>--}}
    <link href="{{ URL::asset('css/bootstrap-select.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/bootstrap-select.js') }}"></script>

@stop

@section('content')
    <script>
        $('.selectpicker').selectpicker();

    </script>

    <div class="form-group row">
        <div class="col-sm-2 col-form-label">
            <a href="{{ url('/accesses') }}" class="btn btn-back cancel-btn"> Späť </a>
        </div>
        <div class="col-sm-10">
            <h1 class="capitalize mainTitle" id="staticPerson">pridaj prístup</h1>
        </div>
    </div>
    <hr>
    <form id="access-form" action="{{ url('/access') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="accessName" class="col-sm-2 col-form-label" >*názov</label>
            <div class="col-sm-4">
                <input type="text" name="access_name" class="form-control" id="accessName" value="" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="accessFrom" class="col-sm-2 col-form-label">*od </label>
            <div class="col-sm-4" >
                <input type="datetime-local" name="access_time_from" class="form-control" id="accessFrom" value="" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="accessTo" class="col-sm-2 col-form-label">*do </label>
            <div class="col-sm-4" >
                <input type="datetime-local" name="access_time_to" class="form-control" id="accessTo" value="" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticDoor" class="col-sm-2 col-form-label">*dvere</label>
            <div class="col-sm-4 form-group">
                <select name="door_id" class="selectpicker form-control" data-live-search="true" data-size="5" id="staticDoor" required>
                    @foreach($doors as $d)
                        <option value="{{$d->door_id}}" >{{$d->door_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticNextAccess" class="col-sm-2 col-form-label">*nadväzujúci prístup</label>
            <div class="col-sm-4 form-group">
                <select name="next_access_id" class="selectpicker form-control" data-live-search="true" data-size="5" id="staticNextAccess">
                    <option value="" style="text-align: center">--</option>
                    @foreach($accesses as $a)
                        <option value="{{$a->access_id}}" >{{$a->access_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div style="margin-left: auto; margin-right: auto; margin-top: 20px; margin-bottom: 20px;width: 20%">
                <button type="submit" class="btn save-btn btn-success" style="width: 40%; margin-right: 5px;">Uložiť</button>
                <a class="btn cancel-btn btn-basic" href="{{ url('/accessess') }}" style="width: 40%">Zrušiť</a>
            </div>
        </div>
    </form>
    <script src="{{ URL::asset('js/additional_table_functions.js') }}" type="text/javascript" ></script>
@stop
