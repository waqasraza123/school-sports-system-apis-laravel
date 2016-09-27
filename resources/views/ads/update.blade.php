@extends('layouts.master')
@section('content')
    {!! Form::model($ad, array('url'=>'ads/'.$ad->id, 'method'=>'PUT', 'files'=>true)) !!}
    <div class="container-fluid">

        @include('partials.error-messages.error')
        @include('partials.error-messages.success')


        <div class="row" style="margin: 0 auto; width: 200px;" >
            <p style="text-align: center">
                <h3 style="text-align: center; margin-bottom: 50px;">Update Ad</h3>
                <img src="{{$ad->image}}" width="200px" height="200">
            </p>
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
                {!! Form::select('sponsor_id', $sponsors, null, ['class' => 'form-control',
                'id' => 'sponsor_select']) !!}
            </div>
            <div class="col-md-6">

            </div>
        </div>

        <div class="row" style="margin-top: 20px;">
            <div class="col-md-6"></div>
            <div class="col-md-6 col-md-offset-5">
                {!! Form::submit('Update Ad', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

    </div>
    {!! Form::close() !!}
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script src="{{asset('js/ads-js.js')}}"></script>
@stop
