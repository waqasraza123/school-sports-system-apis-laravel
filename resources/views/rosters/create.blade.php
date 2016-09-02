@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h2 style="text-align: center">Add Roster</h2>

        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        @if($sports->isEmpty())
            <div class="alert alert-danger">
                Please add some <a href="/sports/create">sports</a> first.
            </div>
        @else
            {!! Form::open(['route' => 'rosters.store', 'files' =>true]) !!}

            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('title', 'Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, ['class' => 'fn form-control', 'required' => 'true']) !!}
                </div>

                <div class="col-md-6">
                    {!! Form::label('year_id', 'Year:', ['class' => 'control-label']) !!}
                    {!! Form::selectYear('year_id', 2005, \Carbon\Carbon::now()->year, \Carbon\Carbon::now()->year, ['class' => 'form-control', 'required' => 'true']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('level_id', 'Level:', ['class' => 'control-label']) !!}
                    {!! Form::select('level_id', $levels, null, ['class' => 'fn form-control']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('title', 'Select Sport:', ['class' => 'control-label']) !!}
                    {{ Form::select('sport_id', $sports, null, ['class' => 'form-control'] )}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('season_id', 'Season:', ['class' => 'control-label']) !!}
                    {!! Form::select('season_id', $seasons, null, ['class' => 'fn form-control']) !!}
                </div>
                <div class="col-md-6">

                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-5" style="margin-top: 20px">
                    {!! Form::submit('Create Roster', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}
        @endif
    </div>{{--container fluid closed--}}
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script>
    function pro() {
        $('.hide-pro').css('display', 'none');
        if($("#pro_free_").val() == 0){
            $('.hide-pro').hide('slow');
        }
        if($("#pro_free_").val() == 1){
            $('.hide-pro').show('slow');
        }
    }
    </script>
@endsection
