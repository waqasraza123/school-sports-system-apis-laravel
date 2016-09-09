@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.error-messages.error')
            @include('partials.error-messages.success')

            <h3 style="text-align: center">Add Videos</h3>

            {!! Form::open(['url' => '/albums/add-videos/1', 'files' => true, 'multiple' => true, 'method' => 'PUT']) !!}
                <div class="col-md-6 col-md-offset-3">
                    {!! Form::file('video', ['id' => 'video-file', 'multiple' => true]) !!}
                </div>

                <div class="col-md-6 col-md-offset-3">
                    {!! Form::label('title', 'Title: ', ['class' => 'control-label']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <input type="hidden" id="album_id" name="album_id" value="{{$id}}">

                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-danger" style="margin-top: 50px">Max Allowed Video Files are 1.</div>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('footer')
    @include('partials.error-messages.footer-script')
    @include('albums.partials.video-scripts')
@endsection