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
        @foreach($albums as $album)
            <div class="col-lg-2" style="padding: 20px">
                <style>
                    .info, .delete
                    {
                        display: none;
                    }
                    .sss:hover .info, .sss:hover .delete
                    {
                        display: flex;
                    }
                </style>

                <a href="{{route('albums.show', $album->id)}}">
                <div class="sss" style="position: relative; background-image: url('{{asset('img/folder.png') }}'); background-repeat: no-repeat; background-size: cover; width: 200px;height: 200px;">
                </div>
                </a>
                <div class="info" style="color: white; background: rgba(0,0,0,0.5); height: 200px;">

                    <p class="id" style="" >{{ $album->id}}</p>
                    <div>
                        <p class="sports_id" style="display: none;" >{{ json_encode($album->sports->lists('id'))}} </p>
                        <p class="games_ids" style="display: none;" >{{ json_encode($album->games->lists('id'))}} </p>
                        <p class="levels_ids" style="display: none;" >{{ json_encode($album->levels->lists('id'))}} </p>
                        <p class="schools_ids" style="display: none;" >{{ json_encode($album->schools->lists('id'))}} </p>
                        <p class="years_ids" style="display: none;" >{{ json_encode($album->years->lists('id'))}} </p>
                    </div>

                </div>
                <div class="col-lg-12" align="center"> <p style="margin-top: -100px;">
                        @foreach($album->sports as $sport_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px" >{{$sport_tag->name}}</span> @endforeach
                        @foreach($album->games as $games_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$schools[$games_tag->opponents_id]." ".$games_tag->game_date}}</span> @endforeach
                        @foreach($album->levels as $levels_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$levels_tag->name}}</span> @endforeach
                        @foreach($album->schools as $schools_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$schools_tag->name}}</span> @endforeach
                        @foreach($album->years as $years_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$years_tag->year}}</span> @endforeach
                    </p></div>
                <div class="col-lg-12">
                    <div class="col-lg-6"><p align="left">{{ $album->name}}</p></div>
                    <div class="col-lg-2">{!! Form::open([    'method' => 'DELETE','route' => ['albums.destroy', $album->id]]) !!}{!! Form::submit('X', array('style' => 'background: none; border: none; font-size:20px; font-weight: 700;')) !!}{!! Form::close() !!}
                    </div>
                    <div class="col-lg-2"><button data-id="{{ $album->id}}" data-toggle="modal" class="edit_album" data-target="#albumModal" align="right" style="background: transparent;border: none; font-size: 20px;"><span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span></button>
                    </div>

                     <button align="right" style="background: transparent;border: none; font-size: 24px;"></button>

                </div>

            </div>
        @endforeach
    </div>
    @include('albums.modal.album_form')
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
