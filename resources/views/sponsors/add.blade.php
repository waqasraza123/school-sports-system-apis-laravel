@extends('layouts.master')
@section('content')
    {!! Form::open(array('url'=>'ads/', 'method'=>'POST', 'files'=>true)) !!}
    <div class="container" style="width: 100% !important;">

        @include('partials.error-messages.error')
        @include('partials.error-messages.success')


        <div class="row">
          <div class="col-sm-8">
            <h3 style="text-align: center; margin-bottom: 50px;">Add Sponsor</h3>
          </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('image', 'Image: ', ['class' => 'control-label']) !!}
                {!! Form::file('image', ['class' => '']) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('name', 'Name: ', ['class' => 'control-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="col-md-6">
                {!! Form::label('url', 'Ad Url: ', ['class' => 'control-label']) !!}
                {!! Form::text('url', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('sponsor_id', 'Sponsor: ', ['class' => 'control-label']) !!}
                {!! Form::text('sponsor_id', null, ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-6">

            </div>
        </div>

    </div>
    {!! Form::close() !!}
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
@stop
