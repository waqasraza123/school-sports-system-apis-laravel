<div class="modal fade" id="locationModal" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title form_title">Edit Location</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">

                                {!! Form::open(array('url'=>'locations/', 'method'=>'POST', 'files'=>true)) !!}
                                {{ Form::hidden('location_invisible_action', null, ['id' => 'location_invisible_action']) }}

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {{ Form::hidden('location_invisible_id', null, ['id' => 'location_invisible_id']) }}

                                {!! Form::label('title', 'Name:', ['class' => 'control-label']) !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'id'=> 'name', 'required'=> 'true']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Address :', ['class' => 'control-label']) !!}
                                {!! Form::text('adress', null, ['class' => 'form-control', 'id'=> 'adress', 'required'=> 'true']) !!}
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
                                {!! Form::label('title', 'Latitude:', ['class' => 'control-label']) !!}
                                {!! Form::text('lat', null, ['class' => 'form-control', 'id'=> 'lat', 'required'=> 'true']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Longitude:', ['class' => 'control-label']) !!}
                                {!! Form::text('lon', null, ['class' => 'form-control', 'id'=> 'lon', 'required'=> 'true']) !!}
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

                        <div class="col-md-6">
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

                                    {!! Form::submit('Update Location', ['class' => 'submit_location_modal btn btn-primary']) !!}
                                    &nbsp;
                                    <button style="vertical-align: center;" type="button" class="btn btn-default"
                                            data-dismiss="modal">Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>