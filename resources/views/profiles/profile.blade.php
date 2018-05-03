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
        {{--var values = {!! json_encode($profile->accesses) !!};--}}
        {{--ids = [];--}}
        {{--for (var i = 0, len = values.length; i < len; i++) {--}}
            {{--ids.push(values[i]['access_id']);--}}
        {{--}--}}


        //        $('#staticAccesses').val(ids).trigger('change');
//        console.log(ids);
    </script>
    <div class="form-group row">
        <div class="col-sm-2 col-form-label">
            <a href="{{ url('/profiles') }}" class="btn btn-back"> Späť </a>
        </div>
    </div>
    <div class="form-group row">
        <label for="staticPerson" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
            <h1 class="capitalize mainTitle" id="staticPerson">edituj profil</h1>
        </div>
    </div>
    <hr>
    {{--{{$profile}}--}}
    <form id="profile-form" data-href="{{ url('/profiles') }}/{{$profile->profile_id}}" method="post">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="staticName" class="col-sm-2 col-form-label">*názov</label>
            <div class="col-sm-4">
                <input type="text" name="name" class="form-control" id="staticName" value="{{$profile->profile_name}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticDesc" class="col-sm-2 col-form-label">popis</label>
            <div class="col-sm-4">
                <input type="text" name="desc" class="form-control" id="staticDesc" value="{{$profile->description}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticAccesses" class="col-sm-2 col-form-label">prístupy</label>
            <div class="col-sm-4 form-group">
                <select name="accesses[]" class="selectpicker form-control" data-live-search="true" data-size="5" id="staticAccesses" multiple>
                    @foreach($accesses as $a)
                        @if(count($profile->accesses) != 0)
                        @foreach($profile->accesses as $pa)
                        <option value="{{$a->access_id}}" @if($a->access_id == $pa['access_id']) selected @endif>{{$a->access_name}}</option>
                            @endforeach
                        @else
                            <option value="{{$a->access_id}}" >{{$a->access_name}}</option>
                        @endif

                    @endforeach
                </select>
            </div>
        </div>
        {{--@foreach($profile->accesses as $a)--}}
            {{--{{$a}}--}}
        {{--@endforeach--}}
        <div class="form-group row">
            <div style="margin-left: auto; margin-right: auto; margin-top: 20px; margin-bottom: 20px;width: 20%">
                <button type="submit" class="btn save-btn" style="width: 40%; margin-right: 5px;">Uložiť</button>
                <a class="btn cancel-btn btn-basic" href="{{ url('/keys') }}" style="width: 40%">Zrušiť</a>
            </div>
        </div>
    </form>
    <script src="{{ URL::asset('js/additional_table_functions.js') }}" type="text/javascript" ></script>
@stop
