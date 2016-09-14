@extends('layouts.master')
<link rel="stylesheet" href="/css/dropzone.css">
@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-left: 5%; margin-right: 5%">
            <h1>@if (isset($type->name)){{ $type->name }} @endif Gallery</h1>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}

                </div>
                <br>
            @endif

            <button  class="btn btn-info" id="upload_switch">Add video url</button>
            </br>
            </br>
            <div class="col-lg-12" id="photo_box">
                <form id="my-awesome-dropzone" class="dropzone">
                    <!-- this is were the previews should be shown. -->

                    <div class="dropzone-previews"></div>
                    <h4 style="text-align: center;color:#428bca;">Drop images in this area  <span class="glyphicon glyphicon-hand-down"></span></h4>

                </form>
                <div class="how-to-create">
                    <ul>
                        <li>Maximum allowed size of image is 8MB</li>
                    </ul>
                </div>
                <button id="submitUpload" type="submit" form="my-awesome-dropzone" class="btn btn-info" id="submitbtn" style="margin-left: 75%; ">Upload photos!</button>
            </div>

            <div class="col-lg-12" id="video_box">
            {!! Form::open(['route' => ['albums.url-upload', $album_id]]) !!}
            <!-- this is were the previews should be shown. -->
                <div id="inputs">
                {!! Form::label('title', 'Video url:', ['class' => 'control-label']) !!}
                {!! Form::text('url', null, ['class' => 'fn form-control', 'required' => 'true']) !!}
                </div>
                <button type="button" class="btn btn-warning" id="addInput">Add new field</button>

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
                                    <p class="students_ids" style="display: none;" >{{ json_encode($photo->students->lists('id'))}} </p>
                                </div>
                                <p style="position: absolute;bottom: 0; right:10px; left:10px">
                                    @foreach($photo->students as $student_tag)<span class="label label-info" style="color: black; font-weight: lighter; font-size: 10px">{{$student_tag->name}}</span> @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-lg-12">
                <h1>VIDEOS</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th>URL</th>
                        <th>Players</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                @foreach($gallery_videos as $video)
                    <tr>
                        <td><a href="{{ $video->url}}">{{$video->url}}</a></td>
                        <td>@foreach($video->students as $student_tag) <label>{{$student_tag->name}}, </label> @endforeach
                        </td>
                        <td><button data-id="{{ $video->id}}" data-toggle="modal" class="edit_video btn btn-info" data-target="#galleryModal" align="right" >edit</button></td>
                        <td>{!! Form::open([    'method' => 'DELETE','route' => ['gallery.destroy', $video->id]]) !!}{!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}{!! Form::close() !!}</td>
                        <td><p class="video_students_ids" style="display: none;" >{{ json_encode($video->students->lists('id'))}} </p></td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('gallery.modal.galltery_form')
@stop

@section('footer')
    @include('partials.error-messages.footer-script')
    @include('gallery.partials.footer-script')
@stop
