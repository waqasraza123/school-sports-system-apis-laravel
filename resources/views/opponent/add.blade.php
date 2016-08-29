@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h2 style="text-align: center">Add Opponent</h2>

        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::open(['url' => '/opponents', 'files' => true]) !!}

            <div class="row">
                <div class="col-md-6">
                    {!!Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' =>true]) !!}
                </div>
                <div class="col-md-6">
                    {!!Form::label('photo', 'Logo:', ['class' => 'control-label']) !!}
                    {!! Form::file('photo', null, ['class' => 'form-control', 'required' =>true]) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!!Form::label('nick', 'Nick:', ['class' => 'control-label']) !!}
                    {!! Form::text('nick', null, ['class' => 'form-control', 'required' =>true]) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('year', 'Year', ['class' => 'control-label']) !!}
                    {!! Form::selectYear('year', 2005, \Carbon\Carbon::now()->year, \Carbon\Carbon::now()->year, [
                    'class' => 'form-control', 'required' => true]) !!}
                </div>
            </div>
            <div class="row">
                <div class="" style="margin: 20px auto; display: block; float: none; width: 150px">
                    {!! Form::submit('Add Opponent', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
@stop

