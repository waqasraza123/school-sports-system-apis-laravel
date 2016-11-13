@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        @include('partials.error-messages.error')
        @include('partials.error-messages.success')

        {!! Form::open(['route' => 'school-add-users']) !!}
        <h3 style="text-align: center">Add Users</h3>
        <input type="hidden" value="{{$schoolId}}" name="school-id">
            <div class="row">
                <div class="col-md-4">
                    {!! Form::label('users', 'Select Users', ['class' => 'control-label']) !!}
                    {!! Form::select('users[]', $users, null, ['class' => 'form-control', 'multiple', 'id' => 'users']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('role', 'Role', ['class' => 'control-label']) !!}
                    {!! Form::select('role', $roles, null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('school', 'Select Schools', ['class' => 'control-label']) !!}
                    {!! Form::select('schools[]', $schools, null, ['class' => 'form-control', 'multiple', 'id' => 'schools']) !!}
                </div>
            </div>
            <div class="row">
                <div class="submit" style="margin: 20px auto; width: 100px">
                    {!! Form::submit('Add Users', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

        {!! Form::close() !!}
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script>
        $("#users").select2();
        $("#schools").select2();
    </script>
@endsection