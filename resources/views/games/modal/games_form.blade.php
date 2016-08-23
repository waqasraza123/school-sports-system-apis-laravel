<div class="modal fade" id="gameModal" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title form_title">Add Game</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">

                                {!! Form::open(array('url'=>'games/'.$id_sport, 'method'=>'POST', 'files'=>true)) !!}
                                {{ Form::hidden('game_invisible_image', null, ['id' => 'game_invisible_image']) }}
                                {{ Form::hidden('game_invisible_action', null, ['id' => 'game_invisible_action']) }}
                                {{ Form::hidden('hidden_game_date', null, ['id' => 'hidden_game_date']) }}

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

                <div class="form-group select_sport">
                    {!! Form::label('title', 'Sport:', ['class' => 'control-label']) !!}
                    {{ Form::select('game_sport_id', $sports, null, ['class' => 'form-control', 'id' => 'game_sport_id', 'style' => 'width: 100%', 'required'=> 'true']) }}
                    {!! Form::label('title', 'Level:', ['class' => 'control-label']) !!}
                    {{ Form::select('game_level_id', $levelcreate, null, ['class' => 'form-control', 'id' => 'game_level_id', 'style' => 'width: 100%', 'required'=> 'true']) }}
                    {!! Form::label('title', 'Location:', ['class' => 'control-label']) !!}
                    {{ Form::select('game_location_id', $locations, null, ['class' => 'form-control', 'id' => 'game_location_id', 'style' => 'width: 100%', 'required'=> 'true']) }}

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group-6">

                                {!! Form::label('title', 'Game date:', ['class' => 'control-label']) !!}
                                {{--{!! Form::input('game_date', "", ['class' => 'form-control', 'id'=> 'game_date', 'placeholder '=> 'YYYY-MM-DD']) !!}--}}
                                {{ Form::text('game_date', '', array('class'=>'form-control','id' => 'game_date' , 'required'=> 'true')) }}
                            </div>
                        </div>
                    </div>

                  
                        

                        
                  
                                   <div class="row">

                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                                            {{ Form::hidden('game_invisible_id', null, ['id' => 'game_invisible_id']) }}

                                {!! Form::label('title', 'Opponent:', ['class' => 'control-label']) !!}
                                {!! Form::select('opponent',$opponents, null, ['class' => 'form-control', 'id'=> 'opponent', 'style' => 'width: 100%', 'required'=> 'true']) !!}
                                {!! Form::label('title', 'Home or away:', ['class' => 'control-label']) !!}
                                {!! Form::select('home_or_away',['home'=>'home','away'=>'away'], null, ['class' => 'form-control', 'id'=> 'home_or_away', 'style' => 'width: 100%', 'required'=> 'true']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-s future_game">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Game preview:', ['class' => 'control-label', 'required'=> 'true']) !!}
                                {!! Form::textarea('game_preview', null, ['class' => 'form-control', 'id'=> 'game_preview']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 past_game">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Game recap:', ['class' => 'control-label']) !!}
                                {!! Form::textarea('game_recap', null, ['class' => 'form-control', 'id'=> 'game_recap']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row past_game">
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Video:', ['class' => 'control-label']) !!}
                                {!! Form::text('video', null, ['class' => 'form-control', 'id'=> 'video']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Our score:', ['class' => 'control-label']) !!}
                                {!! Form::text('our_score', null, ['class' => 'form-control', 'id'=> 'our_score']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-sm">
                            <div class="col-s-3">
                                {!! Form::label('title', 'Opponents score:', ['class' => 'control-label']) !!}
                                {!! Form::text('opponents_score', null, ['class' => 'form-control', 'id'=> 'opponents_score']) !!}
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

                                {!! Form::submit('Add game', ['class' => 'submit_game_modal btn btn-primary']) !!}
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