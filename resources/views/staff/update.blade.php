@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h2 style="text-align: center">Update Staff</h2>

        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::model($staff, ['method' => 'put', 'url' => 'staff/'.$staff->id, 'files' => true]) !!}
        @if($staff->photo)
            <img style="margin: 20px auto; display: block" src="{{asset('uploads/staff/'.$staff->photo)}}" alt="image" width="200px" height="200px">
        @else
            <img style="margin: 20px auto; display: block" src="{{asset('uploads/def.png')}}" height="200px" width="200px" alt="image">
        @endif
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
                {!! Form::submit('Update Staff', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
@stop

