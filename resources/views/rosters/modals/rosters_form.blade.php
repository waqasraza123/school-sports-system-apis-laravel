<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title form_title">Edit Player</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">

                                {!! Form::open(array('url'=>'rosters/'.$id_sport, 'method'=>'POST', 'files'=>true)) !!}
                                {{ Form::hidden('invisible_image', null, ['id' => 'invisible_image']) }}
                                {{ Form::hidden('invisible_action', null, ['id' => 'invisible_action']) }}

                                <img id="photo" height="100"
                                     src="http://images5.fanpop.com/image/photos/28100000/david-david-hasselhoff-28104576-400-300.jpg">

                                <div class="control-group">
                                    <div class="controls">
                                        {!! Form::label('title', 'Select Image:', ['class' => 'control-label']) !!}
                                        {!! Form::file('image') !!}
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('title', 'Level:', ['class' => 'control-label']) !!}
                    {{ Form::select('level_id', $levelcreate, null, ['class' => 'form-control', 'id' => 'level_id', 'style' => 'width: 100%']) }}
                </div>
                <div class="form-group select_sport">
                    {!! Form::label('title', 'Sport:', ['class' => 'control-label']) !!}
                    {{ Form::select('sport_id', $sports, null, ['class' => 'form-control', 'id' => 'sport_id', 'style' => 'width: 100%']) }}


                    {!! Form::label('title', 'Year:', ['class' => 'control-label']) !!}
                    {{ Form::select('year_id', $years, null, ['class' => 'form-control','id' => 'year_id', 'style' => 'width: 100%']) }}

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {{ Form::hidden('invisible_id', null, ['id' => 'invisible_id']) }}

                                {!! Form::label('title', 'First Name:', ['class' => 'control-label']) !!}
                                {!! Form::text('first_name', null, ['class' => 'form-control', 'id'=> 'first_name', 'required'=> 'true']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Last Name:', ['class' => 'control-label']) !!}
                                {!! Form::text('last_name', null, ['class' => 'form-control', 'id'=> 'last_name', 'required'=> 'true']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Jersey:', ['class' => 'control-label']) !!}
                                {!! Form::text('jersey', null, ['class' => 'form-control', 'id'=> 'jersey', 'maxlength'=>'2']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Position:', ['class' => 'control-label']) !!}
                                {{ Form::select('position',$positions, null, ['class' => 'form-control','id' => 'position', 'style' => 'width: 100%']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Years at SFC:', ['class' => 'control-label']) !!}
                                {!! Form::text('sfc', null, ['class' => 'form-control', 'id'=> 'years_at_sfc']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Height(Feet):', ['class' => 'control-label']) !!}
                                {{ Form::select('heightfeet', ['4' => '4','5' => '5','6' => '6','7' => '7'], null, ['class' => 'form-control','id' => 'height_feet', 'style' => 'width: 100%', 'required'=> 'true']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Height(Inches):', ['class' => 'control-label']) !!}
                                {{ Form::select('heightinches', ['0' => '0','1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10','11' => '11'], null, ['class' => 'form-control','id' => 'height_inches', 'style' => 'width: 100%', 'required'=> 'true']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Weight:', ['class' => 'control-label']) !!}
                                {{ Form::select('weight',$weight_options, null, ['class' => 'form-control','id' => 'weight', 'style' => 'width: 100%']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Hometown:', ['class' => 'control-label']) !!}
                                {!! Form::text('hometown', null, ['class' => 'form-control', 'id'=> 'hometown']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Favorite Bible Verse:', ['class' => 'control-label']) !!}
                                {!! Form::text('bible', null, ['class' => 'form-control', 'id'=> 'verse']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Favorite Food:', ['class' => 'control-label']) !!}
                                {!! Form::text('food', null, ['class' => 'form-control', 'id'=> 'food']) !!}
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

                                {!! Form::submit('Update Player', ['class' => 'submit_roster_modal btn btn-primary']) !!}
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