@extends('layouts.master')

<link rel="stylesheet" type="text/css" href="/css/iconselect.css" >
<script type="text/javascript" src="/js/iconselect.js"></script>

<script type="text/javascript" src="/js/iscroll.js"></script>
<style>
    #my-icon-select-box-scroll {

        opacity: 1 !important;
        z-index: 999 !important;
    }
</style>

@section('content')
    <div class="container-fluid">


        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::open(['url' => '/sports', 'files' =>true]) !!}

            <div class="row">
              <div class="col-sm-8">
                <h3 style="text-align: center; margin-bottom: 50px;">Add Sport</h3>
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
                    {!! Form::label('sport-icon', 'Icon', ['class' => 'control-label']) !!}
                          <div id="my-icon-select"></div>
                          {{ Form::hidden('selected-text', null, ['id' => 'selected-text']) }}
                </div>
              </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                  <div class="form-group-sm">
                      <div class="col-s-3">
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
                    {!! Form::submit('Add Sport', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
          </div>
        </div>
    </div>
        {!! Form::close() !!}
@endsection
@section('footer')
    @include('partials.add_new_sport_level_script')
    @include('partials.error-messages.footer-script')

    <script>

        var iconSelect;
        var selectedText;

        window.onload = function(){

            selectedText = document.getElementById('selected-text');

            document.getElementById('my-icon-select').addEventListener('changed', function(e){
                selectedText.value = iconSelect.getSelectedValue();

            });

            iconSelect = new IconSelect("my-icon-select");

            var icons = [];
            @foreach ($sportIcons as $sportIcon)

            icons.push({'iconFilePath':'/img/sport_icons/'+'{{$sportIcon->path}}', 'iconValue':'{{$sportIcon->name}}'});
            @endforeach

            iconSelect.refresh(icons);

            document.getElementById('sport-icon').value = selectedText.value;
        };

    </script>
@stop
