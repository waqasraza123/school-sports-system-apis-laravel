@extends('layouts.master')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        <br>
    @endif
    {!! Form::model($schools, array('url'=>'schools/edit/'.$schools->id, 'method'=>'POST', 'files'=>true)) !!}
    <div class="container" style="width: 100% !important;">
        <h3>Update School</h3>
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
                                            {{ Form::hidden('school_invisible_id', null, ['id' => 'school_invisible_id']) }}

                                            {!! Form::label('title', 'Name:', ['class' => 'control-label']) !!}
                                            {!! Form::text('name', null, ['class' => 'form-control', 'id'=> 'name', 'required'=> 'true']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'School Nick:', ['class' => 'control-label']) !!}
                                            {!! Form::text('short_name', null, ['class' => 'form-control', 'id'=> 'short_name', 'required'=> 'true']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="school_tagline">Tagline:</label>
                                            {!! Form::text('school_tagline', null, ['class' => 'form-control', 'id'=> 'school_tagline']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Bio:', ['class' => 'control-label']) !!}
                                            {!! Form::text('bio', null, ['class' => 'form-control', 'id'=> 'bio']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Address :', ['class' => 'control-label']) !!}
                                            {!! Form::text('adress', null, ['class' => 'form-control', 'id'=> 'adress', 'required'=> 'true']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'City:', ['class' => 'control-label']) !!}
                                            {!! Form::text('city', null, ['class' => 'form-control', 'id'=> 'city', 'required'=> 'true']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'State:', ['class' => 'control-label']) !!}
                                            {!! Form::text('state', null, ['class' => 'form-control', 'id'=> 'state', 'required'=> 'true']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Zip:', ['class' => 'control-label']) !!}
                                            {!! Form::text('zip', null, ['class' => 'form-control', 'id'=> 'zip', 'required'=> 'true']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Phone:', ['class' => 'control-label']) !!}
                                            {!! Form::text('phone', null, ['class' => 'form-control', 'id'=> 'phone']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Website:', ['class' => 'control-label']) !!}
                                            {!! Form::text('website', null, ['class' => 'form-control', 'id'=> 'website']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="school_email">Email:</label>
                                            {!! Form::email('school_email', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="video">Video</label>
                                            <input type="text" name="video" class="form-control" id="school-video">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Vimeo:', ['class' => 'control-label']) !!}
                                            {!! Form::text('vimeo', $social->vimeo, ['class' => 'form-control', 'id'=> 'vimeo']) !!}
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
                                            {!! Form::text('app_name',null, ['class' => 'form-control', 'id'=> 'app_name']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Live Stream Url:', ['class' => 'control-label']) !!}
                                            {!! Form::text('livestream_url', null, ['class' => 'form-control', 'id'=> 'livestream_url']) !!}
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
                                                <div class="controls">
                                                    <img src="{{URL::to('/')}}/uploads/schools/{!! $schools->school_logo !!}" width="150px" height="150px"><br>
                                                    {!! Form::label('title', 'School logo:', ['class' => 'control-label', 'required'=>'required']) !!}
                                                    {!! Form::file('school_logo') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <img src="{{URL::to('/')}}/uploads/schools/{!! $schools->photo !!}" width="150px" height="150px"><br>
                                                    <label class="control-label" for="school_photo">School Photo:</label>
                                                    {!! Form::file('photo') !!}
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
                                            {!! Form::color('school_color', null,['class' => 'form-control', 'id'=> 'school_color']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="school_color2">School Color2:</label>
                                            {!! Form::color('school_color2', null,['class' => 'form-control', 'id'=> 'school_color2']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="school_color3">School Color3:</label>
                                            {!! Form::color('school_color3', null,['class' => 'form-control', 'id'=> 'school_color3']) !!}
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
                                    @if ($errors->has())
                                        <div class="alert alert-danger">


                                            @foreach(Session::get('message') as $er)
                                                {{ $er }} <br>
                                            @endforeach
                                        </div>
                                    @endif

                                    {!! Form::submit('Update School', ['class' => 'submit_school_modal btn btn-primary']) !!}
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

