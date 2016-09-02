@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        @include('partials.error-messages.success')
        @include('partials.error-messages.error')
        <h2 style="text-align: center">All Students of year ({{$year}})</h2>
        <div class="row">
            {!! Form::open(['url' => 'students/filter']) !!}
            <div class="col-md-3">
                {!! Form::selectYear('year', 2005, \Carbon\Carbon::now()->year,
                \Carbon\Carbon::now()->year, [
               'class' => 'form-control', 'id' => 'select_year_id', 'required' => true, 'onchange' => 'this.form.submit()']) !!}
            </div>
            <div class="col-md-3">
                {!! Form::select('level_id', $levelsList, null, ['id' => 'select_level_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
            </div>

            <div class="col-md-3">
                {!! Form::select('sport_id', $sportsList, null, ['id' => 'select_sport_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
            </div>

            <div class="col-md-3">
                {!! Form::select('roster_id', $rostersList, null, ['id' => 'select_roster_id', 'class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <div class="row">
            <div class="table-responsive .table-striped .table-hover col-md-12">
                <br>
                <a href="{{url('students/create')}}"><button class="btn btn-primary">Add Student</button></a>
                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Height</th>
                        <th>Academic Year</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($students)

                        @foreach($levels as $level)

                            {{dd($level->sports)}}
                            @foreach($level->sports as $sport)

                                @foreach($sport->rosters as $roster)
                                    @if($roster->students)

                                        @foreach($roster->students as $student)

                                            @if($student && $student->years)
                                                @foreach($student->years as $y)

                                                    @if($y->year == $year)

                                                        <tr>
                                                            <td>{{$student->id}}</td>
                                                            @if($student->photo)
                                                                <td><img src="{{asset('uploads/students/'.$student->photo)}}" height="50px" width="50px" alt="image"></td>
                                                            @else
                                                                <td><img src="{{asset('uploads/def.png')}}" height="50px" width="50px" alt="image"></td>
                                                            @endif
                                                            <td>{{$student->name}}</td>
                                                            <td>{{$student->height_feet.'\' '. $student->height_inches.'\'\''}}</td>
                                                            <td>{{$student->academic_year}}</td>
                                                            <td><a href="{{url('students/'. $student->id. '/edit')}}" class="btn btn-primary btn-sm">Edit</a></td>
                                                            <td>{!! Form::open([    'method' => 'DELETE','url' => ['/students', $student->id]]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                                                        </tr>
                                                    @else

                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    @else
                        <div class="alert alert-danger" style="margin-top: 20px">No Students Yet.</div>
                    @endif
                </table>
            </div>

        </div>
    </div>
@endsection
@section('footer')
    @include('partials.error-messages.footer-script')
    <script>
        $("#select_year_id").val(<?php echo $year?>);
    </script>
@endsection