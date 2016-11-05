@extends('layouts.master')
<link rel="stylesheet" href="/css/dropzone.css">
@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-left: 5%; margin-right: 5%">
            <h1>Add Video</h1>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}

                </div>
                <br>
            @endif

            <div class="col-lg-12" id="video_box">

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group-sm">
                            {!! Form::open(['route' => ['videos.url-upload']]) !!}
                            <p>Enter Youtube video in following format:<br> https://www.youtube.com/watch?v=MYbQiuSfvmw
                            </p>
                            <p>Enter Vimeo video in following format:<br> https://vimeo.com/134096503</p>

                            <input class="form-control" type="text" id="setvalue" name="url"/>


                            <button type="button" id='verifybtn'>Verify Video</button>
                            <br>
                            <br>

                            <div class="form-group select_sport">

                                <label for="title" class="control-label">Video Title</label>
                                <input class="form-control" style="width: 100%" type="text" name="txtsetvalue"
                                       id="txtsetvalue" value="Enter Value Above"
                                       onfocus="if (this.value=='Enter Value Above') this.value='';"/>
                                <h3>Tags:</h3>
                                {!! Form::label('title', 'Players:', ['class' => 'control-label']) !!}
                                {{ Form::select('student_modal_id[]', $students, null, ['class' => 'form-control','id' => 'student_modal_id', 'style' => 'width: 100%', 'multiple']) }}
                                {!! Form::label('title', 'Rosters:', ['class' => 'control-label']) !!}
                                {{ Form::select('roster_modal_id[]', $rosters, null, ['class' => 'form-control','id' => 'roster_modal_id', 'style' => 'width: 100%', 'multiple']) }}
                                {!! Form::label('title', 'Games:', ['class' => 'control-label']) !!}
                                {{ Form::select('roster_modal_id[]', $games, null, ['class' => 'form-control','id' => 'games_modal_id', 'style' => 'width: 100%', 'multiple']) }}
                                {{ Form::hidden('video_invisible_id', null, ['id' => 'video_invisible_id']) }}
                                <input type="hidden" name="cover" id="cover">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group-sm">
                            <label for="title" class="control-label">Preview Image:</label><br>
                            <img id="imgsetvalue" src="/img/plc_video.png">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-sm">
                                <div class="col-s-3">
                                    <br>

                                    {!! Form::submit('Save', ['class' => 'submit_news_modal btn btn-primary']) !!}
                                    &nbsp;
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@stop

@section('footer')
    @include('partials.error-messages.footer-script')
    <script src="/dist/js/sb-video-2.js"></script>
    <script type="text/javascript">
        $('#student_id').select2();
        $('#student_modal_id').select2();
        $('#roster_modal_id').select2();
        $('#games_modal_id').select2();


        submitForms = function () {
            document.getElementById("form1").submit();
            document.getElementById("form2").submit();
        }

        var scntDiv = $('#inputs');
        var i = $('#inputs p').size() + 1;
        $('#addInput').click(function () {

            $('<p><label for="title" class="control-label">Video url:</label><input type="text" class="fn form-control" id="url' + i + '" size="20" name="url' + i + '" value="" placeholder="Input Value" /></label> <a href="#" id="remInput" class="btn btn-danger" onclick="removeMe(' + i + ')">Remove</a> ').appendTo('#inputs');

            i++;
            return false;
        });

        removeMe = function (id) {
            if (i > 1) {
                $('#url' + id + '').parents('p').remove();
                i--;
            }
            return false;
        };

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#verifybtn').click(function () {

                var id = 'dQw4w9WgXcQ';
                var url = 'https://www.youtube.com/watch?v=' + id;
                var jobName = document.getElementById("setvalue").value;
                $.getJSON('https://noembed.com/embed',
                        {format: 'json', url: jobName}, function (data) {
                            if (typeof data.title === "undefined") {
                                alert('Sorry we can not locate your video \nPlease use a url such as: \nhttps://www.youtube.com/watch?v=MYbQiuSfvmw');
                            }
                            else {
                                document.getElementById("txtsetvalue").value = data.title;
                                document.getElementById("cover").value = data.thumbnail_url;
                                document.getElementById("imgsetvalue").src = data.thumbnail_url;
                            }
                        });
            });
        });
    </script>
@stop
