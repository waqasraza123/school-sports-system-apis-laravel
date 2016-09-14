@extends('layouts.master')
@section('content')
<div class="container" style="width: 100% !important;">


        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::model($sports, ['method' => 'PUT', 'url' => '/sports/'.$sports->id, 'files' =>true]) !!}

        <div class="row">
          <div class="col-sm-8">
            <h3 style="text-align: center; margin-bottom: 50px;">Update Sport</h3>
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
                {!! Form::label('photo', 'Icon', ['class' => 'control-label']) !!}
                {!! Form::file('photo', ['class' => 'form-control']) !!}
            </div>
          </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group-sm">
                  <div class="col-s-3">
                {!!Form::label('record', 'Record:', ['class' => 'control-label']) !!}
                {!! Form::text('record', null, ['class' => 'form-control']) !!}
            </div>
          </div>
          </div>
            <div class="col-md-6">
              <div class="form-group-sm">
                  <div class="col-s-3">
                {!! Form::label('highlight_video', 'Highlight Video', ['class' => 'control-label']) !!}
                {!! Form::text('highlight_video', null, ['class' => 'form-control']) !!}
            </div>
          </div>
          </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group-sm">
                  <div class="col-s-3">
                {!! Form::label('season_id', 'Season:', ['class' => 'control-label']) !!}
                {!! Form::select('season_id', $seasons, null, ['class' => 'form-control', 'required' => true]) !!}
            </div>
          </div>
          </div>
            <div class="col-md-6">
              <div class="form-group-sm">
                  <div class="col-s-3">
                {!! Form::label('year', 'Year:', ['class' => 'control-label']) !!}
                {!! Form::selectYear('year', 2005, \Carbon\Carbon::now()->year, \Carbon\Carbon::now()->year, ['class' => 'form-control', 'required' => true]) !!}
            </div>
          </div>
          </div>
        </div>

        <div class="row">

          <div class="form-group-sm">
                          <div class="col-md-3">
                {!! Form::label('level_id', 'Levels:', ['class' => 'control-label']) !!}
                {!! Form::select('level_id[]', $levels,
                \Illuminate\Support\Facades\Request::old('targets') ? \Illuminate\Support\Facades\Request::old('targets') : $levels,
                 ['class' => 'form-control', 'required' => true, 'multiple' => true, 'id' => 'level_id']) !!}
            </div>
          </div>


          <div class="form-group-sm">
                          <div class="col-md-3">
                {!! Form::label('', '', ['class' => 'control-label']) !!}
                {!! Form::text('add_new_sport_level', null, ['class' => 'form-control', 'id' => 'add_new_sport_level']) !!}<br>
                {!! Form::button('Add Level?', ['class'=> 'btn btn-primary btn-sm', 'id' => 'add_new_sport_level_btn']) !!}
              </div>
            </div>
  

            <div class="col-md-6" style="margin-top: 25px">

            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-md-offset-6">
                {!! Form::submit('Update Sport', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
@section('footer')
    @include('partials.add_new_sport_level_script')
    @include('partials.error-messages.footer-script')
@stop
