@extends('layouts.master')
<link rel="stylesheet" href="/css/dropzone.css">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Add Gallery</h1>
            @include('partials.error-messages.error')
            @include('partials.error-messages.success')

            {!! Form::open(['route' => 'albums.store']) !!}
        <!-- this is were the previews should be shown. -->
            {!! Form::label('title', 'Album name:', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'fn form-control']) !!}
        <!-- Now setup your input fields -->
            {!! Form::label('title', 'Player:', ['class' => 'control-label']) !!}
            {{ Form::select('roster_id[]', $rosters, null, ['class' => 'form-control','id' => 'roster_id', 'style' => 'width: 100%', 'multiple']) }}
            {!! Form::label('title', 'Game:', ['class' => 'control-label']) !!}
            {{ Form::select('game_id[]', $games, null, ['class' => 'form-control','id' => 'game_id', 'style' => 'width: 100%', 'multiple']) }}
            {!! Form::label('title', 'Year:', ['class' => 'control-label']) !!}
            {{ Form::select('year_id[]', $years, null, ['class' => 'form-control','id' => 'year_id', 'style' => 'width: 100%', 'multiple']) }}

            <div class="dropzone-previews"></div>
            <button type="submit" class="btn btn-info" id="submitbtn" style="margin-left: 75%; margin-top: 65px; margin-bottom: -70px;">Create album</button>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('footer')
    <script src="/dist/js/sb-gallery-2.js"></script>
    <script type="text/javascript">
        $('#roster_id').select2();
        $('#game_id').select2();
        $('#year_id').select2();

    </script>
    @include('partials.error-messages.footer-script')
@stop
