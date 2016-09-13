@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        @include('partials.error-messages.success')
        @include('partials.error-messages.error')
        <h2 style="text-align: center">All games</h2>
        <div class="row">
            {!! Form::open(['url' => 'games/filter', 'method'=>'post']) !!}
            <div class="col-md-3">
                {!! Form::select('level_id', $levelsList, null, ['id' => 'select_level_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
            </div>

            <div class="col-md-3">
                {!! Form::select('sport_id', $sportsList, null, ['id' => 'select_sport_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <div class="row">
            <div class="table-responsive .table-striped .table-hover col-md-12">
                <br>
                <a href="{{url('games/create')}}"><button class="btn btn-primary">Add game</button></a>
                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th style="cursor: pointer;">Oponent</th>
                        <th style="cursor: pointer;">Date</th>
                        <th style="cursor: pointer;">Time</th>
                        <th style="cursor: pointer;">Home/Away</th>
                        @if($show_games == '2' || $show_games == '0')
                            <th style="cursor: pointer;">Our Score</th>
                            <th style="cursor: pointer;">Opponents Score</th>
                        @else
                            <th class="sorttable_nosort">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th class="sorttable_nosort">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        @endif


                        {{--{!! Form::open(array('url'=>'games/', 'method'=>'put')) !!}--}}
                        {{--<th colspan="2" class="sorttable_nosort">{!! Form::select('games_select',['All Events','Future Events','Past Events'], $show_games, ['class' => 'form-control', 'id'=> 'games_select', 'onchange' => 'this.form.submit()']) !!}</th>--}}
                        {{--{{ Form::hidden('invisible_games', $games->lists('id'), ['id' => 'invisible_games']) }}--}}
                        {{--{!! Form::close() !!}--}}
                    </tr>
                    </thead>
                    <tbody>
                    @if($sports)
                        @if($games)
                            @foreach($games as $game)
                                <tr>
                                    {{--<td><img src="{{asset('uploads/schools/'.$school_logo[$game->opponents_id] ) }}" height="42"></td>--}}
                                    <td> {{ $school_names[$game->opponents_id]}}</td>
                                    <td>{{ $game->game_date}}</td>
                                    <td>{{ $game->game_time}}</td>
                                    <td>{{ $game->home_away}}</td>
                                    @if($show_games == '2' || $show_games == '0')
                                        <td>{{ $game->opponents_score}}</td>
                                        <td>{{ $game->our_score}}</td>
                                    @else
                                        <td class="sorttable_nosort">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td class="sorttable_nosort">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    @endif

                                    <td> <td><a href="{{url('games/'. $game->id. '/edit')}}" class="btn btn-primary btn-sm">Edit</a></td></td>
                                    <td> {!! Form::open([    'method' => 'DELETE','route' => ['games.destroy', $game->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>

                                </tr>
                            @endforeach
                        @endif

                    @else
                        <div class="alert alert-danger">Please add some sports first.</div>
                    @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
@endsection
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


