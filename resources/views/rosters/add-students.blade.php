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

    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead  style="background-color:#000000; color:white">
                    <th>Student name</th>
                    <th>Roster name</th>
                    <th>Position</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($rosterStudents as $rosterStudent)
                                <tr>
                                    <td>{{$rosterStudent->name}}</td>
                                    <td>{{$rosterStudent->rosters()->first()->name}}</td>
                                    <td class="position">{{$rosterStudent->pivot->position}}</td>
                                    {!! Form::open(['url' => 'rosters/'.$rosterStudent->rosters()->first()->id.'/students/'.$rosterStudent->id.'/update']) !!}
                                    <td class="position_input">{!! Form::text('position', $rosterStudent->pivot->position, ['class' => 'fn form-control', 'required' => 'true']) !!}</td>
                                    <td class="edit_col"><a class="btn btn-primary btn-sm edit" href="">Edit</a></td>
                                    <td class="update_col">{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!} <a href="" class="btn btn-primary btn-sm cancel">Cancel</a></td>
                                    {!! Form::close() !!}
                                    <td>{!! Form::open([    'method' => 'DELETE','route' => ['rosters.students.delete',$rosterStudent->rosters()->first()->id ,$rosterStudent->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                                </tr>

                        @endforeach
                </table>
            </div>

        </div>
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
    <script>
        $('.update_col').hide();
        $(".position_input").hide();
        $('.edit').click(function(event){
            event.preventDefault();
            var $row = $(this).parent().closest("tr");
            var $edit_col = $row.find(".edit_col");
            var $update_col = $row.find(".update_col");
            var $position = $row.find(".position");
            var $position_input = $row.find(".position_input");
            $edit_col.hide();
            $position.hide();
            $update_col.show();
            $position_input.show();
        });

        $('.cancel').click(function(event){
            event.preventDefault();
            var $row = $(this).parent().closest("tr");
            var $edit_col = $row.find(".edit_col");
            var $update_col = $row.find(".update_col");
            var $position = $row.find(".position");
            var $position_input = $row.find(".position_input");
            $edit_col.show();
            $position.show();
            $update_col.hide();
            $position_input.hide();
        });
    </script>
@endsection