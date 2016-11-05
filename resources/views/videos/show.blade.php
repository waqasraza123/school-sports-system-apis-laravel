@extends('layouts.master')
<link rel="stylesheet" href="/css/dropzone.css">
@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-left: 5%; margin-right: 5%">
            <h1>Videos</h1>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}

                </div>
                <br>
            @endif
            <div class="col-lg-12" id="video_box">
                {!! Form::open(['route' => ['videos.url-upload']]) !!}
                        <!-- this is were the previews should be shown. -->
                <div id="inputs">
                    {!! Form::label('title', 'Video url:', ['class' => 'control-label']) !!}
                    {!! Form::text('url', null, ['class' => 'fn form-control', 'required' => 'true']) !!}
                </div>
                <button type="button" class="btn btn-warning" id="addInput">Add new field</button>

                <button type="submit" class="btn btn-info" id="submitbtn" style="margin-left: 75%; margin-top: 5px;">Add video url</button>
                {!! Form::close() !!}
            </div>

            <div class="col-lg-12">
                <h1>VIDEOS</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th>URL</th>
                        <th>Players</th>
                        <th>Rosters</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gallery_videos as $video)
                        <tr>
                            <td><a href="{{ $video->url}}">{{$video->url}}</a></td>
                            <td>@foreach($video->students as $student_tag) <label>{{$student_tag->name}}, </label> @endforeach
                            </td>
                            <td>@foreach($video->rosters as $roster_tag) <label>{{$roster_tag->name}}, </label> @endforeach
                            </td>
                            <td><button data-id="{{ $video->id}}" data-toggle="modal" class="edit_video btn btn-info" data-target="#videoModal" align="right" >edit</button></td>
                            <td>{!! Form::open([    'method' => 'DELETE','route' => ['videos.destroy', $video->id]]) !!}{!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}{!! Form::close() !!}</td>
                            <td><p class="video_students_ids" style="display: none;" >{{ json_encode($video->students->lists('id'))}} </p></td>
                            <td><p class="video_rosters_ids" style="display: none;" >{{ json_encode($video->rosters->lists('id'))}} </p></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@include('videos.modal.video_form')
@section('footer')
    @include('partials.error-messages.footer-script')
    <script src="/dist/js/sb-video-2.js"></script>
    <script type="text/javascript">
        $('#student_id').select2();
        $('#student_modal_id').select2();
        $('#roster_modal_id').select2();

        submitForms = function(){
            document.getElementById("form1").submit();
            document.getElementById("form2").submit();
        }

        var scntDiv = $('#inputs');
        var i = $('#inputs p').size() + 1;
        $('#addInput').click(function() {

            $('<p><label for="title" class="control-label">Video url:</label><input type="text" class="fn form-control" id="url' + i +'" size="20" name="url' + i +'" value="" placeholder="Input Value" /></label> <a href="#" id="remInput" class="btn btn-danger" onclick="removeMe('+ i +')">Remove</a> ').appendTo('#inputs');

            i++;
            return false;
        });

        removeMe = function(id){
            if( i > 1 ) {
                $('#url'+id+'').parents('p').remove();
                i--;
            }
            return false;
        };

    </script>
@stop
