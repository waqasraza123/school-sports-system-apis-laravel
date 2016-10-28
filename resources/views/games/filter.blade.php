@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        @include('partials.error-messages.success')
        @include('partials.error-messages.error')
        <h2 style="text-align: center">Games</h2>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="row">
                    {!! Form::open(['url' => 'games/filter', 'method'=>'post']) !!}
                    <div class="col-md-6">
                        {!! Form::selectYear('year', 2005, \Carbon\Carbon::now()->year,
            \Carbon\Carbon::now()->year, [
           'class' => 'form-control', 'id' => 'select_year_id', 'required' => true, 'onchange' => 'this.form.submit()']) !!}
                    </div>

                    <div class="col-md-6">
                        {!! Form::select('roster_id', $rostersList, null, ['id' => 'select_roster_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive .table-striped .table-hover col-md-12">
                <br>
                <a href="{{url('games/create')}}"><button class="btn btn-primary">Add game</button></a>
                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th style="cursor: pointer;">Opponent</th>
                        <th style="cursor: pointer;">Date</th>
                        <th style="cursor: pointer;">Time</th>
                        <th style="cursor: pointer;">Home/Away</th>
                        <th style="cursor: pointer;">Our Score</th>
                        <th style="cursor: pointer;">Opponents Score</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @if($year)
                        @if($games)
                            {{--all the games for that particular roster--}}
                            @foreach($games as $game)
                                @if($game->year == $year)
                                    <tr>
                                        <td>{{$opponents[$game->id]}}</td>
                                        <td>{{$game->game_date}}</td>
                                        <td>{{$game->game_time}}</td>
                                        <td>{{$game->home_away}}</td>
                                        <td>{{$game->our_score}}</td>
                                        <td>{{$game->opponents_score}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            @foreach($allGames as $game)
                                @if($game->year->year == $year)
                                    <tr>
                                        @foreach($opponents as $opp)
                                            @if($opp->id == $game->opponents_id)
                                                <td>{{$opp->name}}</td>
                                            @endif
                                        @endforeach
                                        <td>{{$game->game_date}}</td>
                                        <td>{{$game->game_time}}</td>
                                        <td>{{$game->home_away}}</td>
                                        <td>{{$game->our_score}}</td>
                                        <td>{{$game->opponents_score}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script>
        $("#select_year_id").val(<?php echo $year?>)
        $("#select_roster_id").val(<?php echo $rosterId?>)
    </script>
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
        $("#select_year_id").val(<?php echo $year;?>)

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
@endsection