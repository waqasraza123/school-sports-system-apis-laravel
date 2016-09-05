@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h2 style="text-align: center">Add Student</h2>

        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::open(['url' => 'students/', 'files' =>true]) !!}

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('title', 'Name:', ['class' => 'control-label']) !!}
                {!! Form::text('name', null, ['class' => 'fn form-control', 'required' => 'true']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('year_id', 'Year:', ['class' => 'control-label']) !!}
                {!! Form::selectYear('year_id', 2005, \Carbon\Carbon::now()->year, \Carbon\Carbon::now()->year, ['class' => 'form-control', 'required' => 'true']) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('photo', 'Photo:', ['class' => 'control-label']) !!}
                {!! Form::file('photo', ['class' => 'fn form-control']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('title', 'Position:', ['class' => 'control-label']) !!}
                {!! Form::text('position', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('number', 'Phone:', ['class' => 'control-label']) !!}
                {!! Form::number('number', null, ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('title', 'Height:', ['class' => 'control-label']) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::number('height_feet', 'feet', ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::number('height_inches', 'inches', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('academic_year', 'Academic Year:', ['class' => 'control-label']) !!}
                {!! Form::selectRange('academic_year', 1, 4, null, ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('title', 'Weight(pounds):', ['class' => 'control-label']) !!}
                {!! Form::text('weight', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('pro_free', 'Pro/Free:', ['class' => 'control-label']) !!}
                {!! Form::select('pro_free', ['' => 'Please Select', '0' => 'Free', '1' => 'Pro'],'please select',
                 ['class' => 'fn form-control', 'id'=>'pro_free_', 'onchange' => 'return pro()', 'required' => true]) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('roster_id', 'Roster', ['class' => 'control-label']) !!}
                {!! Form::select('roster_id[]', $rosters, null, ['class' => 'form-control select2',
                'multiple' => true, 'required' => true]) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('pro_head_photo', 'Pro Head Photo:', ['class' => 'control-label hide-pro']) !!}
                {!! Form::file('pro_head_photo', ['class' => 'fn form-control hide-pro']) !!}
            </div>
            <div class="col-md-6">

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('pro_cover_photo', 'Pro Cover Photo:', ['class' => 'control-label hide-pro']) !!}
                {!! Form::file('pro_cover_photo', ['class' => 'fn form-control hide-pro']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('pro_flag', 'Pro Flag:', ['class' => 'control-label hide-pro']) !!}
                {!! Form::file('pro_flag', ['class' => 'fn form-control hide-pro']) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-5" style="margin-top: 20px">
                {!! Form::submit('Create Student', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        {!! Form::close() !!}

    </div>{{--container fluid closed--}}
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script>
        $('.hide-pro').hide();
    function pro() {

        if($("#pro_free_").val() == 0){
            $('.hide-pro').hide('slow');
        }
        if($("#pro_free_").val() == 1){
            $('.hide-pro').show('slow');
        }
    }
    </script>
@endsection