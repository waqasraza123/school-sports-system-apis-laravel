@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h2 style="text-align: center">Add Staff</h2>

        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::open(['url' => '/staff', 'files' => true]) !!}

            <div class="row">
                <div class="col-md-6">
                    {!!Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' =>true]) !!}
                </div>
                <div class="col-md-6">
                    {!!Form::label('photo', 'Image:', ['class' => 'control-label']) !!}
                    {!! Form::file('photo', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!!Form::label('title', 'Title:', ['class' => 'control-label']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-6">
                    {!!Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!!Form::label('phone', 'Phone:', ['class' => 'control-label']) !!}
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-6">
                    {!!Form::label('website', 'Website:', ['class' => 'control-label']) !!}
                    {!! Form::text('website', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!!Form::label('description', 'Description:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('year', 'Year', ['class' => 'control-label']) !!}
                    {!! Form::selectYear('year', 1980, \Carbon\Carbon::now()->year, \Carbon\Carbon::now()->year, [
                    'class' => 'form-control', 'required' => true]) !!}
                </div>
            </div>

            <div class="row">
                <div class="" style="margin: 20px auto; display: block; float: none; width: 150px">
                    {!! Form::submit('Add Staff', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

        {!! Form::close() !!}
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
@stop

