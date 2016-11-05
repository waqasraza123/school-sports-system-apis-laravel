@extends('layouts.master')
<link href='/css/jquery.guillotine.css' media='all' rel='stylesheet'>
@section('content')
<div class="container" style="width: 100% !important;">



        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

    <div class="row">
        <div class="col-sm-8">
            <h3 style="text-align: center; margin-bottom: 50px;">Update Staff</h3>
            {!! Form::model($staff, ['method' => 'put', 'url' => 'staff/'.$staff->id, 'files' => true]) !!}
            @if($staff->photo)
                <img id="photo-preview" style="margin: 20px auto; display: block" src="{{$staff->photo}}" alt="image" width="200px" height="200px">
            @else
                <img id="photo-preview" style="margin: 20px auto; display: block" src="{{asset('uploads/def.png')}}" height="200px" width="200px" alt="image">
            @endif
        </div>
            <div class="col-sm-8">
                @include('partials.image_crop_preview')
                <div class="row">
            <div class="col-md-6">
                <div class="form-group-sm">
                    <div class="col-s-3">
                        {!!Form::label('photo', 'Image:', ['class' => 'control-label']) !!}
                        {!! Form::file('photo', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group-sm">
                  <div class="col-s-3">
                {!!Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required' =>true]) !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group-sm">
                  <div class="col-s-3">
                {!!Form::label('title', 'Title:', ['class' => 'control-label']) !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
          </div>
        </div>
            <div class="col-md-6">
              <div class="form-group-sm">
                  <div class="col-s-3">
                {!!Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>
        </div>
          </div>
</div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group-sm">
                  <div class="col-s-3">
                {!!Form::label('phone', 'Phone:', ['class' => 'control-label']) !!}
                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
            </div>
                </div>
                    </div>
            <div class="col-md-6">
              <div class="form-group-sm">



            {!! Form::label('title', 'Roster:', ['class' => 'control-label']) !!}
            {!! Form::select('roster_id[]', $rosters,   $rostersTags, ['class' => 'form-control','id' => 'roster_id', 'style' => 'width: 100%', 'multiple']) !!}
              <div class="dropzone-previews"></div>
                </div>
                    </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group-sm">
                  <div class="col-s-3">
                {!!Form::label('description', 'Bio:', ['class' => 'control-label']) !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
          </div>
      </div>

        </div>

        <div class="row">
          <div class="col-md-6 corosterl-md-offset-5" style="margin-top: 30px">
              <div class="form-group-sm">
                  <div class="col-s-3">
                {!! Form::submit('Update Staff', ['class' => 'btn btn-primary']) !!}
            </div>
          </div>
          </div>
        </div>
        </div>
</div>
    </div>
<br><br><br><br>

        {!! Form::close() !!}

@endsection
@section('footer')
  <script type="text/javascript">
      $('#roster_id').select2();
      $('#season_id').select2();
      $('#game_id').select2();
      $('#year_id').select2();

  </script>

  <script src='/js/jquery.guillotine.js'></script>
  <script src='/dist/js/sb-image-crop-2.js'></script>

    @include('partials.error-messages.footer-script')
@stop
