@extends('layouts.master')
@section('content')
    <div class="container-fluid">


        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::open(['url' => '/opponents', 'files' => true]) !!}

        <div class="row">
          <div class="col-sm-8">
            <h3 style="text-align: center; margin-bottom: 50px;">Add Opponent</h3>
          </div>
          <div class="col-sm-8">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group-sm">
                      <div class="col-s-3">
                    {!!Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' =>true]) !!}
                </div>
                  </div>
                    </div>
                <div class="col-md-6">
                  <div class="form-group-sm">
                      <div class="col-s-3">
                    {!!Form::label('photo', 'Logo:', ['class' => 'control-label']) !!}
                    {!! Form::file('photo', null, ['class' => 'form-control', 'required' =>true]) !!}
                </div>
              </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                  <div class="form-group-sm">
                      <div class="col-s-3">
                    {!!Form::label('nick', 'Nick:', ['class' => 'control-label']) !!}
                    {!! Form::text('nick', null, ['class' => 'form-control', 'required' =>true]) !!}
                </div>
              </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group-sm">
                      <div class="col-s-3">
                    {!! Form::label('year', 'Year', ['class' => 'control-label']) !!}
                    {!! Form::selectYear('year', 2005, \Carbon\Carbon::now()->year, \Carbon\Carbon::now()->year, [
                    'class' => 'form-control', 'required' => true]) !!}
                </div>
              </div>
                </div>
            </div>
            <div class="row">
                <div class="" style="margin: 20px auto; display: block; float: none; width: 150px">
                    {!! Form::submit('Add Opponent', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

    </div>
  </div>
    </div>
            {!! Form::close() !!}
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
@stop
