@extends('layouts.master')
<link rel="stylesheet" href="/css/dropzone.css">
@section('content')
    <div class="container-fluid">
        <div class="row">
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
        </div>
    </div>
    @include('gallery.modal.galltery_form')
@stop

@section('footer')
    @include('partials.error-messages.footer-script')
    @include('gallery.partials.footer-script')
@stop
