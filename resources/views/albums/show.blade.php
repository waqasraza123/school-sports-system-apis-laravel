@extends('layouts.master')
<link rel="stylesheet" href="/css/dropzone.css">
@section('content')
    <div class="col-lg-2"><h1> Albums</h1></div>
    <div class="col-lg-10">
        <br>
        <a href="{{url('albums/create')}}"><button class="btn btn-primary">Add album</button></a>
        <br>
    </div>
    @include('partials.error-messages.error')
    @include('partials.error-messages.success')
    <div class="col-lg-12" >
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Tags</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($albums as $album)
                <tr>
                    <td>{{$album->name}}</td>
                    <td>@foreach($album->rosters as $roster_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px" >{{$roster_tag->name}}</span> @endforeach
                        @foreach($album->games as $games_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$schools[$games_tag->opponents_id]." ".$games_tag->game_date}}</span> @endforeach
                        @foreach($album->years as $years_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$years_tag->year}}</span> @endforeach
                    </td>
                    <td><a href="{{url('albums/'. $album->id)}}" class="btn btn-primary btn-sm">Show pictures</a></td>
                    <td><a href="{{url('albums/'. $album->id. '/edit')}}" class="btn btn-primary btn-sm">Edit</a></td>
                    <td>{!! Form::open(['method' => 'DELETE','route' => ['albums.destroy', $album->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>

@stop

@section('footer')
    <script src="/dist/js/sb-album-2.js"></script>
    <script type="text/javascript">
//        $('#sport_id').select2();
//        $('#game_id').select2();
//        $('#level_id').select2();
//        $('#school_id').select2();

        $('#sport_modal_id').select2();
        $('#game_modal_id').select2();
        $('#level_modal_id').select2();
        $('#school_modal_id').select2();
        $('#year_modal_id').select2();

    </script>
    @include('partials.error-messages.footer-script')
@stop
