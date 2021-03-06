@extends('layouts.master')
<link rel="stylesheet" href="/timepicker/css/bootstrap-timepicker.min.css">
<link href='/css/jquery.guillotine.css' media='all' rel='stylesheet'>
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.error-messages.error')
            @include('partials.error-messages.success')
            <div class="col-md-6">
                <div class="form-group-sm">
                    <div class="col-s-3">

                        @if (isset($type->name)){!! Form::open(array('url'=>'news/'.$id_sport, 'method'=>'POST', 'files'=>true)) !!} @else
                            {!! Form::open(array('url'=>'news/', 'method'=>'POST', 'files'=>true)) !!} @endif
                        {{ Form::hidden('news_invisible_image', null, ['id' => 'news_invisible_image']) }}
                        {{ Form::hidden('news_invisible_action', null, ['id' => 'news_invisible_action']) }}



                        <div class="control-group">
                            @include('partials.image_crop_preview')
                            <div class="controls">
                                {!! Form::label('title', 'Select Image:', ['class' => 'control-label']) !!}
                                {!! Form::file('photo', ['class' => 'form-control', 'id' => 'photo']) !!}
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group-sm">
                    <div class="com-s-6">
                        {!! Form::label('roster_id', 'Roster:', ['class' => 'control-label']) !!}
                        {{ Form::select('roster_id[]', $rosters, null,
                         ['class' => 'form-control','id' => 'roster_id', 'multiple']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group-sm">
                    <div class="com-s-6">
                        {!! Form::label('title', 'Game:', ['class' => 'control-label']) !!}
                        {{ Form::select('game_id[]', $games, null,
                        ['class' => 'form-control','id' => 'game_id', 'multiple']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group-sm">
                    <div class="com-sm-6">
                        {!! Form::label('title', 'Student:', ['class' => 'control-label']) !!}
                        {{ Form::select('student_id[]', $students, null,
                        ['class' => 'form-control', 'id' => 'student_id', 'multiple']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group-sm">
                    <div class="com-sm-6">
                        {!! Form::label('season', 'Season:', ['class' => 'control-label']) !!}
                        {{ Form::select('season', $seasons, null,
                        ['class' => 'form-control', 'id' => 'season_id', 'required'=> 'true']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group-sm">
                    <div class="com-s-3">
                        {{ Form::hidden('news_invisible_id', null, ['id' => 'news_invisible_id']) }}

                        {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'id'=> 'title', 'required'=> 'true']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group-sm">
                    <div class="col-s-3">
                        {!! Form::label('title', 'Date:', ['class' => 'control-label']) !!}
                        {{ Form::text('news_date', '', ['class' => 'form-control','id' => 'news_date', 'required'=> 'true']) }}
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="form-group-sm">
                    <div class="col-s-3">
                        {!! Form::label('title', 'Content:', ['class' => 'control-label']) !!}
                        {{ Form::textarea('content', null, ['class' => 'form-control','id' => 'content', 'required'=> 'true']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group-sm">
                    <div class="col-s-3">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group-sm">
                    <div class="col-s-3">
                        {!! Form::submit('Create News', ['class' => 'btn btn-primary']) !!}

                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('footer')
    <script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        //CKEDITOR.replace( 'content' );
    </script><script src="/js/moment-with-locales.js"></script>
    <script src="/js/bootstrap-datetimepicker.js"></script>

    <script type="text/javascript">
        $('#season_id').select2();
        $('#game_id').select2();
        $('#student_id').select2();
        $('#roster_id').select2();

        $('#news_date').datetimepicker({format: "YYYY-MM-DD"});

    </script>

    <script src="/dist/js/sb-news-2.js"></script>

    <script src='/js/jquery.guillotine.js'></script>
    <script src='/dist/js/sb-image-crop-2.js'></script>
    @include('partials.error-messages.footer-script')
@endsection