@extends('layouts.master')
@section('content')
    {!! Form::model($sponsor, array('url'=>'sponsors/'.$sponsor->id, 'method'=>'PUT', 'files'=>true)) !!}
    <div class="container" style="width: 100% !important;">

        @include('partials.error-messages.error')
        @include('partials.error-messages.success')

        <h3 style="text-align: center; margin-bottom: 50px;">Update Sponsor</h3>
        <div class="row">
            <div class="col-sm-8">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#info">Sponsor Info</a></li>
                    <li><a data-toggle="tab" href="#media">Sponsor Media</a></li>
                    <li><a data-toggle="tab" href="#mascot">Mascot/Colors</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="info">
                        <div class="container-fluid" style="width: 100% !important;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Name:', ['class' => 'control-label']) !!}
                                            {!! Form::text('name', null, ['class' => 'form-control', 'id'=> 'name', 'required'=> 'true']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('tagline', 'Tagline:', ['class' => 'control-label']) !!}
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
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Bio:', ['class' => 'control-label']) !!}
                                            {!! Form::text('bio', null, ['class' => 'form-control', 'id'=> 'bio', 'required' => true]) !!}
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
                                            {!! Form::label('title', 'Phone:', ['class' => 'control-label']) !!}
                                            {!! Form::text('phone', null, ['class' => 'form-control', 'id'=> 'phone', 'required' => true]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

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
                                            {!! Form::text('video', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Vimeo:', ['class' => 'control-label']) !!}
                                            {!! Form::text('vimeo', $social == null ? "" : $social->vimeo, ['class' => 'form-control', 'id'=> 'vimeo']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                            {!! Form::text('facebook', $social == null ? "" : $social->facebook, ['class' => 'form-control', 'id'=> 'facebook']) !!}
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
                                            {!! Form::label('title', 'Youtube:', ['class' => 'control-label']) !!}
                                            {!! Form::text('youtube', $social == null ? "" : $social->youtube, ['class' => 'form-control', 'id'=> 'youtube']) !!}
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
                                                    <label class="control-label" for="photo">Sponsor Photo:</label>
                                                    {!! Form::file('photo', ['class' => 'form-control']) !!}
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
                                                    {!! Form::label('title', 'Sponsor logo:', ['class' => 'control-label']) !!}
                                                    {!! Form::file('logo', ['class' => 'form-control']) !!}
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
                                                    <label class="control-label" for="logo2">Sponsor logo 2:</label>
                                                    {!! Form::file('logo2', ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="color">Sponsor Color:</label>
                                            {!! Form::color('color', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="color2">Sponsor Color2:</label>
                                            {!! Form::color('color2', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            <label class="control-label" for="color3">Sponsor Color3:</label>
                                            {!! Form::color('color3', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 col-md-offset-5" style="margin-top: 30px">
                            <div class="form-group-sm">
                                <div class="col-s-3">
                                    {!! Form::submit('Update Sponsor', ['class' => 'submit_school_modal btn btn-primary']) !!}
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
    @include('partials.error-messages.footer-script')
@stop
