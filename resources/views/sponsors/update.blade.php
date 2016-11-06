@extends('layouts.master')
<link href='/css/jquery.guillotine.css' media='all' rel='stylesheet'>
@section('content')
    {!! Form::model($sponsor, array('url'=>'sponsors/'.$sponsor->id, 'method'=>'PUT', 'files'=>true,
    'id' => 'sponsor_form')) !!}
    <div class="container" style="width: 100% !important;">

        @include('partials.error-messages.error')
        @include('partials.error-messages.success')

        <div class="alert-custom-success alert alert-success" style="display: none"></div>
        <div class="alert-custom-error alert alert-danger" style="display: none"></div>
        <input type="hidden" value="0" id="create_sponsor">
        <input type="hidden" value="{{$sponsor->id}}" id="sponsor_id">

        <div class="row">
            <div class="col-sm-8">
                <h3 style="text-align: center; margin-bottom: 50px;">Create Sponsor</h3>
            </div>
            <div class="col-sm-8">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#info">Sponsor Info</a></li>
                    <li><a data-toggle="tab" href="#media">Sponsor Media</a></li>
                    <li><a data-toggle="tab" href="#mascot">Images/Colors</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="info">
                        <div class="container-fluid" style="width: 100% !important;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Business Name:', ['class' => 'control-label']) !!}
                                            {!! Form::text('name', null, ['class' => 'form-control', 'id'=> 'name', 'required'=> 'true']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('tagline', 'Headline:', ['class' => 'control-label']) !!}
                                            {!! Form::text('tagline', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="email">Email:</label>
                                            {!! Form::email('email', null, ['class' => 'form-control', 'required' => true]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="form-group-sm">
                                            <div class="col-s-3">
                                                {!! Form::label('title', 'Phone:', ['class' => 'control-label']) !!}
                                                {!! Form::text('phone', null, ['class' => 'form-control', 'id'=> 'phone', 'required' => true]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Address :', ['class' => 'control-label']) !!}
                                            {!! Form::text('address', null, ['class' => 'form-control', 'id'=> 'adress', 'required'=> 'true']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Website:', ['class' => 'control-label']) !!}
                                            {!! Form::text('url', null, ['class' => 'form-control', 'id'=> 'url']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Description:', ['class' => 'control-label']) !!}
                                            {!! Form::textarea('bio', null, ['class' => 'form-control', 'id'=> 'bio', 'required' => true]) !!}
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('order', 'Order:', ['class' => 'control-label']) !!}
                                            {!! Form::number('order', null, ['class' => 'form-control', 'id'=> 'order', 'required' => true]) !!}
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
                                            {!! Form::label('title', 'Twitter:', ['class' => 'control-label']) !!}
                                            {!! Form::text('twitter', $social == null ? "" : $social->twitter, ['class' => 'form-control', 'id'=> 'twitter']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Facebook:', ['class' => 'control-label']) !!}
                                            <span style="font-size: 11px">for profile id go to http://findmyfbid.com/</span>
                                            {!! Form::text('facebook', $social == null ? "" : $social->facebook, ['class' => 'form-control', 'id'=> 'facebook',
                                            'placeholder' => 'for profile link follow the format facebook.com/id']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Instagram:', ['class' => 'control-label']) !!}
                                            {!! Form::text('instagram', $social == null ? "" : $social->instagram, ['class' => 'form-control', 'id'=> 'instagram']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">

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
                                                <div class="controls">
                                                    <label class="control-label" for="logo">Logo:</label>
                                                    {!! Form::file('school_logo', ['class' => 'form-control logo', 'id' => 'school_logo']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            @include('partials.image_crop_preview')
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label" for="photo">Photo:</label>
                                                    {!! Form::file('photo', ['class' => 'form-control photo', 'id' => 'photo']) !!}
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
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label" for="color">Main Color:</label>
                                                    {!! Form::color('color', null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 col-md-offset-5" style="margin-top: 30px">
                            <div class="form-group-sm">
                                <div class="col-s-3">
                                    {!! Form::submit('Update', ['class' => 'btn btn-primary'
                                    ,'id' => 'submit_sponsor']) !!}
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

    <script src='/js/jquery.guillotine.js'></script>
    <script src='/dist/js/sb-image-crop-2.js'></script>
    <script>
        $(window).load(function() {
            jQuery(function () {
                var picture1 = $('#sample_picture1');


                $('#image-preview1').hide();
                document.getElementById("logo").onchange = function () {
                    var reader1 = new FileReader();

                    reader1.onload = function (e) {
                        if (e.total > 250000) {
                            $('#imageerror1').text('Image too large');
                            $jimage = $("#logo");
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

    @include('partials.error-messages.footer-script')
    <script src="/js/sports/sponsors.js"></script>
@stop
