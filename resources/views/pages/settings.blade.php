@extends('layouts.master')
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
                                            {!! Form::text('vimeo', $social->vimeo, ['class' => 'form-control', 'id'=> 'vimeo']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Twitter:', ['class' => 'control-label']) !!}
                                            {!! Form::text('twitter', $social->twitter, ['class' => 'form-control', 'id'=> 'twitter']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Facebook:', ['class' => 'control-label']) !!}
                                            {!! Form::text('facebook', $social->facebook, ['class' => 'form-control', 'id'=> 'facebook']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Instagram:', ['class' => 'control-label']) !!}
                                            {!! Form::text('instagram', $social->instagram, ['class' => 'form-control', 'id'=> 'instagram']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Youtube:', ['class' => 'control-label']) !!}
                                            {!! Form::text('youtube', $social->youtube, ['class' => 'form-control', 'id'=> 'youtube']) !!}
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
                                            <div class="control-group">
                                                <img src="{{$school->photo}}">
                                                <div class="controls">
                                                    <label class="control-label" for="school_photo">School Photo:</label>
                                                    {!! Form::file('photo') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <div class="control-group">
                                                <img src="{{$school->school_logo}}">
                                                <div class="controls">
                                                    {!! Form::label('title', 'School logo:', ['class' => 'control-label']) !!}
                                                    {!! Form::file('school_logo') !!}
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
