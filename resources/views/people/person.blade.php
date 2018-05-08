@extends('base_structure')
@section('additional_headers')
    <link href="{{ URL::asset('css/style_other_views.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    {{--<div class="form-group row">--}}
        {{--<div class="col-sm-2 col-form-label">--}}
            {{--<a href="{{ url('/people') }}" class="btn btn-back"> Späť </a>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="form-group row">
        <div class="col-sm-2 col-form-label">
            <a href="{{ url('/people') }}" class="btn btn-back cancel-btn"> Späť </a>
        </div>
        <div class="col-sm-10">
            <label for="staticSurname" class="col-sm-1 col-form-label" id="labelOsoba">osoba</label><h1 class="capitalize mainTitle" id="staticPerson">{{$person->forname}} {{$person->surname}}</h1>
        </div>
    </div>
    <hr>
    <form id="person-form" action="{{ url('/people') }}/{{ $person->person_id }}" method="post">
        {{ csrf_field() }}
    <div class="form-group row">
        <label for="staticName" class="col-sm-2 col-form-label">*meno</label>
        <div class="col-sm-4">
            <input type="text" name="forname" class="form-control" id="staticName" value="{{$person->forname}}" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="staticSurname" class="col-sm-2 col-form-label">*priezvisko</label>
        <div class="col-sm-4">
            <input type="text" name="surname" class="form-control" id="staticSurname" value="{{$person->surname}}" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">email</label>
        <div class="col-sm-4">
            <input type="email" name="email" class="form-control" id="staticEmail" value="{{$person->email}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="staticPersonType" class="col-sm-2 col-form-label">*typ osoby</label>
        <div class="col-sm-4">
            <select name="person_type_id" class="form-control" id="staticPersonType">
                @foreach($types as $t)
                    <option name="person_type_id" value="{{$t->person_type_id}}" @if($t->person_type_id == $person->person_type->person_type_id) selected @endif>{{$t->name}}</option>
                    @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="staticRole" class="col-sm-2 col-form-label">*rola</label>
        <div class="col-sm-4">
            <select name="role_id" class="form-control" id="staticRole">
                @foreach($roles as $r)
                    <option name="person_type_id" value="{{$r->role_id}}" @if($r->role_id == $person->role->role_id) selected @endif>{{$r->role_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="tableProfiles" class="col-sm-2 col-form-label">profily</label>
        <div class="col-sm-10">
            @if(count($person->profiles) != 0)
            <table class="subTable table table-bordered" id="tableProfiles">
                <thead class="subTable-thead"><tr>
                    <th class="col1">názov</th>
                    <th class="col2">popis</th>
                    <th ></th>
                </tr></thead>
                <tbody id="bodyTableProfiles">
                @foreach($person->profiles as $pp)
                <tr id="trProfile{{$pp->profile_id}}">
                    <input id="iProfile{{$pp->profile_id}}" name="profiles[]" value="{{$pp->profile_id}}" hidden>
                    <td class="td-col1">{{$pp->profile_name}}</td>
                    <td class="td-col2">{{$pp->description}}</td>
                    <td class="col-btns">
                        <a class="btn buttonDoSomething btn-warning btn-sm" href="{{ url('/profiles') }}/{{ $pp->profile_id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <button id="removeRowProfiles" class="btn buttonDoSomething btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <p id="tableProfilesEmpty" class="emptyTable" style="display: @if(sizeof($person->profiles)>0) none @else block @endif">žiadne záznamy</p>
        </div>
    </div>

    {{--<div class="form-group row">--}}
        {{--<label for="tableFactors" class="col-sm-2 col-form-label">druhý stupeň overenia</label>--}}
        {{--<div class="col-sm-10">--}}
            {{--@if(count($person->secondFactors) != 0)--}}
            {{--<table class="subTable table table-bordered" id="tableFactors">--}}
                {{--<thead class="subTable-thead"><tr>--}}
                    {{--<th class="col1">názov</th>--}}
                    {{--<th class="col2">typ</th>--}}
                    {{--<th ></th>--}}
                {{--</tr></thead>--}}
                {{--<tbody id="bodyTableFactors">--}}
                {{--@foreach($person->secondFactors as $psf)--}}
                    {{--<tr id="trFact{{$psf->second_factor_id}}">--}}
                        {{--<input id="iFact{{$psf->second_factor_id}}" name="facts[]" value="{{$psf->second_factor_id}}" hidden>--}}
                        {{--<td class="td-col1">{{$psf->secondFactorType->type_name}}</td>--}}
                        {{--<td class="td-col2">@if($psf->secondFactorType->static == 1) statický @else dynamický @endif</td>--}}
                        {{--<td class="col-btns">--}}
                            {{--<button class="btn buttonDoSomething btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>--}}
                            {{--<button id="removeRowFactors" class="btn buttonDoSomething btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
            {{--@endif--}}
            {{--<p id="tableFactorsEmpty" class="emptyTable" style="display: @if(sizeof($person->secondFactors)>0) none @else block @endif">žiadne záznamy</p>--}}
                {{--<p id="addRowFactors">Pridaj zaznam</p>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="form-group row">
        <label for="staticKeys" class="col-sm-2 col-form-label">kľúče</label>
        <div class="col-sm-10">
            @if(count($person->keys) != 0)
            <table id="tableKeys" class="subTable table table-bordered" >
                <thead class="subTable-thead"><tr>
                    <th class="col1">názov</th>
                    <th class="col2">typ</th>
                    <th ></th>
                </tr></thead>
                <tbody id="bodyTableKeys">
                @foreach($person->keys as $pk)
                    <tr id="trKey{{$pk->key_id}}">
                        <input id="iKey{{$pk->key_id}}" name="keys[]" value="{{$pk->key_id}}" hidden>
                        <td class="td-col1">{{$pk->keyType->name}}</td>
                        <td class="td-col2">{{$pk->keyState->name}}</td>
                        <td class="col-btns">
                            <a class="btn buttonDoSomething btn-warning btn-sm" href="{{ url('/keys') }}/{{ $pk->key_id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <button id="removeRowKeys" class="btn buttonDoSomething btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
            <p id="tableKeysEmpty" class="emptyTable" style="display: @if(sizeof($person->keys)>0) none @else block @endif">žiadne záznamy</p>
            {{--<p id="addRowProfiles">Pridaj zaznam</p>--}}
        </div>
    </div>
    <div class="form-group row">
        <div style="margin-left: auto; margin-right: auto; margin-top: 20px; margin-bottom: 20px;width: 20%">
        <button type="submit" class="btn save-btn btn-success" style="width: 40%; margin-right: 5px;">Uložiť</button>
        <a class="btn cancel-btn btn-basic" href="{{ url('/people') }}" style="width: 40%">Zrušiť</a>
        </div>
    </div>
        </form>
    <script src="{{ URL::asset('js/additional_table_functions.js') }}" type="text/javascript" ></script>
@stop
