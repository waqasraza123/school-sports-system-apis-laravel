@extends('layouts.master')
<link href='/css/jquery.guillotine.css' media='all' rel='stylesheet'>
@section('content')
    <div class="container-fluid">


        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::open(['url' => '/staff', 'files' => true]) !!}

            <div class="row">
              <div class="col-sm-8">
                <h3 style="text-align: center; margin-bottom: 50px;">Add Staff</h3>
              </div>

                <div class="row">
                    <div class="col-md-6" id="image-preview" style="margin-top: 30px;">
                        {{ Form::hidden('image_scale', null, ['id' => 'image_scale']) }}
                        <div class='frame col-md-12' style="width: 350px; height: 350px">
                            <img id='sample_picture' src='img/arrow.png'>
                        </div>

                        <div id='controls' class="col-md-12" style="margin-top: -80px;">
                            {{--<button id='rotate_left'  type='button' title='Rotate left'> &lt; </button>--}}
                            <button id='zoom_out'     type='button' title='Zoom out'> - </button>
                            <button id='fit'          type='button' title='Fit image'> [ ]  </button>
                            <button id='zoom_in'      type='button' title='Zoom in'> + </button>
                            {{--<button id='rotate_right' type='button' title='Rotate right'> &gt; </button>--}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-sm">
                                <div class="col-s-3">
                                    {!!Form::label('photo', 'Image:', ['class' => 'control-label']) !!}
                                    {!! Form::file('photo', ['class' => 'form-control', 'id' => 'photo']) !!}
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

  <script src='/js/jquery.guillotine.js'></script>

  <script>
      $(document).ready(function() {
          $('#image-preview').hide();
          document.getElementById("photo").onchange = function () {
              var reader = new FileReader();

              reader.onload = function (e) {
                  if (e.total > 250000) {
                      $('#imageerror').text('Image too large');
                      $jimage = $("#photo");
                      $jimage.val("");
                      $jimage.wrap('<form>').closest('form').get(0).reset();
                      $jimage.unwrap();
                      $('#sample_picture').removeAttr('src');
                      return;
                  }
                  $('#imageerror').text('');
                  document.getElementById("sample_picture").src = e.target.result;
              };
              reader.readAsDataURL(this.files[0]);
              $('#image-preview').show();
          };
      });
  </script>

  <script type='text/javascript'>
      jQuery(function() {
          var picture = $('#sample_picture');

          // Make sure the image is completely loaded before calling the plugin
          picture.one('load', function(){
              // Initialize plugin (with custom event)
              picture.guillotine({eventOnChange: 'guillotinechange'});
              picture.guillotine({width: 400, height: 300});
              // Display inital data
              var data = picture.guillotine('getData');
              for(var key in data) { $('#'+key).html(data[key]); }

              // Bind button actions
//              $('#rotate_left').click(function(){ picture.guillotine('rotateLeft'); $('#image_scale').val(JSON.stringify(data)); });
//              $('#rotate_right').click(function(){ picture.guillotine('rotateRight'); $('#image_scale').val(JSON.stringify(data)); });
              $('#fit').click(function(){ picture.guillotine('fit'); $('#image_scale').val(JSON.stringify(data));});
              $('#zoom_in').click(function(){ picture.guillotine('zoomIn'); $('#image_scale').val(JSON.stringify(data)); });
              $('#zoom_out').click(function(){ picture.guillotine('zoomOut'); $('#image_scale').val(JSON.stringify(data)); });

              // Update data on change
              picture.on('guillotinechange', function(ev, data, action) {
                  data.scale = parseFloat(data.scale.toFixed(4));
                  $('#image_scale').val(JSON.stringify(data));
                  for(var k in data) { $('#'+k).html(data[k]); }
              });
          });

          // Make sure the 'load' event is triggered at least once (for cached images)
          if (picture.prop('complete')) picture.trigger('load')
      });
  </script>
    @include('partials.error-messages.footer-script')
@stop
