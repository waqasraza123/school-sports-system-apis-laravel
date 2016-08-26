<div class="modal fade" id="schoolModal" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title form_title">Edit School</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">

                                {!! Form::open(array('url'=>'schools/', 'method'=>'POST', 'files'=>true)) !!}
                                {{ Form::hidden('school_invisible_image', null, ['id' => 'school_invisible_image']) }}
                                {{ Form::hidden('school_invisible_action', null, ['id' => 'school_invisible_action']) }}

                                <img id="photo" height="100"
                                     src="http://images5.fanpop.com/image/photos/28100000/david-david-hasselhoff-28104576-400-300.jpg">

                                <div class="control-group">
                                    <div class="controls">
                                        {!! Form::label('title', 'Select Image:', ['class' => 'control-label', 'required'=>'required']) !!}
                                        {!! Form::file('image') !!}
                                        <br>
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
                                {{ Form::hidden('school_invisible_id', null, ['id' => 'school_invisible_id']) }}

                                {!! Form::label('title', 'Name:', ['class' => 'control-label']) !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'id'=> 'name', 'required'=> 'true']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Short name:', ['class' => 'control-label']) !!}
                                {!! Form::text('short_name', null, ['class' => 'form-control', 'id'=> 'short_name', 'required'=> 'true']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Mascot name:', ['class' => 'control-label']) !!}
                                {!! Form::text('mascot_name', null, ['class' => 'form-control', 'id'=> 'mascot_name', 'required'=> 'true']) !!}
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
                                <label class="control-label" for="app-name">App Name:</label>
                                <input type="text" name="app-name" class="form-control" id="app-name">
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
                                {!! Form::label('title', 'Twitter:', ['class' => 'control-label']) !!}
                                {!! Form::text('twitter', null, ['class' => 'form-control', 'id'=> 'twitter']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Facebook:', ['class' => 'control-label']) !!}
                                {!! Form::text('facebook', null, ['class' => 'form-control', 'id'=> 'facebook']) !!}
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
                                {!! Form::label('title', 'Youtube:', ['class' => 'control-label']) !!}
                                {!! Form::text('youtube', null, ['class' => 'form-control', 'id'=> 'youtube']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Vimeo:', ['class' => 'control-label']) !!}
                                {!! Form::text('vimeo', null, ['class' => 'form-control', 'id'=> 'vimeo']) !!}
                            </div>
                        </div>
                    </div>
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

                                {!! Form::submit('Update School', ['class' => 'submit_school_modal btn btn-primary']) !!}
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