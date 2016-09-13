@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        @include('partials.error-messages.error')
        @include('partials.error-messages.success')
        <h3 style="text-align: center">Add Students</h3>

    {!! Form::open(['name' => 'roster-students', 'id' => 'rosters-students']) !!}
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="height: auto;">
                <div class="alert alert-error" style="display: none">
                </div>
                <div class="alert alert-success" style="display: none">
                </div>
                <div class="row table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                   <h3>Roster</h3>
                                </th>
                                <th>
                                    <h3>Position</h3>
                                </th>
                                <th>
                                    <h3>Students</h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{$roster->name}}
                                </td>
                                <td>
                                    <input type="hidden" value="{{$roster->id}}" name="roster_id">
                                    <input type="text" placeholder="position" name="position" class="form-control">
                                </td>
                                <td>
                                    {!! Form::select('students_id[]', $students, null, ['class' => 'form-control', 'multiple' => true,
                         'required' => true, 'id' => 'students_id']) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-5">
                {!! Form::button('Add Student', ['class' => 'btn btn-default', 'id' => 'add-roster-student']) !!}
            </div>
        </div>
    {!! Form::close() !!}
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script>
        $(document).ready(function () {
            $("#students_id").multiselect();
        })
    </script>
    <script src="/js/rosters/rosters-js.js"></script>
@endsection