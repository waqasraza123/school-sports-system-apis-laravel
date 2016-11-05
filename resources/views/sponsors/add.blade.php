@extends('layouts.master')
@section('content')
    {!! Form::open(array('url'=>'sponsors/', 'method'=>'POST', 'files'=>true, 'id' => 'sponsor_form')) !!}
    <div class="container" style="width: 100% !important;">

        @include('partials.error-messages.error')
        @include('partials.error-messages.success')
        <div class="alert-custom-success alert alert-success" style="display: none"></div>
        <div class="alert-custom-error alert alert-danger" style="display: none"></div>
        <input type="hidden" value="1" id="create_sponsor">

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
                                            {!! Form::text('twitter', null, ['class' => 'form-control', 'id'=> 'twitter']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-sm">
                                        <div class="col-s-3">
                                            {!! Form::label('title', 'Facebook:', ['class' => 'control-label']) !!}
                                            <span style="font-size: 11px">for profile id go to http://findmyfbid.com/</span>
                                            {!! Form::text('facebook', null, ['class' => 'form-control', 'id'=> 'facebook',
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
                                            {!! Form::text('instagram', null, ['class' => 'form-control', 'id'=> 'instagram']) !!}
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
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label class="control-label" for="logo">Logo:</label>
                                                    {!! Form::file('logo', ['class' => 'form-control logo']) !!}
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
                                                    <label class="control-label" for="color">Main Color:</label>
                                                    {!! Form::color('color', null, ['class' => 'form-control']) !!}
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
                                                    <label class="control-label" for="photo">Photo:</label>
                                                    {!! Form::file('photo', ['class' => 'form-control photo']) !!}
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
                                    {!! Form::submit('Create Sponsor', ['class' => 'submit_sponsor btn btn-primary',
                                    'id' => 'submit_sponsor']) !!}
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
    <script src="/js/sports/sponsors.js"></script>
@stop
