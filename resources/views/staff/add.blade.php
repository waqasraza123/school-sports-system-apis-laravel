@extends('layouts.master')
@section('content')
    <div class="container-fluid">


        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::open(['url' => '/staff', 'files' => true]) !!}

            <div class="row">
              <div class="col-sm-8">
                <h3 style="text-align: center; margin-bottom: 50px;">Add Staff</h3>
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
                    {!!Form::label('photo', 'Image:', ['class' => 'control-label']) !!}
                    {!! Form::file('photo', ['class' => 'form-control']) !!}
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
                {{ Form::select('roster_id[]', $rosters, null, ['class' => 'form-control','id' => 'roster_id', 'style' => 'width: 100%', 'multiple']) }}
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
              <div class="col-md-6 col-md-offset-5" style="margin-top: 30px">
                  <div class="form-group-sm">
                      <div class="col-s-3">
                    {!! Form::submit('Add Staff', ['class' => 'btn btn-primary']) !!}
                </div>
              </div>
              </div>
            </div>
            </div>
</div>
  </div>
        {!! Form::close() !!}

@endsection
@section('footer')
  <script type="text/javascript">
      $('#roster_id').select2();
      $('#season_id').select2();
      $('#game_id').select2();
      $('#year_id').select2();

  </script>
    @include('partials.error-messages.footer-script')
@stop
