@extends('layouts.master')
<link href='/css/jquery.guillotine.css' media='all' rel='stylesheet'>
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}

        </div>
        <br>
    @endif
    @if ($errors->has())
        <div class="alert alert-danger">
            All fields are required!
        </div>
    @endif

    {!! Form::open(array('url'=>'/settings/', 'method'=>'POST', 'files'=>true)) !!}
    <div class="container" style="width: 100% !important;">
        <h3>Settings</h3>
        <div class="row">
            <div class="col-sm-8">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#info">School Info</a></li>
                    <li><a data-toggle="tab" href="#media">School Media</a></li>
                    <li><a data-toggle="tab" href="#app">App Info</a></li>
                    <li><a data-toggle="tab" href="#mascot">Mascot/Colors</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="info">
                        <div class="container-fluid" style="width: 100% !important;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {{ Form::hidden('school_invisible_id', $school->id, ['id' => 'school_invisible_id']) }}

                                            {!! Form::label('title', 'Name:', ['class' => 'control-label']) !!}
                                            {!! Form::text('name', $school->name, ['class' => 'form-control', 'id'=> 'name']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'School Nick:', ['class' => 'control-label']) !!}
                                            {!! Form::text('short_name', $school->short_name, ['class' => 'form-control', 'id'=> 'short_name']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="school_tagline">Tagline:</label>
                                            <input type="text" value="{{$school->school_tagline}}" name="school_tagline" class="form-control" id="school-tagline">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Website:', ['class' => 'control-label']) !!}
                                            {!! Form::text('website', $school->website, ['class' => 'form-control', 'id'=> 'website']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Address :', ['class' => 'control-label']) !!}
                                            {!! Form::text('adress', $school->adress, ['class' => 'form-control', 'id'=> 'adress']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'City:', ['class' => 'control-label']) !!}
                                            {!! Form::text('city', $school->city, ['class' => 'form-control', 'id'=> 'city']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'State:', ['class' => 'control-label']) !!}
                                            {!! Form::text('state', $school->state, ['class' => 'form-control', 'id'=> 'state']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Zip:', ['class' => 'control-label']) !!}
                                            {!! Form::text('zip', $school->zip, ['class' => 'form-control', 'id'=> 'zip']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Phone:', ['class' => 'control-label']) !!}
                                            {!! Form::text('phone', $school->phone, ['class' => 'form-control', 'id'=> 'phone']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="school_email">Email:</label>
                                            <input type="email" value="{{$school->school_email}}" name="school_email" class="form-control" id="school-email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Bio:', ['class' => 'control-label']) !!}
                                            {!! Form::textarea('bio', $school->bio, ['class' => 'form-control', 'id'=> 'bio']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--school media tab--}}
                    <div class="tab-pane fade" id="media">
                        <div class="container" style="width: 100% !important;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="video">Video</label>
                                            <input type="text" value="{{$school->video}}" name="video" class="form-control" id="school-video">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Vimeo:', ['class' => 'control-label']) !!}
                                            {!! Form::text('vimeo',$social ? $social->vimeo : "", ['class' => 'form-control', 'id'=> 'vimeo']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Twitter:', ['class' => 'control-label']) !!}
                                            {!! Form::text('twitter',$social ? $social->twitter: "", ['class' => 'form-control', 'id'=> 'twitter']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Facebook:', ['class' => 'control-label']) !!}
                                            {!! Form::text('facebook',$social ? $social->facebook: "", ['class' => 'form-control', 'id'=> 'facebook']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Instagram:', ['class' => 'control-label']) !!}
                                            {!! Form::text('instagram',$social ? $social->instagram: "", ['class' => 'form-control', 'id'=> 'instagram']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Youtube:', ['class' => 'control-label']) !!}
                                            {!! Form::text('youtube',$social ? $social->youtube: "", ['class' => 'form-control', 'id'=> 'youtube']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--app info tab--}}
                    <div class="tab-pane fade" id="app">
                        <div class="container-fluid" style="width: 100% !important;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="app_name">App Name:</label>
                                            <input type="text" value="{{$school->app_name}}" name="app_name" class="form-control" id="app-name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Live Stream Url:', ['class' => 'control-label']) !!}
                                            {!! Form::text('livestream_url', $school->livestream_url, ['class' => 'form-control', 'id'=> 'livestream_url']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--colors and media--}}
                    <div class="tab-pane fade" id="mascot">
                        <div class="container-fluid" style="width: 100% !important;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            @include('partials.image_crop_preview')
                                            <div class="control-group">
                                                <img style="width: 100%;" id="photo-preview" src="{{$school->photo}}">
                                                <div class="controls">
                                                    <label class="control-label" for="school_photo">School Photo:</label>
                                                    {!! Form::file('photo', ['class' => 'form-control', 'id' => 'photo']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">

                                            <div class="row">
                                                <div class="col-md-6" id="image-preview1" style="margin-top: 30px;">
                                                    {{ Form::hidden('image_scale1', null, ['id' => 'image_scale1']) }}
                                                    <div class='frame col-md-12' style="width: 350px; height: 350px">
                                                        <img id='sample_picture1' src='img/arrow.png'>
                                                    </div>

                                                    <div id='controls' class="col-md-12" style="margin-top: -80px;">
                                                        {{--<button id='rotate_left'  type='button' title='Rotate left'> &lt; </button>--}}
                                                        <button id='zoom_out1'     type='button' title='Zoom out'> - </button>
                                                        <button id='fit1'          type='button' title='Fit image'> [ ]  </button>
                                                        <button id='zoom_in1'      type='button' title='Zoom in'> + </button>
                                                        {{--<button id='rotate_right' type='button' title='Rotate right'> &gt; </button>--}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <img id="photo-preview1" src="{{$school->school_logo}}">
                                                <div class="controls">
                                                    {!! Form::label('title', 'School logo:', ['class' => 'control-label']) !!}
                                                    {!! Form::file('school_logo', ['class' => 'form-control', 'id' => 'school_logo']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="school_color">School Color:</label>
                                            <input type="color" name="school_color" class="form-control" value="{{$school->school_color}}" id="school-color">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="school_color2">School Color2:</label>
                                            <input type="color" name="school_color2" class="form-control" value="{{$school->school_color2}}" id="school-color2">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="school_color3">School Color3:</label>
                                            <input type="color" name="school_color3" value="{{$school->school_color3}}" class="form-control" id="school-color3">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group-sm">
                                <div class="col-s-3">
                                    <br>

                                    {!! Form::submit('Update settings', ['class' => 'submit_school_modal btn btn-primary']) !!}
                                </div>
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
    <script src="/dist/js/sb-schools-2.js"></script>

    <script src='/js/jquery.guillotine.js'></script>
    <script src='/dist/js/sb-image-crop-2.js'></script>
    <script>
        $(window).load(function() {
            jQuery(function () {
                var picture1 = $('#sample_picture1');


                $('#image-preview1').hide();
                document.getElementById("school_logo").onchange = function () {
                    var reader1 = new FileReader();

                    reader1.onload = function (e) {
                        if (e.total > 250000) {
                            $('#imageerror1').text('Image too large');
                            $jimage = $("#school_logo");
                            $jimage.val("");
                            $jimage.wrap('<form>').closest('form').get(0).reset();
                            $jimage.unwrap();
                            $('#sample_picture1').removeAttr('src');
                            return;
                        }
                        $('#imageerror1').text('');
                        document.getElementById("sample_picture1").src = e.target.result;
                    };
                    reader1.readAsDataURL(this.files[0]);


                    // Make sure the image is completely loaded before calling the plugin
                    picture1.one('load', function () {
                        // Remove any existing instance
                        if (picture1.guillotine('instance')) picture1.guillotine('remove');
                        // Initialize plugin (with custom event)
                        picture1.guillotine({eventOnChange: 'guillotinechange'});
                        picture1.guillotine({width: 400, height: 300});
                        // Display inital data
                        var data = picture1.guillotine('getData');
                        for (var key in data) {
                            $('#' + key).html(data[key]);
                        }

                        // Bind button actions
//              $('#rotate_left').click(function(){ picture1.guillotine('rotateLeft'); $('#image_scale').val(JSON.stringify(data)); });
//              $('#rotate_right').click(function(){ picture1.guillotine('rotateRight'); $('#image_scale').val(JSON.stringify(data)); });
                        $('#fit1').click(function () {
                            picture1.guillotine('fit');
                            $('#image_scale1').val(JSON.stringify(data));
                        });
                        $('#zoom_in1').click(function () {
                            picture1.guillotine('zoomIn');
                            $('#image_scale1').val(JSON.stringify(data));
                        });
                        $('#zoom_out1').click(function () {
                            picture1.guillotine('zoomOut');
                            $('#image_scale1').val(JSON.stringify(data));
                        });
                        $('#image_scale1').val(JSON.stringify(data));
                        // Update data on change
                        picture1.on('guillotinechange', function (ev, data, action) {
                            data.scale = parseFloat(data.scale.toFixed(4));
                            $('#image_scale1').val(JSON.stringify(data));
                            for (var k in data) {
                                $('#' + k).html(data[k]);
                            }
                        });
                    });

                    if($('#photo-preview1').length > 0)
                    {
                        $('#photo-preview1').hide();
                    }

                    $('#image-preview1').show();
                };

                // Make sure the 'load' event is triggered at least once (for cached images)
                if (picture1.prop('complete')) picture1.trigger('load')
            });
        });
    </script>

    @if ($errors->has())

        <script>
            //set the image when redirected back with errors
            $('#photo').attr('src',document.getElementById('school_invisible_image').value);

            //open modal when error is made
            //display errors in modal and hid them with animation slide up in 3 sec
            $('div.alert').delay(4000).slideUp(300);
            {{ $errors = null }}
        </script>

    @endif

    @if (session()->has('success'))
        <script>
            //display success message in the top when successfully updated roster
            $('div.alert').delay(4000).slideUp(300);
        </script>
    @endif
@stop
