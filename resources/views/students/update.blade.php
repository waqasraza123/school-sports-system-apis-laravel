@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h2 style="text-align: center">Update Student</h2>

        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::model($student, ['method' => 'put', 'url' => 'students/'.$student->id, 'files' =>true]) !!}

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('title', 'Name:', ['class' => 'control-label']) !!}
                {!! Form::text('name', null, ['class' => 'fn form-control', 'required' => 'true']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('academic_year', 'Academic Year:', ['class' => 'control-label']) !!}
                {!! Form::select('academic_year',
                        ['Freshman' => 'Freshman', 'Sohphomore' => 'Sohphomore',
                         'Junior' => 'Junior', 'Senior' => 'Senior'], 'Please Select'
                        ,['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                {!! Form::label('photo', 'Photo:', ['class' => 'control-label']) !!}
                {!! Form::file('photo', ['class' => 'fn form-control']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('title', 'Weight(pounds):', ['class' => 'control-label']) !!}
                {!! Form::selectRange('weight', 80, 220, 80, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('number', 'Phone:', ['class' => 'control-label']) !!}
                {!! Form::tel('number', null, ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('title', 'Height in Feet:', ['class' => 'control-label']) !!}
                        {!! Form::selectRange('height_feet', 4, 7, 4, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('title', 'Height in Inches:', ['class' => 'control-label']) !!}
                        {!! Form::selectRange('height_inches', 0, 12, 0, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('pro_free', 'Pro/Free:', ['class' => 'control-label']) !!}
                {!! Form::select('pro_free', ['' => 'Please Select', '0' => 'Free', '1' => 'Pro'],'please select',
                 ['class' => 'fn form-control', 'id'=>'pro_free_', 'onchange' => 'return pro()', 'required' => true]) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('pro_flag', 'Pro Flag:', ['class' => 'control-label hide-pro']) !!}
                {!! Form::file('pro_flag', ['class' => 'fn form-control hide-pro']) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! Form::label('pro_head_photo', 'Pro Head Photo:', ['class' => 'control-label hide-pro']) !!}
                {!! Form::file('pro_head_photo', ['class' => 'fn form-control hide-pro']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('pro_cover_photo', 'Pro Cover Photo:', ['class' => 'control-label hide-pro']) !!}
                {!! Form::file('pro_cover_photo', ['class' => 'fn form-control hide-pro']) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">

            </div>

        </div>
        <div class="row" style="margin: 20px 20px 20px 0px">
            <div class="col-md-12">
                <b>{{$school->name}} Custom Fields: </b>
                <button style="" type="button" id="add-field" class="btn btn-default">
                    Add Fields?</button>
            </div>
        </div>
        <div class="row" id="dynamic-fields-row">
            {{--will append the data on button click--}}
        </div>

    </div>{{--container fluid closed--}}
    <div class="container-fluid">
        @if($customFields)
            @foreach($customFields as $customField)

                <div class="row" id="" style="">
                    <div class="col-md-6" id="">
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-6">
                                <input value="{{$customField->custom_label}}" readonly type="text" name="custom-field-name[]" class="form-control col-md-3">
                            </div>
                            <div class="col-md-6">
                                <input type="text" value="" name="custom-field-value[]" class="form-control col-md-3" placeholder="Value">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="row" style="margin: 0 auto; width: 300px; padding: 10px">
            <div class="" style="margin-top: 20px; margin-left: 10px !important; float: left;">
                {!! Form::submit('Update Student', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        {!! Form::close() !!}

    </div>{{--container fluid closed--}}
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    @include('students.partials.footer')
@endsection
