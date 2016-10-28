@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        @include('partials.error-messages.error')
        @include('partials.error-messages.success')
            <div class="row">
                <h3 style="text-align: center">Add Location</h3>
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <div class="col-s-3">

                            {!! Form::open(array('url'=>'locations/', 'method'=>'POST', 'files'=>true)) !!}

                        </div>
                    </div>
                </div>
            </div>

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
                            {!! Form::label('title', 'Address :', ['class' => 'control-label']) !!}
                            {!! Form::text('address', null, ['class' => 'form-control', 'id'=> 'adress', 'required'=> 'true']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <div class="col-s-3">
                            {!! Form::label('title', 'City:', ['class' => 'control-label']) !!}
                            {!! Form::text('city', null, ['class' => 'form-control', 'id'=> 'city', 'required'=> 'true']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <div class="col-s-3">
                            {!! Form::label('title', 'State:', ['class' => 'control-label']) !!}
                            {!! Form::text('state', null, ['class' => 'form-control', 'id'=> 'state', 'required'=> 'true']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <div class="col-s-3">
                            {!! Form::label('title', 'Zip:', ['class' => 'control-label']) !!}
                            {!! Form::text('zip', null, ['class' => 'form-control', 'id'=> 'zip', 'required'=> 'true']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <div class="col-s-3">
                            {!! Form::label('map_url', 'Map Url: ', ['class' => 'control-label']) !!}
                            {!! Form::text('map_url', null, ['class' => 'form-control']) !!}
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
                <div class="row">

                    <div class="col-md-12 col-md-offset-5">
                        <div class="form-group-sm">
                            <div class="col-s-3" style="margin-top: 30px">
                                {!! Form::submit('Add Location', ['class' => 'submit_location_modal btn btn-primary']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script>
        $('#game_date').datetimepicker({format: "YYYY-MM-DD"});
    </script>
@endsection