@extends('layouts.master')
<link rel="stylesheet" href="/css/dropzone.css">
@section('content')
    <h1>@if (isset($type->name)){{ $type->name }} @endif Gallery</h1>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}

        </div>
        <br>
    @endif
    {{--{!! Form::open(array('url'=>'image/upload', 'method'=>'POST', 'file' => true, 'id' => '', 'class' => 'form-horizontal', 'role' => 'form')) !!}--}}
    {{--<div class="dropzone dropzone-previews" id="my-awesome-dropzone"></div>--}}
    {{--<div class="form-group"></div>--}}

    {{--<div class="form-group">--}}
    {{--<div class="col-sm-10 col-sm-offset-2">--}}
    {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--{!! Form::close() !!}--}}

    {!! Form::open(['route' => 'albums.store']) !!}
        <!-- this is were the previews should be shown. -->
        {!! Form::label('title', 'Album name:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'fn form-control', 'required' => 'true']) !!}
        <!-- Now setup your input fields -->
        {!! Form::label('title', 'Sport:', ['class' => 'control-label']) !!}
        @if (isset($type->name))
            {{ Form::select('sport_id[]', $sports, $type->id, ['class' => 'form-control', 'id' => 'sport_id', 'style' => 'width: 100%', 'multiple', 'required'=> 'true']) }}
        @else
            {{ Form::select('sport_id[]', $sports, null, ['class' => 'form-control', 'id' => 'sport_id', 'style' => 'width: 100%', 'multiple', 'required'=> 'true']) }}
        @endif
        {!! Form::label('title[]', 'Level:', ['class' => 'control-label']) !!}
        {{ Form::select('level_id[]', $levelcreate, null, ['class' => 'form-control', 'id' => 'level_id', 'style' => 'width: 100%', 'multiple']) }}

        {{--{!! Form::label('title', 'Player:', ['class' => 'control-label']) !!}--}}
        {{--{{ Form::select('roster_id[]', $rosters, null, ['class' => 'form-control','id' => 'roster_id', 'style' => 'width: 100%', 'multiple']) }}--}}
        {!! Form::label('title', 'Game:', ['class' => 'control-label']) !!}
        {{ Form::select('game_id[]', $games, null, ['class' => 'form-control','id' => 'game_id', 'style' => 'width: 100%', 'multiple']) }}
        {!! Form::label('title', 'Schools:', ['class' => 'control-label']) !!}
        {{ Form::select('school_id[]', $schools, null, ['class' => 'form-control','id' => 'school_id', 'style' => 'width: 100%', 'multiple']) }}
        {!! Form::label('title', 'Year:', ['class' => 'control-label']) !!}
        {{ Form::select('year_id[]', $years, null, ['class' => 'form-control','id' => 'year_id', 'style' => 'width: 100%', 'multiple']) }}
        <div class="dropzone-previews"></div>
        <button type="submit" class="btn btn-info" id="submitbtn" style="margin-left: 75%; margin-top: 65px; margin-bottom: -70px;">Create album</button>
        {!! Form::close() !!}


@stop

@section('footer')
    <script src="/dist/js/sb-gallery-2.js"></script>
    <script type="text/javascript">
        $('#sport_id').select2();
        $('#game_id').select2();
        $('#level_id').select2();
        $('#school_id').select2();
        $('#year_id').select2();

    </script>
    @if (session()->has('success'))
        <script>
            //display success message in the top when successfully updated roster
            $('div.alert').delay(4000).slideUp(300);
        </script>
    @endif
@stop
