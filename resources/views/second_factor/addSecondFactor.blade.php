@extends('base_structure')
@section('additional_headers')
    <link href="{{ URL::asset('css/style_other_views.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="form-group row">
        <div class="col-sm-2 col-form-label">
            <a href="{{ url('/secondFactors') }}" class="btn btn-back cancel-btn"> Späť </a>
        </div>
        <div class="col-sm-10">
            <h1 class="mainTitle" id="staticPerson">Pridaj/zmeň druhý faktor typu heslo pre osobu</h1>
        </div>
    </div>
    <hr>
    <form id="create-sf-form" action="{{ url('/secondFactors') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="staticPersonType" class="col-sm-2 col-form-label">*Osoba</label>
            <div class="col-sm-4">
                <select name="person_id" class="form-control" id="staticPersonType" required>
                    @foreach($people as $t)
                        <option name="person_id" value="{{$t->person_id}}" >{{$t->forname . ' ' . $t->surname}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticPersonType" class="col-sm-2 col-form-label">*Kľúč</label>
            <div class="col-sm-4">
                <input name="key_string" class="form-control" placeholder="Hodnota druhého faktora">
            </div>
        </div>
        <div class="form-group row">
            <div style="margin-left: auto; margin-right: auto; margin-top: 20px; margin-bottom: 20px;width: 20%">
                <button type="submit" class="btn save-btn btn-success" style="width: 40%; margin-right: 5px;">Uložiť</button>
                <a class="btn cancel-btn btn-basic" href="{{ url('/secondFactors') }}" style="width: 40%">Zrušiť</a>
            </div>
        </div>
    </form>

    <script src="{{ URL::asset('js/funcs_other_views.js') }}" type="text/javascript" ></script>
@stop
