@extends('layouts.master')
@section('content')

    {!! Form::open(array('url'=>'ads/', 'method'=>'POST', 'files'=>true)) !!}
    <div class="container-fluid">

        @if(!count($sponsors))
            <h3>Please add some <a href="/sponsors/create">sponsors</a> first.</h3>
        @else
            @include('partials.error-messages.error')
            @include('partials.error-messages.success')


            <div class="row">
              <div class="">
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
                    {!! Form::select('sponsor_id', $sponsors, null, ['class' => 'form-control',
                    'id' => 'sponsor_select']) !!}
                </div>
                <div class="col-md-6">
                    <div class="row">

                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-6"></div>
                <div class="col-md-6 col-md-offset-5">
                    {!! Form::submit('Create Ad', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        @endif

    </div>
    {!! Form::close() !!}
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script src="{{asset('js/ads-js.js')}}"></script>
@stop
