@extends('layouts.master')
<link rel="stylesheet" href="/css/dropzone.css">
@section('content')
    <h1>@if (isset($type->name)){{ $type->name }} @endif Gallery</h1>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}

        </div>
        <br>
    @endif
    {{--{!! Form::open(array('url'=>'image/upload', 'method'=>'POST', 'file' => true, 'id' => '', 'class' => 'form-horizontal', 'role' => 'form')) !!}--}}
    {{--<div class="dropzone dropzone-previews" id="my-awesome-dropzone"></div>--}}
    {{--<div class="form-group"></div>--}}

    {{--<div class="form-group">--}}
        {{--<div class="col-sm-10 col-sm-offset-2">--}}
            {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--{!! Form::close() !!}--}}

    <form id="my-awesome-dropzone" class="dropzone">
         <!-- this is were the previews should be shown. -->

        <!-- Now setup your input fields -->
        {!! Form::label('title', 'Sport:', ['class' => 'control-label']) !!}
        @if (isset($type->name))
            {{ Form::select('sport_id[]', $sports, $type->id, ['class' => 'form-control', 'id' => 'sport_id', 'style' => 'width: 100%', 'multiple', 'required'=> 'true']) }}
        @else
            {{ Form::select('sport_id[]', $sports, null, ['class' => 'form-control', 'id' => 'sport_id', 'style' => 'width: 100%', 'multiple', 'required'=> 'true']) }}
        @endif
        {!! Form::label('title[]', 'Level:', ['class' => 'control-label']) !!}
        {{ Form::select('level_id[]', $levelcreate, null, ['class' => 'form-control', 'id' => 'level_id', 'style' => 'width: 100%', 'multiple']) }}

        {!! Form::label('title', 'Player:', ['class' => 'control-label']) !!}
        {{ Form::select('roster_id[]', $rosters, null, ['class' => 'form-control','id' => 'roster_id', 'style' => 'width: 100%', 'multiple']) }}
        {!! Form::label('title', 'Game:', ['class' => 'control-label']) !!}
        {{ Form::select('game_id[]', $games, null, ['class' => 'form-control','id' => 'game_id', 'style' => 'width: 100%', 'multiple']) }}
        <div class="dropzone-previews"></div>
        <button type="submit" class="btn btn-info" id="submitbtn" style="margin-left: 75%; margin-top: 65px; margin-bottom: -70px;">Upload photos!</button>
    </form>

    <div class="col-lg-12" >
        @foreach($gallery as $photo)
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
                {{--<img src="{{asset('uploads/gallery/tmp/'.$photo->name ) }}" class="img-responsive">--}}
                <div class="sss" style="position: relative; background-image: url('{{asset('uploads/gallery/tmb/'.$photo->name ) }}'); background-repeat: no-repeat; background-size: cover; width: 200px;height: 200px;">
                    <div class="info" style="color: white; background: rgba(0,0,0,0.5); height: 200px;">

                        {!! Form::open([    'method' => 'DELETE','route' => ['gallery.destroy', $photo->id]]) !!}{!! Form::submit('X', array('style' => 'background: none; border: none; font-size:24px;position: absolute;top: 3px;right: 5px; font-weight: 700;')) !!}{!! Form::close() !!}
                        <button align="right" style="position: absolute;top: 5px;right: 5px; background: transparent;border: none; font-size: 24px;"></button>
                        <button data-id="{{ $photo->id}}" data-toggle="modal" class="edit_gallery" data-target="#galleryModal" align="right" style="position: absolute;top: 5px;right: 35px; background: transparent;border: none; font-size: 24px;"><span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span></button>
                        <p class="id" style="display: none;" >{{ $photo->id}}</p>
                        <div>
                        <p class="sports_id" style="display: none;" >{{ json_encode($photo->sports->lists('id'))}} </p>
                        <p class="games_ids" style="display: none;" >{{ json_encode($photo->games->lists('id'))}} </p>
                        <p class="levels_ids" style="display: none;" >{{ json_encode($photo->levels->lists('id'))}} </p>
                        <p class="rosters_ids" style="display: none;" >{{ json_encode($photo->rosters->lists('id'))}} </p>
                        </div>
                        <p style="position: absolute;bottom: 0; right:10px; left:10px">
                        @foreach($photo->sports as $sport_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px" >{{$sport_tag->name}}</span> @endforeach
                        @foreach($photo->games as $games_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$schools[$games_tag->opponents_id]." ".$games_tag->game_date}}</span> @endforeach
                        @foreach($photo->levels as $levels_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$levels_tag->name}}</span> @endforeach
                        @foreach($photo->rosters as $roster_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$roster_tag->first_name}} {{$roster_tag->last_name}}</span> @endforeach
                    </p>
                    </div>
                </div>
       </div>
        @endforeach
    </div>

    @include('gallery.modal.galltery_form')
@stop

@section('footer')
    <script src="/dist/js/sb-gallery-2.js"></script>
    <script src="/js/dropzone.js"></script>
    <script type="text/javascript">
        $('#sport_id').select2();
        $('#game_id').select2();
        $('#level_id').select2();
        $('#roster_id').select2();

        $('#sport_modal_id').select2();
        $('#game_modal_id').select2();
        $('#level_modal_id').select2();
        $('#roster_modal_id').select2();

        submitForms = function(){
            document.getElementById("form1").submit();
            document.getElementById("form2").submit();
        }
    </script>
    <script>

        jQuery(document).ready(function() {
            var uploadSizeMax = 50000000;
            var uploadSizeTotal = 0;

            Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

                // The configuration we've talked about above
                autoProcessQueue: false,
                previewsContainer: ".dropzone-previews",
                acceptedFiles: 'image/*',
                addRemoveLinks: true,
                uploadMultiple: true,
                url: 'image/upload',
                parallelUploads: 100,
                maxThumbnailFilesize: 10,
                maxFiles: 100,
                dictDefaultMessage: "Drop image files here",

                accept: function(file, done) {
                    var isOk = true;

                    if (!(file.type == "image/jpeg" || file.type == "image/png")) {

                        isOk = false;
                        alert("Error! We mostly accept JPG and PNG image files");
                    }

                    if (uploadSizeTotal + file.size > uploadSizeMax)
                    {
                        isOk = false;
                        alert("Sorry, you have reached the max size allowed to upload (50M)");

                        var _ref;
                        if ((_ref = file.previewElement) != null) {
                            _ref.parentNode.removeChild(file.previewElement);
                        }
                        return this._updateMaxFilesReachedClass();
                    }

                    if (isOk)
                    {
                        //Add file size
                        uploadSizeTotal += file.size;

                        done();
                    }
                },

                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;

                    // First change the button to actually tell Dropzone to process the queue.
                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        // Make sure that the form isn't actually being sent.
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });

                    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                    // of the sending event because uploadMultiple is set to true.
                    this.on("sendingmultiple", function() {
                        // Gets triggered when the form is actually being sent.
                        // Hide the success button or the complete form.
                    });
                    this.on("successmultiple", function(files, response) {
                        // Gets triggered when the files have successfully been sent.
                        // Redirect user or notify of success.
                    });
                    this.on("errormultiple", function(files, response) {
                        // Gets triggered when there was an error sending the files.
                        // Maybe show form again, and notify user of error
                    });
                }

            }

        });


    </script>
    @if (session()->has('success'))
        <script>
            //display success message in the top when successfully updated roster
            $('div.alert').delay(4000).slideUp(300);
        </script>
    @endif
@stop
