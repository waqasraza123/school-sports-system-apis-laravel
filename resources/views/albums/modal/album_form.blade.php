<div class="modal fade" id="albumModal" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title form_title">Edit album tags</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">

                                {!! Form::open(array('url'=>'albums/update', 'method'=>'POST')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group select_sport">
                    {!! Form::label('title', 'Album name:', ['class' => 'control-label']) !!}
                    {!! Form::text('name', $album->name, ['class' => 'fn form-control', 'required' => 'true']) !!}
                    {!! Form::label('title', 'Sport:', ['class' => 'control-label']) !!}
                    {{ Form::select('sport_modal_id[]', $sports, null, ['class' => 'form-control', 'id' => 'sport_modal_id', 'style' => 'width: 100%', 'multiple', 'required'=> 'true']) }}
                    {!! Form::label('title[]', 'Level:', ['class' => 'control-label']) !!}
                    {{ Form::select('level_modal_id[]', $levelcreate, null, ['class' => 'form-control', 'id' => 'level_modal_id', 'style' => 'width: 100%', 'multiple']) }}
                    {!! Form::label('title[]', 'School:', ['class' => 'control-label']) !!}
                    {{ Form::select('school_modal_id[]', $schools, null, ['class' => 'form-control', 'id' => 'school_modal_id', 'style' => 'width: 100%', 'multiple']) }}
                    {!! Form::label('title[]', 'Year:', ['class' => 'control-label']) !!}
                    {{ Form::select('year_modal_id[]', $years, null, ['class' => 'form-control', 'id' => 'year_modal_id', 'style' => 'width: 100%', 'multiple']) }}

                    {!! Form::label('title', 'Game:', ['class' => 'control-label']) !!}
                    {{ Form::select('game_modal_id[]', $games, null, ['class' => 'form-control','id' => 'game_modal_id', 'style' => 'width: 100%', 'multiple']) }}
                    {{ Form::hidden('album_invisible_id', null, ['id' => 'album_invisible_id']) }}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                <br>

                                {!! Form::submit('Update album tags', ['class' => 'submit_news_modal btn btn-primary']) !!}
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