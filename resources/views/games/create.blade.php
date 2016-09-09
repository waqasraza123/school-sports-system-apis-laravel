@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h2 style="text-align: center">Add game</h2>

        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        @if($sports->isEmpty())
            <div class="alert alert-danger">
                Please add some <a href="/sports/create">sports</a> first.
            </div>
        @else
            {!! Form::open(['route' => 'schedules.store', 'files' =>true]) !!}

            <div class="row">
                {!! Form::label('title', 'Select Image:', ['class' => 'control-label']) !!}
                {!! Form::file('image') !!}
            </div>
            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('title', 'Sport:', ['class' => 'control-label']) !!}
                    {{ Form::select('sport_id', $sports, null, ['class' => 'form-control', 'id' => 'sport_id', 'style' => 'width: 100%', 'required'=> 'true']) }}
                    {!! Form::label('title', 'Level:', ['class' => 'control-label']) !!}
                    {{ Form::select('level_id', $levels, null, ['class' => 'form-control', 'id' => 'level_id', 'style' => 'width: 100%', 'required'=> 'true']) }}
                    {!! Form::label('title', 'Location:', ['class' => 'control-label']) !!}
                    {{ Form::select('location_id', $locations, null, ['class' => 'form-control', 'id' => 'location_id', 'style' => 'width: 100%']) }}
                    {!! Form::label('title', 'Opponent:', ['class' => 'control-label']) !!}
                    {!! Form::select('opponent',$opponents, null, ['class' => 'form-control', 'id'=> 'opponent', 'style' => 'width: 100%', 'required'=> 'true']) !!}
                </div>

                <div class="col-md-6">
                    {!! Form::label('title', 'Year:', ['class' => 'control-label']) !!}
                    {{ Form::select('year_id', $years, null, ['class' => 'form-control', 'id' => 'year_id', 'style' => 'width: 100%']) }}
                    {!! Form::label('title', 'Game date:', ['class' => 'control-label']) !!}
                    {{--{!! Form::input('game_date', "", ['class' => 'form-control', 'id'=> 'game_date', 'placeholder '=> 'YYYY-MM-DD']) !!}--}}
                    {{ Form::text('game_date', '', array('class'=>'form-control','id' => 'game_date' , 'required'=> 'true')) }}
                    {!! Form::label('title', 'Home or away:', ['class' => 'control-label']) !!}
                    {!! Form::select('home_or_away',['home'=>'home','away'=>'away'], null, ['class' => 'form-control', 'id'=> 'home_or_away', 'style' => 'width: 100%', 'required'=> 'true']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('title', 'Game preview:', ['class' => 'control-label', 'required'=> 'true']) !!}
                    {!! Form::textarea('game_preview', null, ['class' => 'form-control', 'id'=> 'game_preview']) !!}
                </div>
                {{--<div class="col-md-6">--}}
                    {{--{!! Form::label('title', 'Game recap:', ['class' => 'control-label']) !!}--}}
                    {{--{!! Form::textarea('game_recap', null, ['class' => 'form-control', 'id'=> 'game_recap']) !!}--}}
                {{--</div>--}}
            </div>

            {{--<div class="row">--}}
                {{--<div class="col-md-6">--}}
                    {{--{!! Form::label('title', 'Our score:', ['class' => 'control-label']) !!}--}}
                    {{--{!! Form::text('our_score', null, ['class' => 'form-control', 'id'=> 'our_score']) !!}--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                    {{--{!! Form::label('title', 'Opponents score:', ['class' => 'control-label']) !!}--}}
                    {{--{!! Form::text('opponents_score', null, ['class' => 'form-control', 'id'=> 'opponents_score']) !!}--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="row">--}}
                {{--<div class="col-md-6">--}}
                    {{--{!! Form::label('title', 'Video:', ['class' => 'control-label']) !!}--}}
                    {{--{!! Form::text('video', null, ['class' => 'form-control', 'id'=> 'video']) !!}--}}
                {{--</div>--}}
            {{--</div>--}}

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
        $('#sport_id').select2();
        $('#level_id').select2();
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
            $('#game_date').datetimepicker({format: "YYYY-MM-DD HH:mm:ss"});
        });
    </script>
@endsection
