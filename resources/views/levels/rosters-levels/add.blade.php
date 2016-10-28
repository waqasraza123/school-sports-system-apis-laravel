@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h2 style="text-align: center">Add Roster's Level</h2>

        @include('partials.error-messages.success')
        @include('partials.error-messages.error')

        {!! Form::open(['url' => '/rosters-levels']) !!}

            <div class="row">
                <div class="col-md-6">
                    {!!Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' =>true]) !!}
                </div>
                <div class="col-md-6" style="margin-top: 25px">
                    {!! Form::submit('Add Level', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
@stop

