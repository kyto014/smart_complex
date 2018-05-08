@extends('base_structure')
@section('additional_headers')
    <link href="{{ URL::asset('css/style_other_views.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="form-group row">
        <div class="col-sm-2 col-form-label">
            <a href="{{ url('/people') }}" class="btn btn-back cancel-btn"> Späť </a>
        </div>
        <div class="col-sm-10">
            <h1 class="mainTitle" id="staticPerson">pridaj osobu</h1>
        </div>
    </div>
    <hr>
    <form id="create-person-form" action="{{ url('/people') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="staticName" class="col-sm-2 col-form-label">*meno</label>
            <div class="col-sm-4">
                <input type="text" name="forname" class="form-control" id="staticName" placeholder="meno" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticSurname" class="col-sm-2 col-form-label">*priezvisko</label>
            <div class="col-sm-4">
                <input type="text" name="surname" class="form-control" id="staticSurname" placeholder="priezvisko" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">email</label>
            <div class="col-sm-4">
                <input type="email" name="email" class="form-control" id="staticEmail" placeholder="email">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticPersonType" class="col-sm-2 col-form-label">*typ osoby</label>
            <div class="col-sm-4">
                <select name="person_type_id" class="form-control" id="staticPersonType" required>
                    @foreach($types as $t)
                        <option name="person_type_id" value="{{$t->person_type_id}}" >{{$t->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticRole" class="col-sm-2 col-form-label">*rola</label>
            <div class="col-sm-4">
                <select name="role_id" class="form-control" id="staticRole">
                    @foreach($roles as $r)
                        <option name="person_type_id" value="{{$r->role_id}}" >{{$r->role_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="selectProfile" class="col-sm-2 col-form-label">profily</label>
            <div class="col-sm-4">
                <select name="profiles[]" class="form-control" id="selectProfile" >
                    <option value="" >--</option>
                    @foreach($profiles as $p)
                        <option value="{{$p->profile_id}}" >{{$p->profile_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticKeys" class="col-sm-2 col-form-label">kľúče</label>
            <div class="col-sm-4">
                <select name="key" class="form-control" id="selectKeys" >
                    <option value="" >--</option>
                    @foreach($keys as $k)
                        <option value="{{$k->key_type_id}}" >{{$k->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <input name="key_string" class="form-control" placeholder="Hodnota klúča">
            </div>
        </div>
        <div class="form-group row">
            <div style="margin-left: auto; margin-right: auto; margin-top: 20px; margin-bottom: 20px;width: 20%">
                <button type="submit" class="btn save-btn btn-success" style="width: 40%; margin-right: 5px;">Uložiť</button>
                <a class="btn cancel-btn btn-basic" href="{{ url('/people') }}" style="width: 40%">Zrušiť</a>
            </div>
        </div>
    </form>

@stop
