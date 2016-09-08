@extends('layouts.master')

@section('content')



    <h1>{{ $type->name or 1}} Schedule</h1>
    <p class="lead">
        <button type="button" id="add_new_game" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#gameModal">Schedule Event?</button>
    </p>

    <ul class="nav nav-tabs">
        <li class="active"><a href="/games/{{ $type->id or 1}}">All</a></li>
        @foreach($levels as $level)
            <li><a href="/games/{{ $type->id or 1}}/filter/{{$level['id']}}">{{$level['name']}}</a></li>
        @endforeach
    </ul>


    <br>
    <div class="selected_level_id" style="display: none;"  >1</div>
    <div class="selected_sport_id" style="display: none;"  >{{ $type->id or 1}}</div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}

        </div>
        <br>
    @endif



        <div class="panel panel-primary">
            <div class="table-responsive">
                <table class="table table-hover sortable">
                    <thead  style="background-color:#337AB7; color:white">
                    <tr>
                        <th class="sorttable_nosort">&nbsp;</th>
                        <th style="cursor: pointer;">Oponent</th>
                        <th style="cursor: pointer;">Date Time</th>
                        <th style="cursor: pointer;">Home/Away</th>
                        @if($show_games == '2' || $show_games == '0')
                        <th style="cursor: pointer;">Our Score</th>
                        <th style="cursor: pointer;">Opponents Score</th>
                        @else
                            <th class="sorttable_nosort">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th class="sorttable_nosort">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        @endif

                       
                        {!! Form::open(array('url'=>'games/'.$id_sport, 'method'=>'put')) !!}
                        <th colspan="2" class="sorttable_nosort">{!! Form::select('games_select',['All Events','Future Events','Past Events'], $show_games, ['class' => 'form-control', 'id'=> 'games_select', 'onchange' => 'this.form.submit()']) !!}</th>
                        {!! Form::close() !!}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($games as $game)
                        {{--{{ dd($game->game_date) }}--}}
                        <tr>
                            <td><img src="{{asset('uploads/schools/'.$school_logo[$game->opponents_id] ) }}" height="42"></td>
                            <td> {{ $school_names[$game->opponents_id]}}</td>
                            <td>{{ $game->game_date}}</td>
                            <td>{{ $game->home_away}}</td>
                            @if($show_games == '2' || $show_games == '0')
                            <td>{{ $game->opponents_score}}</td>
                            <td>{{ $game->our_score}}</td>
                            @else
                                <td class="sorttable_nosort">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td class="sorttable_nosort">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            @endif

                            <td> <button type="button" class="btn btn-primary btn-sm edit_new_game" data-id="{{ $game->id}}" data-toggle="modal" data-target="#gameModal">Edit</button></td>
                            <td> {!! Form::open([    'method' => 'DELETE','route' => ['games.destroy', $game->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                            <td class="id" style="display: none;"  />{{ $game->id }}</td>
                            <td class="game_sport_id" style="display: none;"  />{{ $game->sport_id }}</td>
                            <td class="game_level_id" style="display: none;"  />{{ $game->level_id }}</td>
                            <td class="game_locations_id" style="display: none;"  />{{ $game->locations_id }}</td>
                            <td class="opponents_id" style="display: none;"  />{{ $game->opponents_id }}</td>
                            <td class="game_date" style="display: none;"  />{{ $game->game_date}}</td>
                            <td class="hidden_game_date" style="display: none;"  />{{ $game->game_date}}</td>
                            <td class="home_or_away" style="display: none;"  />{{ $game->home_away}}</td>
                            <td class="photo" style="display: none;"  />{{asset('uploads/games/'.$game->photo ) }}</td>
                            <td class="opponents_score" style="display: none;"  />{{ $game->opponents_score}}</td>
                            <td class="our_score" style="display: none;"  />{{ $game->our_score}}</td>
                            <td class="video" style="display: none;"  />{{ $game->video}}</td>
                            <td class="game_preview" style="display: none;"  />{{ $game->game_preview}}</td>
                            <td class="game_recap" style="display: none;"  />{{ $game->game_recap}}</td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
                @if ($games->isEmpty() )
                    <div class="bs-callout bs-callout-warning">
                        <h4>No Results</h4>
                        Nothing to see here please select another level, or create a game
                        <a  data-toggle="modal" data-target="#gameModal">Here</a>
                    </div>
                @endif
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        </div>

        <!-- Modal -->
        @include('games.modal.games_form')



@stop

@section('footer')
    <script type="text/javascript">
        $('#game_sport_id').select2();
        $('#game_level_id').select2();
        $('#game_location_id').select2();
        $('#opponent').select2({
            placeholder: "Select opponent",
        });
        $('#home_or_away').select2({
            placeholder: "Select home or away",
        });

    </script>
    <script src="/dist/js/sb-games-2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#game_date').datetimepicker({format: "YYYY-MM-DD HH:mm:ss",  inline: true, sideBySide: true});
        });
    </script>
    @if ($errors->has())

        <script>
            //set the image when redirected back with errors
            $('#photo').attr('src',document.getElementById('game_invisible_image').value);

            //open modal when error is made
            //display errors in modal and hid them with animation slide up in 3 sec
            $('div.alert').delay(4000).slideUp(300);
            $('#gameModal').modal();
            $('.gameModal').show();

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
