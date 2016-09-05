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

    <button class="btn btn-info" id="upload_switch">Add video url</button>
    </br>
    </br>
    <div class="col-lg-12" id="photo_box">
        <form id="my-awesome-dropzone" class="dropzone">
            <!-- this is were the previews should be shown. -->

            <div class="dropzone-previews"></div>
            <button type="submit" class="btn btn-info" id="submitbtn" style="margin-left: 75%; margin-top: 65px; margin-bottom: -70px;">Upload photos!</button>
        </form>
    </div>

    <div class="col-lg-12" id="video_box">
        {!! Form::open(['route' => ['albums.url-upload', $album_id]]) !!}
                <!-- this is were the previews should be shown. -->
        {!! Form::label('title', 'Video url:', ['class' => 'control-label']) !!}
        {!! Form::text('url', null, ['class' => 'fn form-control', 'required' => 'true']) !!}

        <button type="submit" class="btn btn-info" id="submitbtn" style="margin-left: 75%; margin-top: 5px;">Add video url</button>
        {!! Form::close() !!}
    </div>

    <div class="col-lg-12" >
        <h2>IMAGES</h2>
        @foreach($gallery_images as $photo)
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
                        <p class="rosters_ids" style="display: none;" >{{ json_encode($photo->rosters->lists('id'))}} </p>
                        </div>
                        <p style="position: absolute;bottom: 0; right:10px; left:10px">
                        @foreach($photo->rosters as $roster_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$roster_tag->name}}</span> @endforeach
                    </p>
                    </div>
                </div>
       </div>
        @endforeach
    </div>

    <div class="col-lg-12">
        <h1>VIDEOS</h1>
        @foreach($gallery_videos as $video)
            <div class="col-lg-12">
            <a href="{{ $video->url}}">{{$video->url}}</a>

        @foreach($video->rosters as $roster_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$roster_tag->name}}</span> @endforeach
            </div>
            <div class="col-lg-12">
                <div>
                    <p class="video_rosters_ids" style="display: none;" >{{ json_encode($video->rosters->lists('id'))}} </p>
                </div>
                {!! Form::open([    'method' => 'DELETE','route' => ['gallery.destroy', $video->id]]) !!}{!! Form::submit('X', array('style' => 'background: none;position: relative; border: none; font-size:24px; font-weight: 700;')) !!}{!! Form::close() !!}
                <button data-id="{{ $video->id}}" data-toggle="modal" class="edit_video" data-target="#galleryModal" align="right" style="background: transparent;position: relative;border: none; font-size: 24px;"><span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span></button>
            </div>
            <br>
        @endforeach
    </div>


    @include('gallery.modal.galltery_form')
@stop

@section('footer')
    <script src="/dist/js/sb-gallery-2.js"></script>
    <script src="/js/dropzone.js"></script>
    <script type="text/javascript">
        $('#roster_id').select2();
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
                url: '{{$album_id}}/image/upload',
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
