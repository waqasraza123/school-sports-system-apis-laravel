<div class="modal fade" id="schoolModal" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title form_title">Add School</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">

                                {!! Form::open(array('url'=>'schools/', 'method'=>'POST', 'files'=>true)) !!}

                                <div class="control-group">
                                    <div class="controls">
                                        {!! Form::label('title', 'School logo:', ['class' => 'control-label', 'required'=>'required']) !!}
                                        {!! Form::file('school_logo', ['required' => true]) !!}
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
                                        <label class="control-label" for="school_photo">School Photo:</label>
                                        {!! Form::file('photo', ['required' => true]) !!}
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
                                <input type="text" name="school_tagline" class="form-control" id="school-tagline">
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
                                <label class="control-label" for="app_name">App Name:</label>
                                <input type="text" name="app_name" class="form-control" id="app-name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                <label class="control-label" for="school_color">School Color:</label>
                                <input type="text" name="school_color" class="form-control" id="school-color">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                <label class="control-label" for="school_color2">School Color2:</label>
                                <input type="text" name="school_color2" class="form-control" id="school-color2">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                <label class="control-label" for="school_color3">School Color3:</label>
                                <input type="text" name="school_color3" class="form-control" id="school-color3">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                <label class="control-label" for="school_email">Email:</label>
                                <input type="email" name="school_email" class="form-control" id="school-email">
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
                                {!! Form::label('title', 'Live Stream Url:', ['class' => 'control-label']) !!}
                                {!! Form::text('livestream_url', null, ['class' => 'form-control', 'id'=> 'livestream_url']) !!}
                            </div>
                        </div>
                    </div>
                <div class="row">

                    <div class="col-md-6 col-md-offset-4">
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

                                {!! Form::submit('Add School', ['class' => 'submit_school_modal btn btn-primary']) !!}
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