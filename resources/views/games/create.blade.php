@extends('layouts.master')
<link rel="stylesheet" href="/timepicker/css/bootstrap-timepicker.min.css">
@section('content')
    <div class="container-fluid">
        <h2 style="text-align: center">Add game</h2>

        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        @if($rosters->isEmpty())
            <div class="alert alert-danger">
                Please add some <a href="/sports/create">sports</a> first.
            </div>
        @else
            {!! Form::open(['url' => '/games', 'files' =>true]) !!}

            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('title', 'Select Image:', ['class' => 'control-label']) !!}
                    {!! Form::file('image') !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('title', 'Roster:', ['class' => 'control-label']) !!}
                    {{ Form::select('roster_id', $rosters, null,
                     ['class' => 'form-control', 'required'=> 'true', 'id' => 'roster_id']) }}
                </div>
                <div class="col-md-6">
                    {!! Form::label('title', 'Location:', ['class' => 'control-label']) !!}
                    {{ Form::select('location_id', $locations, null, ['class' => 'form-control',
                     'id' => 'location_id']) }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('title', 'Opponent:', ['class' => 'control-label']) !!}
                    {!! Form::select('opponent', $opponents, null, ['class' => 'form-control', 'id'=> 'opponent', 'style' => 'width: 100%', 'required'=> 'true']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('title', 'Year:', ['class' => 'control-label']) !!}
                    {!! Form::selectYear('year_id', 2005, \Carbon\Carbon::now()->year, \Carbon\Carbon::now()->year, ['class' => 'form-control', 'required' => 'true']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('title', 'Our score:', ['class' => 'control-label']) !!}
                    {!! Form::text('our_score', null, ['class' => 'form-control', 'id'=> 'our_score']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('title', 'Opponents score:', ['class' => 'control-label']) !!}
                    {!! Form::text('opponents_score', null, ['class' => 'form-control', 'id'=> 'opponents_score']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('title', 'Game date:', ['class' => 'control-label']) !!}
                            {{--{!! Form::input('game_date', "", ['class' => 'form-control', 'id'=> 'game_date', 'placeholder '=> 'YYYY-MM-DD']) !!}--}}
                            {{ Form::text('game_date', '', array('class'=>'form-control','id' => 'game_date' , 'required'=> 'true')) }}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('time', 'Time: ', ['class' => 'control-label']) !!}
                            {!! Form::text('game_time', null, ['class' => 'form-control', 'id' => 'game_time']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('title', 'Home or away:', ['class' => 'control-label']) !!}
                    {!! Form::select('home_or_away',['home'=>'home','away'=>'away'], null, ['class' => 'form-control', 'id'=> 'home_or_away', 'style' => 'width: 100%', 'required'=> 'true']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('season_id', 'Season: ', ['class' => 'control-label']) !!}
                    {!! Form::select('season_id', $seasons, null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-6">

                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-5" style="margin-top: 20px">
                    {!! Form::submit('Create game', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}
        @endif
    </div>{{--container fluid closed--}}
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script src="/js/moment-with-locales.js"></script>
    <script src="/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
        $('#roster_id').select2();
        $('#location_id').select2();
        $('#year_id').select2();
        $('#opponent').select2({
            placeholder: "Select opponent",
        });
        $('#home_or_away').select2({
            placeholder: "Select home or away",
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $('#game_date').datetimepicker({format: "YYYY-MM-DD"});
            $('#game_time').timepicker('showWidget');
            $("#game_time").disableFocus(true);
        });
    </script>
    <script src="/timepicker/js/bootstrap-timepicker.min.js"></script>
@endsection
