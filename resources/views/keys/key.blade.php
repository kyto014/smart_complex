@extends('base_structure')
@section('additional_headers')
    <link href="{{ URL::asset('css/style_other_views.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-select.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/bootstrap-select.js') }}" type="text/javascript" ></script>

@stop

@section('content')
    <script>
        window.Popper = require('popper.js').default;
        $('.selectpicker').selectpicker();

    </script>
    <div class="form-group row">
        <div class="col-sm-2 col-form-label">
            <a href="{{ url('/keys') }}" class="btn btn-back"> Späť </a>
        </div>
    </div>
    <div class="form-group row">
        <label for="staticPerson" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
            <h1 class="capitalize mainTitle" id="staticPerson">editácia kľúča</h1>
        </div>
    </div>
    <hr>
    <form id="person-form" data-href="{{ url('/keys') }}/{{$key->key_id}}" method="post">
        {{ csrf_field() }}
        {{$key}}
        {{--<div class="form-group row">--}}
            {{--<label for="staticKeyType" class="col-sm-2 col-form-label">*typ kľúča</label>--}}
            {{--<div class="col-sm-4">--}}
                {{--<select name="key_type_id" class="form-control" id="staticKeyType">--}}
                    {{--@foreach($key_types as $kt)--}}
                        {{--<option value="{{$kt->key_type_id}}" @if($kt->key_type_id == $key->key_type_id) selected @endif>{{$kt->name}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group row">--}}
            {{--<label for="staticKeyState" class="col-sm-2 col-form-label">*stav kľúča</label>--}}
            {{--<div class="col-sm-4">--}}
                {{--<select name="key_type_id" class="form-control" id="staticKeyState">--}}
                    {{--@foreach($key_states as $ks)--}}
                        {{--<option value="{{$ks->key_state_id}}" @if($ks->key_state_id == $key->key_state_id) selected @endif>{{$ks->name}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group row">--}}
            {{--<label for="staticKeyValue" class="col-sm-2 col-form-label">*hodnota</label>--}}
            {{--<div class="col-sm-4">--}}
                {{--<input type="text" name="keyValue" class="form-control" id="staticKeyValue" value="{{$key->key_string}}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group row">--}}
            {{--<label for="staticPerson" class="col-sm-2 col-form-label">*držiteľ</label>--}}
            {{--<div class="col-sm-4">--}}
                {{--<select name="person_id" class="form-control" id="staticPerson">--}}
                    {{--@foreach($people as $p)--}}
                        {{--<option name="person_id" value="{{$p->person_id}}" @if($key->person_type_id == $p->person_id) selected @endif>{{$p->forname}} {{$p->surname}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<select class="form-control selectpicker" data-size="5" data-live-search="true" >--}}
            {{--<option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>--}}
            {{--<option data-tokens="mustard">Burger, Shake and a Smile</option>--}}
            {{--<option data-tokens="frosting">Sugar, Spice and all things nice</option>--}}
        {{--</select>--}}

        {{--<div class="form-group row">--}}
            {{--<div style="margin-left: auto; margin-right: auto; margin-top: 20px; margin-bottom: 20px;width: 20%">--}}
                {{--<button type="submit" class="btn save-btn" style="width: 40%; margin-right: 5px;">Uložiť</button>--}}
                {{--<a class="btn cancel-btn btn-basic" href="{{ url('/people') }}" style="width: 40%">Zrušiť</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </form>
    <script src="{{ URL::asset('js/additional_table_functions.js') }}" type="text/javascript" ></script>
@stop
