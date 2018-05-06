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
            <a href="{{ url('/keys') }}" class="btn btn-back cancel-btn"> Späť </a>
        </div>
        <div class="col-sm-10">
            <h1 class="capitalize mainTitle" id="staticPerson">pridaj kľúč</h1>
        </div>
    </div>
    <hr>
    <form id="key-form" data-href="{{ url('/keys') }}" method="post">
        {{ csrf_field() }}

        <div class="form-group row">
            <label for="staticKeyType" class="col-sm-2 col-form-label">*typ kľúča</label>
            <div class="col-sm-4">
                <select name="key_type_id" class="form-control" id="staticKeyType">
                    @foreach($key_types as $kt)
                        <option value="{{$kt->key_type_id}}" >{{$kt->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticKeyState" class="col-sm-2 col-form-label">*stav kľúča</label>
            <div class="col-sm-4">
                <select name="key_state_id" class="form-control" id="staticKeyState">
                    @foreach($key_states as $ks)
                        <option value="{{$ks->key_state_id}}" >{{$ks->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticKeyValue" class="col-sm-2 col-form-label">*hodnota</label>
            <div class="col-sm-4">
                <input type="text" name="key_value" class="form-control" id="staticKeyValue" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticPerson" class="col-sm-2 col-form-label">*držiteľ</label>
            <div class="col-sm-4 form-group">
                <select name="person_id" class="selectpicker form-control" data-live-search="true" data-size="5">
                    @foreach($people as $p)
                        {{--{{$p}}--}}
                        <option value="{{$p->person_id}}" >{{$p->forname}} {{$p->surname}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div style="margin-left: auto; margin-right: auto; margin-top: 20px; margin-bottom: 20px;width: 20%">
                <button type="submit" class="btn save-btn btn-success" style="width: 40%; margin-right: 5px;">Uložiť</button>
                <a class="btn cancel-btn btn-basic" href="{{ url('/keys') }}" style="width: 40%">Zrušiť</a>
            </div>
        </div>
    </form>
    <script src="{{ URL::asset('js/additional_table_functions.js') }}" type="text/javascript" ></script>
@stop
