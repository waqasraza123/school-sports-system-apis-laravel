@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h2 style="text-align: center">Add Sports</h2>

        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::open(['url' => '/sports', 'files' =>true]) !!}

            <div class="row">
                <div class="col-md-6">
                    {!!Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' =>true]) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('photo', 'Icon', ['class' => 'control-label']) !!}
                    {!! Form::file('photo', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!!Form::label('record', 'Record:', ['class' => 'control-label']) !!}
                    {!! Form::text('record', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('highlight_video', 'Highlight Video', ['class' => 'control-label']) !!}
                    {!! Form::text('highlight_video', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('season_id', 'Season:', ['class' => 'control-label']) !!}
                    {!! Form::select('season_id', $seasons, null, ['class' => 'form-control', 'required' => true]) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('year', 'Year:', ['class' => 'control-label']) !!}
                    {!! Form::selectYear('year', 2005, \Carbon\Carbon::now()->year, \Carbon\Carbon::now()->year, ['class' => 'form-control', 'required' => true]) !!}
                </div>
            </div>

            <div class="row">

                <div class="col-md-3">
                    {!! Form::label('level_id', 'Levels:', ['class' => 'control-label']) !!}
                    {!! Form::select('level_id[]', $levels,
                    \Illuminate\Support\Facades\Request::old('targets') ? \Illuminate\Support\Facades\Request::old('targets') : $levels,
                     ['class' => 'form-control', 'required' => true, 'multiple' => true, 'id' => 'level_id']) !!}
                </div>

                <div class="col-md-3">
                    {!! Form::label('', '', ['class' => 'control-label']) !!}
                    {!! Form::text('add_new_sport_level', null, ['class' => 'form-control', 'id' => 'add_new_sport_level']) !!}<br>
                    {!! Form::button('Add Level?', ['class'=> 'btn btn-primary btn-sm', 'id' => 'add_new_sport_level_btn']) !!}
                </div>

                <div class="col-md-6" style="margin-top: 25px">

                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-md-offset-6">
                    {!! Form::submit('Add Sport', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('footer')
    @include('partials.add_new_sport_level_script')
    @include('partials.error-messages.footer-script')
@stop

